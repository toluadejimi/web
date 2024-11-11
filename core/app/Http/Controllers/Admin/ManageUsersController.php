<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CancelRequest;
use App\Models\Deposit;
use App\Models\Domain;
use App\Models\NotificationLog;
use App\Models\Hosting;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class ManageUsersController extends Controller
{

    public function allUsers()
    {
        $pageTitle = 'All Clients';
        $users = $this->userData(); 
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function activeUsers()
    {
        $pageTitle = 'Active Clients';
        $users = $this->userData('active');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function bannedUsers()
    {
        $pageTitle = 'Banned Clients';
        $users = $this->userData('banned');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function emailUnverifiedUsers()
    {
        $pageTitle = 'Email Unverified Clients';
        $users = $this->userData('emailUnverified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function kycUnverifiedUsers()
    {
        $pageTitle = 'KYC Unverified Clients';
        $users = $this->userData('kycUnverified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function kycPendingUsers()
    {
        $pageTitle = 'KYC Unverified Clients';
        $users = $this->userData('kycPending');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function emailVerifiedUsers()
    {
        $pageTitle = 'Email Verified Clients';
        $users = $this->userData('emailVerified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }


    public function mobileUnverifiedUsers()
    {
        $pageTitle = 'Mobile Unverified Clients';
        $users = $this->userData('mobileUnverified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }


    public function mobileVerifiedUsers()
    {
        $pageTitle = 'Mobile Verified Clients';
        $users = $this->userData('mobileVerified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }


    public function usersWithBalance()
    {
        $pageTitle = 'Users with Balance';
        $users = $this->userData('withBalance');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }


    protected function userData($scope = null){
        if ($scope) {
            $users = User::$scope();
        }else{
            $users = User::query();
        }

        return $users->orderBy('id','desc')->with([
            'hostings'=>function($hosting){
                $hosting->select('id', 'user_id');
            },
            'domains'=>function($domain){
                $domain->select('id', 'user_id');
            }
        ])->searchable(['username','email'])->orderBy('id','desc')->paginate(getPaginate());
    }


    public function detail($id)
    {
        $user = User::findOrFail($id);
        $pageTitle = 'Client Detail - '.$user->username;

        $totalDeposit = Deposit::where('user_id',$user->id)->where('status',1)->sum('amount');
        $totalTransaction = Transaction::where('user_id',$user->id)->count();
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        $statistics['count_total_order'] = Order::where('user_id', $user->id)->count();
        $statistics['count_total_invoice'] = Invoice::where('user_id', $user->id)->count();
        $statistics['count_total_cancellation'] = CancelRequest::where('user_id', $user->id)->count();
        $statistics['count_total_service'] = Hosting::where('user_id', $user->id)->count();
        $statistics['count_total_domain'] = Domain::where('user_id', $user->id)->count();

        return view('admin.users.detail', compact('pageTitle', 'user','totalDeposit','totalTransaction','countries', 'statistics'));
    }


    public function kycDetails($id)
    {
        $pageTitle = 'KYC Details';
        $user = User::findOrFail($id);
        return view('admin.users.kyc_detail', compact('pageTitle','user'));
    }

    public function kycApprove($id)
    {
        $user = User::findOrFail($id);
        $user->kv = 1;
        $user->save();

        notify($user,'KYC_APPROVE',[]);

        $notify[] = ['success','KYC approved successfully'];
        return to_route('admin.users.kyc.pending')->withNotify($notify);
    }

    public function kycReject($id)
    {
        $user = User::findOrFail($id);
        foreach ($user->kyc_data as $kycData) {
            if ($kycData->type == 'file') {
                fileManager()->removeFile(getFilePath('verify').'/'.$kycData->value);
            }
        }
        $user->kv = 0;
        $user->kyc_data = null;
        $user->save();

        notify($user,'KYC_REJECT',[]);

        $notify[] = ['success','KYC rejected successfully'];
        return to_route('admin.users.kyc.pending')->withNotify($notify);
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $countryData = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryArray   = (array)$countryData;
        $countries      = implode(',', array_keys($countryArray));

        $countryCode    = $request->country;
        $country        = $countryData->$countryCode->country;
        $dialCode       = $countryData->$countryCode->dial_code;

        $request->validate([
            'firstname' => 'required|string|max:40',
            'lastname' => 'required|string|max:40',
            'email' => 'required|email|string|max:40|unique:users,email,' . $user->id,
            'mobile' => 'required|string|max:40|unique:users,mobile,' . $user->id,
            'country' => 'required|in:'.$countries,
        ]);
        $user->mobile = $dialCode.$request->mobile;
        $user->country_code = $countryCode;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->address = [
                            'address' => $request->address,
                            'city' => $request->city,
                            'state' => $request->state,
                            'zip' => $request->zip,
                            'country' => @$country,
                        ];
        $user->ev = $request->ev ? 1 : 0;
        $user->sv = $request->sv ? 1 : 0;
        $user->ts = $request->ts ? 1 : 0;
        if (!$request->kv) {
            $user->kv = 0;
            if ($user->kyc_data) {
                foreach ($user->kyc_data as $kycData) {
                    if ($kycData->type == 'file') {
                        fileManager()->removeFile(getFilePath('verify').'/'.$kycData->value);
                    }
                }
            }
            $user->kyc_data = null;
        }else{
            $user->kv = 1;
        }
        $user->save();

        $notify[] = ['success', 'Client details updated successfully'];
        return back()->withNotify($notify);
    }

    public function addSubBalance(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|gt:0',
            'act' => 'required|in:add,sub',
            'remark' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $amount = $request->amount;
        $trx = getTrx();

        $transaction = new Transaction();

        if ($request->act == 'add') {
            $user->balance += $amount;

            $transaction->trx_type = '+';
            $transaction->remark = 'balance_add';

            $notifyTemplate = 'BAL_ADD';

            $notify[] = ['success', gs('cur_sym') . $amount . ' added successfully'];

        } else {
            if ($amount > $user->balance) {
                $notify[] = ['error', $user->username . ' doesn\'t have sufficient balance.'];
                return back()->withNotify($notify);
            }

            $user->balance -= $amount;

            $transaction->trx_type = '-';
            $transaction->remark = 'balance_subtract';

            $notifyTemplate = 'BAL_SUB';
            $notify[] = ['success', gs('cur_sym') . $amount . ' subtracted successfully'];
        }

        $user->save();

        $transaction->user_id = $user->id;
        $transaction->amount = $amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge = 0;
        $transaction->trx =  $trx;
        $transaction->details = $request->remark;
        $transaction->save();

        notify($user, $notifyTemplate, [
            'trx' => $trx,
            'amount' => showAmount($amount),
            'remark' => $request->remark,
            'post_balance' => showAmount($user->balance)
        ]);

        return back()->withNotify($notify);
    }

    public function login($id){
        Auth::loginUsingId($id);
        return to_route('user.home');
    }

    public function status(Request $request,$id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 1) {
            $request->validate([
                'reason'=>'required|string|max:255'
            ]);
            $user->status = 0;
            $user->ban_reason = $request->reason;
            $notify[] = ['success','User banned successfully'];
        }else{
            $user->status = 1;
            $user->ban_reason = null;
            $notify[] = ['success','User unbanned successfully'];
        }
        $user->save();
        return back()->withNotify($notify);

    }


    public function showNotificationSingleForm($id)
    {
        $user = User::findOrFail($id);
        $general = gs();
        if (!$general->en && !$general->sn) {
            $notify[] = ['warning','Notification options are disabled currently'];
            return to_route('admin.users.detail',$user->id)->withNotify($notify);
        }
        $pageTitle = 'Send Notification to ' . $user->username;
        return view('admin.users.notification_single', compact('pageTitle', 'user'));
    }

    public function sendNotificationSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'subject' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        notify($user,'DEFAULT',[
            'subject'=>$request->subject,
            'message'=>$request->message,
        ]);
        $notify[] = ['success', 'Notification sent successfully'];
        return back()->withNotify($notify);
    }

    public function showNotificationAllForm()
    {   
        $general = gs();
        if (!$general->en && !$general->sn) {
            $notify[] = ['warning','Notification options are disabled currently'];
            return to_route('admin.dashboard')->withNotify($notify);
        }
        $notifyToUser = User::notifyToUser();
        $users = User::active()->count();
        $pageTitle = 'Notification to Verified Clients';
        return view('admin.users.notification_all', compact('pageTitle','users','notifyToUser'));
    }

    public function sendNotificationAll(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'message'                      => 'required',
            'subject'                      => 'required',
            'start'                        => 'required',
            'batch'                        => 'required',
            'being_sent_to'                => 'required',
            'user'                         => 'required_if:being_sent_to,selectedUsers',
            'number_of_top_deposited_user' => 'required_if:being_sent_to,topDepositedUsers|integer|gte:0',
            'number_of_days'               => 'required_if:being_sent_to,notLoginUsers|integer|gte:0',
        ], [
            'number_of_days.required_if'               => "Number of days field is required",
            'number_of_top_deposited_user.required_if' => "Number of top deposited user field is required",
        ]);

        if ($validator->fails()) return response()->json(['error' => $validator->errors()->all()]);
        $scope = $request->being_sent_to;
        $users = User::oldest()->active()->$scope()->skip($request->start)->limit($request->batch)->get();
        foreach ($users as $user) {
            notify($user, 'DEFAULT', [
                'subject' => $request->subject,
                'message' => $request->message,
            ]);
        }

        return response()->json([
            'total_sent' => $users->count(),
        ]);
    }

    public function list()
    {
        $query = User::active();

        if (request()->search) {
            $query->where(function ($q) {
                $q->where('email', 'like', '%' . request()->search . '%')->orWhere('username', 'like', '%' . request()->search . '%');
            });
        }
        $users = $query->orderBy('id', 'desc')->paginate(getPaginate());
        return response()->json([
            'success' => true,
            'users'   => $users,
            'more'    => $users->hasMorePages()
        ]);
    }

    public function notificationLog($id){
        $user = User::findOrFail($id);
        $pageTitle = 'Notifications Sent to '.$user->username;
        $logs = NotificationLog::where('user_id',$id)->with('user')->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.reports.notification_history', compact('pageTitle','logs','user'));
    }

    public function orders($id){
        $user = User::findOrFail($id);
        $pageTitle = $user->username .' - Orders';
        $orders = Order::where('user_id', $user->id)->orderBy('id', 'DESC')->with('invoice.payments.gateway', 'user')->paginate(getPaginate());
        return view('admin.order.all', compact('pageTitle', 'orders', 'user'));
    }

    public function invoices($id){ 
        $user = User::findOrFail($id);
        $pageTitle = $user->username .' - Invoices';
        $invoices = Invoice::where('user_id', $user->id)->orderBy('id', 'DESC')->with('order', 'user', 'payments.gateway')->paginate(getPaginate());
        return view('admin.invoice.all', compact('pageTitle', 'invoices', 'user'));
    }

    public function cancellations($id){
        $user = User::findOrFail($id);
        $pageTitle = $user->username .' - Cancellations';
        $cancelRequests = CancelRequest::where('user_id', $user->id)->orderBy('id', 'DESC')->with('service.user', 'service.product.serviceCategory')->paginate(getPaginate());
        return view('admin.cancel_request.all', compact('pageTitle', 'cancelRequests', 'user'));
    }
 
    public function services($id){
        $user = User::findOrFail($id);
        $pageTitle = $user->username .' - Services';
        $services = Hosting::where('user_id', $user->id)->orderBy('id', 'DESC')->with('product.serviceCategory', 'user')->paginate(getPaginate());
        return view('admin.services', compact('pageTitle', 'services'));
    }

    public function domains($id){
        $user = User::findOrFail($id);
        $pageTitle = $user->username .' - Domains';
        $domains = Domain::where('user_id', $user->id)->orderBy('id', 'DESC')->with('user')->paginate(getPaginate());
        return view('admin.domains', compact('pageTitle', 'domains'));
    }

    public function addNewForm(){

        $pageTitle = 'Add New Client';
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        return view('admin.users.form', compact('pageTitle','countries'));
    }

    public function addNew(Request $request){
        
        $countryData = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryArray   = (array)$countryData;
        $countries      = implode(',', array_keys($countryArray));

        $countryCode    = $request->country;
        $country        = $countryData->$countryCode->country;
        $dialCode       = $countryData->$countryCode->dial_code;
        $mobile = $request->mobile;

        $request->merge([
            'mobile'=> $dialCode.$request->mobile
        ]);

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:40',
            'lastname' => 'required|string|max:40',
            'email' => 'required|email|string|max:40|unique:users,email',
            'mobile' => 'required|string|max:40|regex:/^([0-9]*)$/|unique:users,mobile',
            'country' => 'required|in:'.$countries,
            'password' => ['required', Password::min(6)],
            'username' => 'required|unique:users|min:6',
            'country' => 'required|in:'.$countries,
        ]);
        
        if ($validator->fails()) {
            $request->merge([
                'mobile'=>$mobile
            ]);
            return back()->withErrors($validator)->withInput();
        } 

        $user = new User();
        $user->mobile = $request->mobile;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->country_code = $countryCode;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->profile_complete = 1;
        $user->address = [
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => @$country,
        ];
        $user->ev = $request->ev ? 1 : 0;
        $user->sv = $request->sv ? 1 : 0;
        $user->ts = $request->ts ? 1 : 0;
        $user->kv = $request->kv ? 1 : 0;
        $user->save();

        $notify[] = ['success', 'New client added successfully'];
        return to_route('admin.users.all')->withNotify($notify);
    }

}
