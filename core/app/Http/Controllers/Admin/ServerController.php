<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Server;
use App\Models\ServerGroup;
use App\Module\cPanel;
use Validator;

class ServerController extends Controller{
     
    public function groupsServer(){ 
        $pageTitle = 'Server Groups';
        $groups = ServerGroup::paginate(getPaginate());
        return view('admin.server.group',compact('pageTitle', 'groups')); 
    }
 
    public function addGroupServer(Request $request){ 
      
        $request->validate([
    		'name' => 'required|max:255',
    	]);
        
        $group = new ServerGroup();
        $group->name = $request->name;
        $group->save();

        $notify[] = ['success', 'Server group added successfully'];
	    return back()->withNotify($notify);
    }  
 
    public function updateGroupServer(Request $request){
 
        $request->validate([
    		'id' => 'required|integer',
    		'name' => 'required|max:255',
    	]);

        $group = ServerGroup::findOrFail($request->id);
        $group->name = $request->name;
        $group->save();

        $notify[] = ['success', 'Server group updated successfully'];
	    return back()->withNotify($notify);
    } 

    public function servers(){
        $pageTitle = 'All Servers';
        $servers = Server::with('group')->paginate(getPaginate());
        return view('admin.server.all',compact('pageTitle', 'servers'));
    } 
    
    public function addServerPage(){
        $pageTitle = 'New Server';
        $groups = ServerGroup::active()->orderBy('id', 'DESC')->get();
        return view('admin.server.add',compact('pageTitle', 'groups'));
    }
 
    public function addServer(Request $request){
   
        $request->validate([
    		'name' => 'required|max:255',
    		'host' => 'required',
    		'protocol' => 'required|in:https://,http://',
    		'port' => 'required',
    		'username' => 'required',
    		'password' => 'required',
    		'api_token' => 'required',
    		'security_token' => 'required',
    		'server_group_id' => 'required|integer|exists:server_groups,id',
            'ns1' => 'required',
    		'ns1_ip' => 'required',
    		'ns2' => 'required',
    		'ns2_ip' => 'required', 
    	]);

        $hostname = $request->protocol.$request->host.':'.$request->port;

        $cPanel = new cPanel(); //The cPanel is a class
        $cPanel->hostname = $hostname;
        $cPanel->username = $request->username;
        $cPanel->password = $request->password;
        $cPanel->apiToken = $request->api_token;
        $cPanel->securityToken = $request->security_token;
        $getIp = $cPanel->getIp();
        $execute = $cPanel->whm();

        if(!@$execute['success']){
            $notify[] = ['error', @$execute['message']];
            return back()->withNotify($notify);
        }

        $server = new Server();  //0 => None, 1 => cPanel
        $server->type = 'cPanel'; 
        $server->server_group_id = $request->server_group_id;

        $server->protocol = $request->protocol;
        $server->host = $request->host;
        $server->port = $request->port;

        $server->name = $request->name;
        $server->hostname = $hostname;
        $server->username = $request->username;
        $server->password = $request->password;
        $server->api_token = $request->api_token;
        $server->security_token = $request->security_token;

        $server->ns1 = $request->ns1;
        $server->ns1_ip = $request->ns1_ip;
        $server->ns2 = $request->ns2;
        $server->ns2_ip = $request->ns2_ip;
        $server->ns3 = $request->ns3;
        $server->ns3_ip = $request->ns3_ip;
        $server->ns4 = $request->ns4;
        $server->ns4_ip = $request->ns4_ip;

        $server->ip_address = $getIp;

        $server->status = 1;
        $server->save();

        $notify[] = ['success', 'Server added successfully'];
	    return redirect()->route('admin.server.edit.page', $server->id)->withNotify($notify);
    }

    public function editServerPage($id){
        $server = Server::findOrFail($id);
        $pageTitle = 'Update Server';
        $groups = ServerGroup::active()->orderBy('id', 'DESC')->get();
        return view('admin.server.edit',compact('pageTitle', 'groups', 'server'));
    } 

    public function updateServer(Request $request){
  
        $request->validate([
    		'id' => 'required|integer',
    		'name' => 'required|max:255',
            'host' => 'required',
            'protocol' => 'required|in:https://,http://',
            'port' => 'required',
    		'username' => 'required',
    		'password' => 'required',
    		'api_token' => 'required',
            'security_token' => 'required',
    		'server_group_id' => 'required|integer|exists:server_groups,id',
            'ns1' => 'required',
    		'ns1_ip' => 'required',
    		'ns2' => 'required',
    		'ns2_ip' => 'required', 
    	]);

        $hostname = $request->protocol.$request->host.':'.$request->port;
        $server = Server::findOrFail($request->id);

        $cPanel = new cPanel(); //The cPanel is a class
        $cPanel->hostname = $hostname;
        $cPanel->username = $request->username;
        $cPanel->password = $request->password;
        $execute = $cPanel->whm();

        if(!@$execute['success']){
            $notify[] = ['error', @$execute['message']];
            return back()->withNotify($notify);
        }

        $server->server_group_id = $request->server_group_id;

        $server->protocol = $request->protocol;
        $server->host = $request->host;
        $server->port = $request->port;

        $server->name = $request->name;
        $server->hostname = $hostname;
        $server->username = $request->username;
        $server->password = $request->password;
        $server->api_token = $request->api_token;
        $server->security_token = $request->security_token;

        $server->ns1 = $request->ns1;
        $server->ns1_ip = $request->ns1_ip;
        $server->ns2 = $request->ns2;
        $server->ns2_ip = $request->ns2_ip;
        $server->ns3 = $request->ns3;
        $server->ns3_ip = $request->ns3_ip;
        $server->ns4 = $request->ns4;
        $server->ns4_ip = $request->ns4_ip;

        $server->ip_address = $request->ip_address;
        $server->save();

        $notify[] = ['success', 'Server updated successfully'];
	    return back()->withNotify($notify);
    } 
 
    public function testConnection(Request $request){

        $validator = Validator::make($request->all(), [
    		'hostname' => 'required|url',
    		'username' => 'required',
    		'password' => 'required',
        ]);

        if (!$validator->passes()) {
            return ['success'=>false, 'error'=>$validator->errors()];
        }

        $hostname = $request->hostname;

        if(substr($hostname, -5) != ':2087'){
            $hostname = $hostname.':2087';
        }

        $cPanel = new cPanel(); //The cPanel is a class
        $cPanel->hostname = $hostname;
        $cPanel->username = $request->username;
        $cPanel->password = $request->password;
        $execute = $cPanel->whm();
        
        if($execute['success'] == true){
            return ['success'=>true];
        }

        return ['success'=>false, 'message'=>$execute['message']];
    }

    public function loginWhm($id){
        $server = Server::findOrFail($id);

        $cPanel = new cPanel(); //The cPanel is a class
        $cPanel->hostname = $server->hostname;
        $cPanel->username = $server->username;
        $cPanel->password = $server->password;
        $execute = $cPanel->whm(true);
      
        if(!$execute['success']){
            $notify[] = ['error', $execute['message']];
            return back()->withNotify($notify);
        }

        return back()->with('url', $execute['url']);
    }

    public function groupServerStatus($id){
        return ServerGroup::changeStatus($id);
    }

    public function serverStatus($id){
        return Server::changeStatus($id);
    }

} 

 