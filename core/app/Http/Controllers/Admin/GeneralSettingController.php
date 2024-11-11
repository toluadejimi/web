<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\ServiceCategory;
use App\Models\ConfigurableGroup;
use App\Models\Product;
use App\Models\ServerGroup;
use App\Models\Server;
use App\Models\DomainSetup;
use App\Models\BillingSetting;
use App\Models\DomainRegister;
use App\Models\GatewayCurrency;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Image;
use Carbon\Carbon;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $pageTitle = 'General Setting';
        $timezones = json_decode(file_get_contents(resource_path('views/admin/partials/timezone.json')));
        return view('admin.setting.general', compact('pageTitle','timezones'));
    }

    public function update(Request $request)
    {   
        $request->validate([
            'site_name' => 'required|string|max:40',
            'cur_text' => 'required|string|max:40',
            'cur_sym' => 'required|string|max:40',
            'base_color' => 'nullable|regex:/^[a-f0-9]{6}$/i',
            'timezone' => 'required',
            'invoice_start' => 'required|integer|min:1',
            'invoice_increment' => 'required|integer|min:1',
            'tax' => 'required|numeric|gte:0|max:100',
        ]);
      
        $general = gs();
        $general->site_name = $request->site_name;
        $general->cur_text = $request->cur_text;
        $general->cur_sym = $request->cur_sym;
        $general->base_color = str_replace('#','',$request->base_color);

        $general->invoice_start = $request->invoice_start;
        $general->invoice_increment = $request->invoice_increment;
        $general->tax = $request->tax;

        $general->save();
 
        $timezoneFile = config_path('timezone.php');
        $content = '<?php $timezone = '.$request->timezone.' ?>';
        file_put_contents($timezoneFile, $content);
        $notify[] = ['success', 'General setting updated successfully'];
        return back()->withNotify($notify);
    }

    public function systemConfiguration(){
        $pageTitle = 'System Configuration';
        return view('admin.setting.configuration', compact('pageTitle'));
    }

    public function systemConfigurationSubmit(Request $request)
    {   
        $general = gs();
        $general->kv = $request->kv ? 1 : 0;
        $general->ev = $request->ev ? 1 : 0;
        $general->en = $request->en ? 1 : 0;
        $general->sv = $request->sv ? 1 : 0;
        $general->sn = $request->sn ? 1 : 0; 

        $general->deposit_module = $request->deposit_module ? 1 : 0; 

        $general->force_ssl = $request->force_ssl ? 1 : 0;
        $general->secure_password = $request->secure_password ? 1 : 0;
        $general->registration = $request->registration ? 1 : 0;
        $general->agree = $request->agree ? 1 : 0;

        $general->multi_language = $request->multi_language ? 1 : 0;
        $general->auto_domain_register = $request->auto_domain_register ? 1 : 0;

        $general->save();
        $notify[] = ['success', 'System configuration updated successfully'];
        return back()->withNotify($notify);
    }

    public function logoIcon()
    {
        $pageTitle = 'Logo & Favicon';
        return view('admin.setting.logo_icon', compact('pageTitle'));
    }

    public function logoIconUpdate(Request $request)
    {   
        $request->validate([
            'logo' => ['image',new FileTypeValidate(['jpg','jpeg','png'])],
            'dark_logo' => ['image',new FileTypeValidate(['jpg','jpeg','png'])],
            'favicon' => ['image',new FileTypeValidate(['png'])],
        ]);
        if ($request->hasFile('logo')) {
            try {
                $path = getFilePath('logoIcon');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->logo)->save($path . '/logo.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the logo'];
                return back()->withNotify($notify);
            }
        }
        if ($request->hasFile('dark_logo')) { 
            try {
                $path = getFilePath('logoIcon'); 
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->dark_logo)->save($path . '/dark_logo.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the dark logo'];
                return back()->withNotify($notify);
            }
        }
        if ($request->hasFile('favicon')) {
            try {
                $path = getFilePath('logoIcon');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                $size = explode('x', getFileSize('favicon'));
                Image::make($request->favicon)->resize($size[0], $size[1])->save($path . '/favicon.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the favicon'];
                return back()->withNotify($notify);
            }
        }
        $notify[] = ['success', 'Logo & favicon updated successfully'];
        return back()->withNotify($notify);
    }

    public function customCss(){
        $pageTitle = 'Custom CSS';
        $file = activeTemplate(true).'css/custom.css';
        $fileContent = @file_get_contents($file);
        return view('admin.setting.custom_css',compact('pageTitle','fileContent'));
    }


    public function customCssSubmit(Request $request){
        $file = activeTemplate(true).'css/custom.css';
        if (!file_exists($file)) {
            fopen($file, "w");
        }
        file_put_contents($file,$request->css);
        $notify[] = ['success','CSS updated successfully'];
        return back()->withNotify($notify);
    }

    public function maintenanceMode() {
        $pageTitle   = 'Maintenance Mode';
        $maintenance = Frontend::where('data_keys', 'maintenance.data')->firstOrFail();
        return view('admin.setting.maintenance', compact('pageTitle', 'maintenance'));
    }

    public function maintenanceModeSubmit(Request $request) {
        $request->validate([
            'description' => 'required',
            'heading'     => 'required',
            'image'       => ['nullable', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        $general                   = gs();
        $general->maintenance_mode = $request->status ? 1 : 0;
        $general->save();

        $maintenance = Frontend::where('data_keys', 'maintenance.data')->firstOrFail();

        if ($request->hasFile('image')) {
            try {
                $path      = getFilePath('maintenance');
                $size      = getFileSize('maintenance');
                $imageName = fileUploader($request->image, $path, $size, @$maintenance->data_values->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $dataValues  = [
            'description' => $request->description,
            'image'       => @$imageName ?? @$maintenance->data_values->image,
            'heading'     => $request->heading,
        ];
        $maintenance->data_values = $dataValues;
        $maintenance->save();

        $notify[] = ['success', 'Maintenance mode updated successfully'];
        return back()->withNotify($notify);
    }

    public function cookie(){
        $pageTitle = 'GDPR Cookie';
        $cookie = Frontend::where('data_keys','cookie.data')->firstOrFail();
        return view('admin.setting.cookie',compact('pageTitle','cookie'));
    }

    public function cookieSubmit(Request $request){
        $request->validate([
            'short_desc'=>'required|string|max:255',
            'description'=>'required',
        ]);
        $cookie = Frontend::where('data_keys','cookie.data')->firstOrFail();
        $cookie->data_values = [
            'short_desc' => $request->short_desc,
            'description' => $request->description,
            'status' => $request->status ? 1 : 0,
        ]; 
        $cookie->save();
        $notify[] = ['success','Cookie policy updated successfully'];
        return back()->withNotify($notify);
    }

    public function systemSetting(){ 
        $pageTitle = 'System Setting';
        $completed = $this->completed();
        return view('admin.setting.system', compact('pageTitle', 'completed'));
    }

    protected function completed(){
        $completed = [];
        
        $general = gs();
        $billingSetting = BillingSetting::first();

        if($general->site_name && file_exists(getFilePath('logoIcon').'/logo.png')){
            $completed['name_and_logo'] = 1;
        }

        if(ServiceCategory::first()){
            $completed['service_category'] = 1;
        }

        if(Product::first()){
            $completed['product'] = 1;
        }

        if(ConfigurableGroup::first()){
            $completed['configurable_group'] = 1;
        }

        if(Server::first()){
            $completed['server'] = 1;  
        }

        if(ServerGroup::first()){
            $completed['server_group'] = 1;
        }

        if(DomainSetup::first()){
            $completed['domain_setup'] = 1;
        }

        if(DomainRegister::where('setup_done', 1)->first()){
            $completed['domain_register'] = 1;
        }

        if($general->last_cron && Carbon::parse($general->last_cron)->diffInMinutes() < 15){
            $completed['cron'] = 1;
        }

        $array = (array) $billingSetting->create_invoice;
     
        if($billingSetting->create_default_invoice_days || $billingSetting->create_domain_invoice_days || array_filter($array)){
            $completed['billing_setting'] = 1;
        }

        if(DomainRegister::getDefault()){
            $completed['defaultDomainRegister'] = 1;
        }

        if(GatewayCurrency::first()){
            $completed['setup_gateway'] = 1;
        }

        $admin = Admin::first();
        if($admin->email && $admin->mobile && @$admin->address->address && @$admin->address->state && @$admin->address->zip && @$admin->address->country && @$admin->address->city){
            $completed['admin_profile_setup'] = 1;
        }

        return $completed;
    }

}
