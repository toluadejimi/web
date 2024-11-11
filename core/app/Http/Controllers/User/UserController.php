<?php

namespace App\Http\Controllers\User;

use App\Models\Form;
use App\Lib\FormProcessor;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Hosting;
use App\Models\Invoice;
use App\Models\Domain;
use App\Lib\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use App\Models\NotificationLog;
use App\Module\cPanel;
use App\Models\SupportTicket;

class UserController extends Controller
{
    public function home() 
    { 
        $pageTitle = 'Dashboard';
        $user = auth()->user();
        $totalTicket = SupportTicket::where('user_id', $user->id)->count();
        $totalInvoice = Invoice::where('user_id', $user->id)->count();
        $totalDomain = Domain::where('user_id', $user->id)->count();
        $totalService = Hosting::where('user_id', $user->id)->count();
        $totalOverDueInvoice = Invoice::unpaid()->where('user_id', $user->id)->selectRaw('count(*) as total, sum(amount) as totalDue')->first();

        return view($this->activeTemplate . 'user.dashboard', compact('pageTitle', 'user', 'totalTicket', 'totalInvoice', 'totalDomain', 'totalService', 'totalOverDueInvoice'));
    }

    public function depositHistory(Request $request)
    {   
        if(!gs()->deposit_module){
            return abort(404);
        }

        $pageTitle = 'Deposit History';
        $deposits = auth()->user()->deposits()->searchable(['trx'])->with(['gateway', 'invoice'])->orderBy('id','desc')->paginate(getPaginate());
        return view($this->activeTemplate.'user.deposit_history', compact('pageTitle', 'deposits'));
    }

    public function emailHistory(Request $request)
    {   
        $pageTitle = 'Email History';
        $emails = NotificationLog::where('user_id', auth()->user()->id)->where('notification_type', 'email')->with('user')->orderBy('id','desc')->paginate(getPaginate());
        return view($this->activeTemplate.'user.email_history', compact('pageTitle', 'emails'));
    }

    function emailDetails($id){ 
        $pageTitle = 'Email Details'; 
        $email = NotificationLog::where('user_id', auth()->user()->id)->where('notification_type', 'email')->findOrFail($id);
        return view($this->activeTemplate.'user.email_details', compact('pageTitle', 'email'));
    }

    public function show2faForm()
    {
        $general = gs();
        $ga = new GoogleAuthenticator();
        $user = auth()->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . gs('site_name'), $secret);
        $pageTitle = '2FA Setting';
        return view($this->activeTemplate.'user.profile.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user,$request->code,$request->key);
        if ($response) {
            $user->tsc = $request->key;
            $user->ts = 1;
            $user->save();
            $notify[] = ['success', 'Google authenticator activated successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }

    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = auth()->user();
        $response = verifyG2fa($user,$request->code);
        if ($response) {
            $user->tsc = null;
            $user->ts = 0;
            $user->save();
            $notify[] = ['success', 'Two factor authenticator deactivated successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }

    public function transactions()
    {
        $pageTitle = 'Transactions';
        $remarks = Transaction::distinct('remark')->where('remark', '!=', null)->orderBy('remark')->get('remark');
        $transactions = Transaction::where('user_id',auth()->id())->searchable(['trx'])->filter(['trx_type','remark'])->orderBy('id','desc')->paginate(getPaginate());
        return view($this->activeTemplate.'user.transactions', compact('pageTitle','transactions','remarks'));
    }

    public function kycForm()
    {
        if (auth()->user()->kv == 2) {
            $notify[] = ['error','Your KYC is under review'];
            return to_route('user.home')->withNotify($notify);
        }
        if (auth()->user()->kv == 1) {
            $notify[] = ['error','You are already KYC verified'];
            return to_route('user.home')->withNotify($notify);
        }
        $pageTitle = 'KYC Form';
        $form = Form::where('act','kyc')->first();
        return view($this->activeTemplate.'user.kyc.form', compact('pageTitle','form'));
    }

    public function kycData()
    {
        $user = auth()->user();
        $pageTitle = 'KYC Data';
        return view($this->activeTemplate.'user.kyc.info', compact('pageTitle','user'));
    }

    public function kycSubmit(Request $request)
    {
        $form = Form::where('act','kyc')->first();
        $formData = $form->form_data;
        $formProcessor = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData = $formProcessor->processFormData($request, $formData);
        $user = auth()->user();
        $user->kyc_data = $userData;
        $user->kv = 2;
        $user->save();

        $notify[] = ['success','KYC data submitted successfully'];
        return to_route('user.home')->withNotify($notify);

    }

    public function attachmentDownload($fileHash)
    {
        $filePath = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $general = gs();
        $title = slug($general->site_name).'- attachments.'.$extension;
        $mimetype = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }

    public function userData()
    {
        $user = auth()->user();
        if ($user->profile_complete == 1) {
            return to_route('user.home');
        }
        $pageTitle = 'User Data';
        return view($this->activeTemplate.'user.profile.user_data', compact('pageTitle','user'));
    }

    public function userDataSubmit(Request $request)
    {
        $user = auth()->user();
        if ($user->profile_complete == 1) {
            return to_route('user.home');
        }
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
        ]);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->address = [
            'country'=>@$user->address->country,
            'address'=>$request->address,
            'state'=>$request->state,
            'zip'=>$request->zip,
            'city'=>$request->city,
        ];
        $user->profile_complete = 1;
        $user->save();

        $notify[] = ['success','Registration process completed successfully'];
        return to_route('user.home')->withNotify($notify);

    } 

    public function loginCpanel($id){

        setTimeLimit();
        
        $service = Hosting::whereBelongsTo(auth()->user())->findOrFail($id);

        $product = $service->product;
        $server = $service->server;

        if($product->module_type == 0){
            $notify[] = ['error', 'Unable to auto-login'];
            return back()->withNotify($notify);
        }

        if(!$server){
            $notify[] = ['error', 'There is no selected server to auto-login'];
            return back()->withNotify($notify); 
        }

        $cPanel = new cPanel(); //The cPanel is a class
        $execute = $cPanel->loginCpanel($service, $server);

        if(!$execute['success']){
            $notify[] = ['error', $execute['message']];
            return back()->withNotify($notify);
        }

        return back()->with('cpanelLoginUrl', $execute['url']);
    }

}



