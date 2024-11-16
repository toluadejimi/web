<?php

namespace App\Http\Controllers\Gateway\Enkpay;

use App\Lib\AfterPayment;
use App\Models\AdminNotification;
use App\Models\Deposit;
use App\Http\Controllers\Gateway\PaymentController;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use net\authorize\api\constants\ANetEnvironment;
use net\authorize\api\contract\v1\CreateTransactionRequest;
use net\authorize\api\contract\v1\CreditCardType;
use net\authorize\api\contract\v1\MerchantAuthenticationType;
use net\authorize\api\contract\v1\PaymentType;
use net\authorize\api\contract\v1\TransactionRequestType;
use net\authorize\api\controller\CreateTransactionController;


class ProcessController extends Controller
{

    public static function process($deposit)
    {
        $alias = $deposit->gateway->alias;
        $send['track'] = $deposit->trx;
        $send['view'] = 'user.payment.'.$alias;
        $send['method'] = 'post';
        $send['url'] = route('ipn.'.$alias);
        return json_encode($send);
    }


    public static function verify(request $request)
    {

        $databody = array(
            "trans_id" => $request->ref,
        );

        $post_data = json_encode($databody);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://web.sprintpay.online/verify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $var = curl_exec($curl);
        curl_close($curl);
        $var = json_decode($var);
        $status = $var->status ?? null;

        if($status == "paid"){

            $ck_status = Deposit::where('ref', $request->ref)->first()->status;
            $order_id = Deposit::where('ref', $request->ref)->first()->order_id;


            dd($order_id, $ck_status);

            if($ck_status != 1) {

                Deposit::where('ref', $request->ref)->update(['status' => 1]);
                $deposit = Deposit::where('ref', $request->ref)->first();

                Invoice::where('order_id', $order_id)->update(['status' => 1]);

                $user = User::find($deposit->user_id);
                $user->balance += $deposit->amount;
                $user->save();

                $transaction = new Transaction();
                $transaction->user_id = $deposit->user_id;
                $transaction->amount = $deposit->amount;
                $transaction->post_balance = $user->balance;
                $transaction->charge = $deposit->charge;
                $transaction->trx_type = '+';
                $transaction->details = 'Deposit Via ' . $deposit->gatewayCurrency()->name;
                $transaction->trx = $deposit->trx;
                $transaction->remark = 'deposit';
                $transaction->save();

                $adminNotification = new AdminNotification();
                $adminNotification->user_id = $user->id;
                $adminNotification->title = 'Deposit successful via Enkpay';
                $adminNotification->click_url = urlPath('admin.deposit.successful');
                $adminNotification->save();


                notify($user, 'DEPOSIT_COMPLETE', [
                    'method_name' => $deposit->gatewayCurrency()->name,
                    'method_currency' => $deposit->method_currency,
                    'method_amount' => showAmount($deposit->final_amo),
                    'amount' => showAmount($deposit->amount),
                    'charge' => showAmount($deposit->charge),
                    'rate' => showAmount($deposit->rate),
                    'trx' => $deposit->trx,
                    'post_balance' => showAmount($user->balance)
                ]);



                $notify[] = ['success', 'Payment captured successfully'];
                return back()->withNotify($notify);

            }else{
                $notify[] = ['error', 'Payment has already been captured'];
                return back()->withNotify($notify);
            }


        }else{
            $notify[] = ['error','Something went wrong'];
            return to_route(gatewayRedirectUrl())->withNotify($notify);
        }



    }




    public function ipn(Request $request)
    {
        $track = Session::get('Track');
        $deposit = Deposit::where('trx', $track)->where('status',0)->orderBy('id', 'DESC')->first();
        if ($deposit->status == 1) {
            $notify[] = ['error', 'Invalid request.'];
            return to_route(gatewayRedirectUrl())->withNotify($notify);
        }

        $this->validate($request, [
            'cardNumber' => 'required',
            'cardExpiry' => 'required',
            'cardCVC' => 'required',
        ]);
        $cardNumber = str_replace(' ','',$request->cardNumber);
        $exp = str_replace(' ','',$request->cardExpiry);

        $credentials = json_decode($deposit->gatewayCurrency()->gateway_parameter);

        // Common setup for API credentials
        $merchantAuthentication = new MerchantAuthenticationType();
        $merchantAuthentication->setName($credentials->login_id);
        $merchantAuthentication->setTransactionKey($credentials->transaction_key);

        // Create the payment data for a credit card
        $creditCard = new CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($exp);

        $paymentOne = new PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a transaction
        $transactionRequestType = new TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($deposit->final_amo);
        $transactionRequestType->setPayment($paymentOne);

        $transactionRequest = new CreateTransactionRequest();
        $transactionRequest->setMerchantAuthentication($merchantAuthentication);
        $transactionRequest->setRefId($deposit->trx);
        $transactionRequest->setTransactionRequest($transactionRequestType);

        $controller = new CreateTransactionController($transactionRequest);
        $response = $controller->executeWithApiResponse(ANetEnvironment::PRODUCTION);
        $response = $response->getTransactionResponse();

        if (($response != null) && ($response->getResponseCode() == "1")) {
            PaymentController::userDataUpdate($deposit);
            $notify[] = ['success', 'Payment captured successfully'];
            return to_route(gatewayRedirectUrl(true))->withNotify($notify);
        }
        $notify[] = ['error','Something went wrong'];
        return to_route(gatewayRedirectUrl())->withNotify($notify);

    }
}
