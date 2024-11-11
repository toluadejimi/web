<?php

use App\Lib\GoogleAuthenticator;
use App\Models\Extension;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\ShoppingCart;
use Carbon\Carbon;
use App\Lib\Captcha;
use App\Lib\ClientInfo;
use App\Lib\CurlRequest;
use App\Lib\FileManager;
use App\Models\Role;
use App\Notify\Notify;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

function systemDetails() {
    $system['name'] = 'whmlab';
    $system['version'] = '1.2';
    $system['build_version'] = '4.4.7';
    return $system;
}

function slug($string) {
    return Illuminate\Support\Str::slug($string);
}

function verificationCode($length) {
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = (int) ($min - 1) . '9';
    return random_int($min, $max);
}

function getNumber($length = 8) {
    $characters = '1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function activeTemplate($asset = false) {
    $template = gs('active_template');
    if ($asset) return 'assets/templates/' . $template . '/';
    return 'templates.' . $template . '.';
}

function activeTemplateName() {
    $template = gs('active_template');
    return $template;
}

function loadReCaptcha() {
    return Captcha::reCaptcha();
}

function loadCustomCaptcha($width = '100%', $height = 46, $bgColor = '#003') {
    return Captcha::customCaptcha($width, $height, $bgColor);
}

function verifyCaptcha() {
    return Captcha::verify();
}

function loadExtension($key) {
    $extension = Extension::where('act', $key)->where('status', 1)->first();
    return $extension ? $extension->generateScript() : '';
}

