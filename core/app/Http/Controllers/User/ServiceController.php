<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hosting;
use App\Module\cPanel;
use App\Models\CancelRequest;
use Illuminate\Http\Request;

class ServiceController extends Controller{
    
    public function list(){
        $pageTitle = 'Service List';
        $services = Hosting::whereBelongsTo(auth()->user())->orderBy('id', 'DESC')->with('product.serviceCategory')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.service.list', compact('pageTitle', 'services'));
    }

    public function details($id){
        
        setTimeLimit();

        $service = Hosting::whereBelongsTo(auth()->user())->with('hostingConfigs.select', 'hostingConfigs.option', 'product.getConfigs.group.options')->findOrFail($id);

        $server = $service->server;
        $pageTitle = 'Service Details';

        $cPanel = new cPanel(); //The cPanel is a class
        $cPanel->username = $service->username;
        $accountSummary = $cPanel->accountSummary($service->server) ?? null;
        
        $diskUsed = @$accountSummary->diskused ?? 0;
        $diskLimit = @$accountSummary->disklimit ?? 1;

        return view($this->activeTemplate . 'user.service.details', compact('pageTitle', 'service', 'diskUsed', 'diskLimit', 'accountSummary'));
    }

    public function cancelRequest(Request $request){

        $request->validate([ 
            'id' => 'required|integer',
            'reason' => 'required',
            'cancellation_type' => 'required|in:'.CancelRequest::type(true),
        ]);

        $service = Hosting::whereBelongsTo(auth()->user())->whereDoesntHave('cancelRequest')->findOrFail($request->id);

        $cancelRequest = new CancelRequest();
        $cancelRequest->user_id = auth()->user()->id;
        $cancelRequest->hosting_id = $service->id;
        $cancelRequest->reason = $request->reason;
        $cancelRequest->type = $request->cancellation_type; 
        /**
        * For knowing about the type 
        * @see \App\Models\CancelRequest go to type method 
        */
        $cancelRequest->save();

        $notify[] = ['success', 'Your cancellation request submitted successfully'];
        return back()->withNotify($notify);
    }

}
