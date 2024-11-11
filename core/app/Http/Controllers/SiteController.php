<?php

namespace App\Http\Controllers;

use App\DomainRegisters\Register;
use Carbon\Carbon;
use App\Models\Page;
use App\Models\Product;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Subscriber;
use App\Models\DomainSetup;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use App\Models\ServiceCategory;
use App\Models\AdminNotification;
use App\Models\DomainRegister;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller {

    public function index() {

        $reference = @$_GET['reference'];
        if ($reference) {
            session()->put('reference', $reference);
        }
        $pageTitle = 'Home';
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', '/')->first();
        return view($this->activeTemplate . 'home', compact('pageTitle', 'sections'));
    }

    public function pages($slug) {
        $page = Page::where('tempname', $this->activeTemplate)->where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
    }

    public function contact() {
        $pageTitle = "Contact";
        $user = auth()->user();
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'contact')->first();
        return view($this->activeTemplate . 'contact', compact('pageTitle', 'sections', 'user'));
    }

    public function contactSubmit(Request $request) {
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        if (!verifyCaptcha()) {
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $request->session()->regenerateToken();

        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new contact message has been submitted';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function policyPages($slug, $id) {
        $policy = Frontend::where('id', $id)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle = $policy->data_values->title;
        return view($this->activeTemplate . 'policy', compact('policy', 'pageTitle'));
    }

    public function changeLanguage($lang = null) {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return back();
    }

    public function cookieAccept() {
        Cookie::queue('gdpr_cookie',gs('site_name') , 43200);
    }

    public function cookiePolicy() {
        $pageTitle = 'Cookie Policy';
        $cookie = Frontend::where('data_keys', 'cookie.data')->first();
        return view($this->activeTemplate . 'cookie', compact('pageTitle', 'cookie'));
    }

    public function placeholderImage($size = null) {
        $imgWidth = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font/RobotoMono-Regular.ttf');
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function maintenance() {
        $pageTitle = 'Maintenance Mode';

        if (gs('maintenance_mode') == 0) {
            return to_route('home');
        }
        $maintenance = Frontend::where('data_keys', 'maintenance.data')->first();
        return view($this->activeTemplate . 'maintenance', compact('pageTitle', 'maintenance'));
    }

    public function subscribe(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:subscribers,email'
        ]);

        if (!$validator->passes()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $newSubscriber = new Subscriber();
        $newSubscriber->email = $request->email;
        $newSubscriber->save();

        return response()->json(['success' => true, 'message' => 'Thank you, we will notice you our latest news']);
    }

    public function blogs() {
        $pageTitle = 'Announcements';
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'announcements')->first();
        return view($this->activeTemplate . 'blogs', compact('pageTitle', 'sections'));
    }

    public function blogDetails($slug, $id) {
        $blog = Frontend::where('id', $id)->where('data_keys', 'blog.element')->firstOrFail();
        $pageTitle = $blog->data_values->title;
        return view($this->activeTemplate . 'blog_details', compact('blog', 'pageTitle'));
    }

    public function serviceCategory($slug = null) {

        $serviceCategory = ServiceCategory::active()->when($slug, function ($category) use ($slug) {
            $category->where('slug', $slug);
        })->firstOrFail();

        $pageTitle = $serviceCategory->name;
        return view($this->activeTemplate . 'service_category', compact('pageTitle', 'serviceCategory'));
    }

    public function productConfigure($categorySlug, $productSlug, $id) {

        $product = Product::active()->where('id', $id)->whereHas('serviceCategory', function ($category) {
            $category->active($category);
        })->whereHas('price', function ($price) {
            $price->filter($price);
        })
            ->with('getConfigs.activeGroup.activeOptions.activeSubOptions.getOnlyPrice')
            ->firstOrFail();

        $domains = [];
        $pageTitle = 'Product Configure';

        if ($product->domain_register) {
            $domains = DomainSetup::active()->orderBy('id', 'DESC')->with('pricing')->get();
        }

        return view($this->activeTemplate . 'product_configure', compact('product', 'pageTitle', 'domains'));
    } 

    public function registerDomain(Request $request) {

        setTimeLimit();

        $pageTitle = 'Register New Domain';
        $domain = strtolower($request->domain);
        $result = [];   

        if ($domain) { 
            $request->validate([
                'domain'=> ['regex:/^[a-zA-Z0-9.-]+$/']
            ]);

            $defaultDomainRegister = DomainRegister::getDefault();
            if (!$defaultDomainRegister) {
                $notify[] = ['info', 'There is no default domain register, please setup default domain register'];
                return redirect()->route('register.domain')->withNotify($notify);
            }
            $request->merge(['domain'=>$domain]);

            $register = new Register($defaultDomainRegister->alias); //The Register is a class
            $register->command = 'searchDomain';
            $register->domain = $domain;
            $execute = $register->run();

            if (!$execute['success']) {
                $notify = [];
                foreach((array) $execute['message'] as $message){
                    $notify[] = ['error', $message];
                }
                return redirect()->route('register.domain')->withNotify($notify);
            }

            if (@$execute['data']['status'] == 'ERROR') {
                $notify[] = ['error', $execute['data']['message']];
                return redirect()->route('register.domain')->withNotify($notify);
            }

            $result = $execute;
        }

        return view($this->activeTemplate . 'register_domain', compact('pageTitle', 'result'));
    }

    public function searchDomain(Request $request) {
    
        setTimeLimit();

        $validator = Validator::make($request->all(), [
            'domain' => ['required', 'regex:/^[a-zA-Z0-9.-]+$/']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=>[$validator->errors()->all()],
            ]);
        }

        $domain = strtolower($request->domain);
        $request->merge(['domain'=> $domain]);

        $defaultDomainRegister = DomainRegister::getDefault();
        if (!$defaultDomainRegister) {
            return ['success' => false, 'message' => 'There is no default domain register, Please setup default domain register'];
        }

        $register = new Register($defaultDomainRegister->alias); //The Register is a class
        $register->command = 'searchDomain';
        $register->domain = $domain;
        $execute = $register->run();

        if (!$execute['success']) {
            return ['success' => false, 'message' => $execute['message']];
        }

        if (@$execute['data']['status'] == 'ERROR') {
            return ['success' => false, 'message' => $execute['data']['message']];
        }
  
        return ['success' =>true, 'result'=>$execute];
    }

}