function getTrx($length = 12) {
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getAmount($amount, $length = 2) {
    $amount = round($amount ?? 0, $length);
    return $amount + 0;
}

function showAmount($amount, $decimal = 2, $separate = true, $exceptZeros = false) {
    $separator = '';
    if ($separate) {
        $separator = ',';
    }
    $printAmount = number_format($amount, $decimal, '.', $separator);
    if ($exceptZeros) {
        $exp = explode('.', $printAmount);
        if ($exp[1] * 1 == 0) {
            $printAmount = $exp[0];
        } else {
            $printAmount = rtrim($printAmount, '0');
        }
    }
    return $printAmount;
}


function removeElement($array, $value) {
    return array_diff($array, (is_array($value) ? $value : array($value)));
}

function cryptoQR($wallet) {
    return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$wallet&choe=UTF-8";
}


function keyToTitle($text) {
    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}


function titleToKey($text) {
    return strtolower(str_replace(' ', '_', $text));
}


function strLimit($title = null, $length = 10) {
    return Str::limit($title, $length);
}


function getIpInfo() {
    $ipInfo = ClientInfo::ipInfo();
    return $ipInfo;
}


function osBrowser() {
    $osBrowser = ClientInfo::osBrowser();
    return $osBrowser;
}


function getTemplates() {
    $param['purchasecode'] = env("PURCHASECODE");
    $param['website'] = @$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'] . ' - ' . env("APP_URL");
    $url = 'https://license.viserlab.com/updates/templates/' . systemDetails()['name'];
    $response = CurlRequest::curlPostContent($url, $param);
    if ($response) {
        return $response;
    } else {
        return null;
    }
}


function getPageSections($arr = false) {
    $jsonUrl = resource_path('views/') . str_replace('.', '/', activeTemplate()) . 'sections.json';
    $sections = json_decode(file_get_contents($jsonUrl));
    if ($arr) {
        $sections = json_decode(file_get_contents($jsonUrl), true);
        ksort($sections);
    }
    return $sections;
}


function getImage($image, $size = null) {
    $clean = '';
    if (file_exists($image) && is_file($image)) {
        return asset($image) . $clean;
    }
    if ($size) {
        return route('placeholder.image', $size);
    }
    return asset('assets/images/default.png');
}


function notify($user, $templateName, $shortCodes = null, $sendVia = null, $createLog = true) {
    $general = gs();
    $globalShortCodes = [
        'site_name' => $general->site_name,
        'site_currency' => $general->cur_text,
        'currency_symbol' => $general->cur_sym,
    ];

    if (gettype($user) == 'array') {
        $user = (object) $user;
    }

    $shortCodes = array_merge($shortCodes ?? [], $globalShortCodes);

    $notify = new Notify($sendVia);
    $notify->templateName = $templateName;
    $notify->shortCodes = $shortCodes;
    $notify->user = $user;
    $notify->createLog = $createLog;
    $notify->userColumn = isset($user->id) ? $user->getForeignKey() : 'user_id';
    $notify->send();
}

function getPaginate($paginate = 20) {
    return $paginate;
}

function paginateLinks($data) {
    return $data->appends(request()->all())->links();
}

function menuActive($routeName, $type = null, $param = null) {
    if ($type == 3) $class = 'side-menu--open';
    elseif ($type == 2) $class = 'sidebar-submenu__open';
    else $class = 'active';

    if (is_array($routeName)) {
        foreach ($routeName as $key => $value) {
            if (request()->routeIs($value)) return $class;
        }
    } elseif (request()->routeIs($routeName)) {
        if ($param) {
            $routeParam = array_values(@request()->route()->parameters ?? []);
            if (strtolower(@$routeParam[0]) == strtolower($param)) return $class;
            else return;
        }
        return $class;
    }
}

function fileUploader($file, $location, $size = null, $old = null, $thumb = null) {
    $fileManager = new FileManager($file);
    $fileManager->path = $location;
    $fileManager->size = $size;
    $fileManager->old = $old;
    $fileManager->thumb = $thumb;
    $fileManager->upload();
    return $fileManager->filename;
}

function fileManager() {
    return new FileManager();
}

function getFilePath($key) {
    return fileManager()->$key()->path;
}

function getFileSize($key) {
    return fileManager()->$key()->size;
}

function getFileExt($key) {
    return fileManager()->$key()->extensions;
}

function diffForHumans($date) {
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->diffForHumans();
}


function showDateTime($date, $format = 'Y-m-d h:i A') {
    if (!$date) {
        return false;
    }

    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}


function getContent($dataKeys, $singleQuery = false, $limit = null, $orderById = false) {
    if ($singleQuery) {
        $content = Frontend::where('data_keys', $dataKeys)->orderBy('id', 'desc')->first();
    } else {
        $article = Frontend::query();
        $article->when($limit != null, function ($q) use ($limit) {
            return $q->limit($limit);
        });
        if ($orderById) {
            $content = $article->where('data_keys', $dataKeys)->orderBy('id')->get();
        } else {
            $content = $article->where('data_keys', $dataKeys)->orderBy('id', 'desc')->get();
        }
    }
    return $content;
}


function gatewayRedirectUrl($type = false) {
    if ($type) {
        return 'user.deposit.history';
    } else {
        return 'user.deposit.index';
    }
}

function verifyG2fa($user, $code, $secret = null) {
    $authenticator = new GoogleAuthenticator();
    if (!$secret) {
        $secret = $user->tsc;
    }
    $oneCode = $authenticator->getCode($secret);
    $userCode = $code;
    if ($oneCode == $userCode) {
        $user->tv = 1;
        $user->save();
        return true;
    } else {
        return false;
    }
}


function urlPath($routeName, $routeParam = null) {
    if ($routeParam == null) {
        $url = route($routeName);
    } else {
        $url = route($routeName, $routeParam);
    }
    $basePath = route('home');
    $path = str_replace($basePath, '', $url);
    return $path;
}


function showMobileNumber($number) {
    $length = strlen($number);
    return substr_replace($number, '***', 2, $length - 4);
}

function showEmailAddress($email) {
    $endPosition = strpos($email, '@') - 1;
    return substr_replace($email, '***', 1, $endPosition);
}


function getRealIP() {
    $ip = $_SERVER["REMOTE_ADDR"];

    //Deep detect ip
    if (filter_var(@$_SERVER['HTTP_FORWARDED'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED'];
    }
    if (filter_var(@$_SERVER['HTTP_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_X_REAL_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if ($ip == '::1') {
        $ip = '127.0.0.1';
    }

    return $ip;
}


function appendQuery($key, $value) {
    return request()->fullUrlWithQuery([$key => $value]);
}


function dateSort($a, $b) {
    return strtotime($a) - strtotime($b);
}

function dateSorting($arr) {
    usort($arr, "dateSort");
    return $arr;
}

function gs($key = null)
{
    $general = Cache::get('GeneralSetting');
    if (!$general) {
        $general = GeneralSetting::first();
        Cache::put('GeneralSetting', $general);
    }
    if ($key) return @$general->$key;
    return $general;
}

function isImage($string){
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    $fileExtension = pathinfo($string, PATHINFO_EXTENSION);
    if (in_array($fileExtension, $allowedExtensions)) {
        return true;
    } else {
        return false;
    }
}

function isHtml($string)
{
    if (preg_match('/<.*?>/', $string)) {
        return true;
    } else {
        return false;
    }
}

function productType() {
    $array = [
        1 => 'Shared Hosting',
        2 => 'Reseller Hosting',
        3 => 'Server/VPS',
        4 => 'Other',
    ];

    return $array;
}

function productModule() {
    try {
        $array = [
            0 => 'None',
            1 => 'cPanel',
        ];

        return $array;
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

function productModuleOptions() {
    try {
        $array = [
            1 => 'Automatically setup the product as soon as the first payment is received',
            2 => 'Automatically setup the product when you manually accept a pending order',
            3 => 'Do not automatically setup this product',
        ];

        return $array;
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

function welcomeEmail() {
    try {

        $array = [
            1 => ['name' => 'Hosting Account Welcome Email', 'act' => 'HOSTING_ACCOUNT'],
            2 => ['name' => 'Reseller Account Welcome Email', 'act' => 'RESELLER_ACCOUNT'],
            3 => ['name' => 'Dedicated/VPS Server Welcome Email', 'act' => 'VPS_SERVER'],
            4 => ['name' => 'Other Product/Service Welcome Email', 'act' => 'OTHER_PRODUCT'],
        ];

        return $array;
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

function billingCycle($period = null, $showNextDate = false) {
    try {

        $array = [
            0 => ['billing_cycle' => 'one_time', 'showText' => 'One Time', 'carbon' => null, 'index' => 0],
            1 => ['billing_cycle' => 'monthly', 'carbon' => Carbon::now()->addMonth()->toDateTimeString(), 'showText' => 'Monthly', 'index' => 1],
            2 => ['billing_cycle' => 'quarterly', 'carbon' => Carbon::now()->addMonth(3)->toDateTimeString(), 'showText' => 'Quarterly', 'index' => 2],
            3 => ['billing_cycle' => 'semi_annually', 'carbon' => Carbon::now()->addMonth(6)->toDateTimeString(), 'showText' => 'Semi Annually', 'index' => 3],
            4 => ['billing_cycle' => 'annually', 'carbon' => Carbon::now()->addYear()->toDateTimeString(), 'showText' => 'Annually', 'index' => 4],
            5 => ['billing_cycle' => 'biennially', 'carbon' => Carbon::now()->addYear(2)->toDateTimeString(), 'showText' => 'Biennially', 'index' => 5],
            6 => ['billing_cycle' => 'triennially', 'carbon' => Carbon::now()->addYear(3)->toDateTimeString(), 'showText' => 'Triennially', 'index' => 6]
        ];

        if (!is_numeric($period) && !$showNextDate) {
            return $array;
        }

        foreach ($array as $index => $data) {

            $type = $data['billing_cycle'];

            if (is_numeric($period)) {
                $type = $index;
            }

            if ($type == $period) {

                if ($showNextDate) {
                    return $data;
                }

                return $index;
            }
        }
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

function xmlToArray($xml) {
    $xml = simplexml_load_string($xml);
    $json = json_encode($xml);
    $array = json_decode($json, true);

    return $array;
}

function nl22br($text) {
    return preg_replace("/<br\W*?\/>/", "\n", $text);
}

function pricing($billingCycle = null, $price = null, $type = null, $showText = false, $column = null) {
    try {

        $array = [
            1 => ['setupFee' => 'monthly_setup_fee', 'price' => 'monthly'],
            2 => ['setupFee' => 'quarterly_setup_fee', 'price' => 'quarterly'],
            3 => ['setupFee' => 'semi_annually_setup_fee', 'price' => 'semi_annually'],
            4 => ['setupFee' => 'annually_setup_fee',  'price' => 'annually'],
            5 => ['setupFee' => 'biennially_setup_fee', 'price' => 'biennially'],
            6 => ['setupFee' => 'triennially_setup_fee', 'price' => 'triennially']
        ];

        if (!$price) {
            return implode(',', array_column($array, 'price'));
        }

        if (!$type) {
            $general = gs();
            $options = null;

            foreach ($array as $data) {
                $setupFee = null;
                $getColumn = $data['price'];
                $getFeeColumn = $data['setupFee'];

                if ($billingCycle && $billingCycle == 1) {
                    if ($price->monthly_setup_fee > 0) {
                        $setupFee .= ' + ' . $general->cur_sym . getAmount($price->monthly_setup_fee) . ' ' . $general->cur_text . ' Setup Fee';
                    }

                    $options .= '<option value="monthly">' .
                        $general->cur_sym . getAmount($price->monthly) . ' ' . $general->cur_text .
                        $setupFee
                        . '</option>';

                    return $options;
                }

                if ($price->$getColumn >= 0) {

                    if ($price->$getFeeColumn > 0) {
                        $setupFee .= ' + ' . $general->cur_sym . getAmount($price->$getFeeColumn) . ' ' . $general->cur_text . ' Setup Fee';
                    }

                    $options .= '<option value="' . $getColumn . '">' .
                        $general->cur_sym . getAmount($price->$getColumn) . ' ' . $general->cur_text . ' ' . ucwords(str_replace('_', ' ', $getColumn)) . ' ' .
                        $setupFee
                        . '</option>';
                }
            }

            return $options;
        }

        foreach ($array as $data) {

            $getColumn = $data['price'];

            if ($column) {
                if ($type == 'price') {
                    return getAmount($price->$column);
                } else {
                    $column = $column . '_setup_fee';
                    return getAmount($price->$column);
                }
            }

            if ($billingCycle && $billingCycle == 1) {
                if ($showText) {
                    if ($type == 'price') {
                        return 'One Time';
                    }
                    return 'Setup Fee';
                }

                if ($type == 'price') {
                    return getAmount($price->monthly);
                }

                return getAmount($price->monthly_setup_fee);
            }

            if ($price->$getColumn >= 0) {

                if ($showText) {
                    if ($type == 'price') {
                        $replace = str_replace('_', ' ', $getColumn);
                        return ucwords($replace);
                    }
                    return 'Setup Fee';
                }

                if ($type == 'price') {
                    return getAmount($price->$getColumn);
                }

                $getColumn = $data[$type];
                return getAmount($price->$getColumn);
            }
        }
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

//Infinite execution time for the PHP
function setTimeLimit() {
    //Both are the almost same but depend on the server
    set_time_limit(0);
    ini_set('max_execution_time', 0);
}

function randomId(){
    $id = date('shdy');
    $cart = ShoppingCart::orderBy('id', 'DESC')->first();

    if($cart){
        $id = $id.$cart->id;
    }else{
        $id = $id.rand(10, 99);
    }

    return $id;
}

function getTld($domain){
    $domain = strtolower($domain);
    $explode = explode('.', $domain);

    if(count($explode) > 1){
        array_shift($explode);
        return '.'.implode('.', $explode);
    }

    return null;
}

function getSld($domain){
    $domain = strtolower($domain);
    return explode('.', $domain)[0];
}

function permit($code)
{
    return Role::hasPermission($code);
}

function camelCaseToNormal($str) {
    return preg_replace('/(?<!^)([A-Z])/', ' $1', $str);
}

function isSuperAdmin(){
    return auth('admin')->id() == 1 ? true : false;
}
