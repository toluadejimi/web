<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Laramin\Utility\Onumoti;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $activeTemplate;

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();

        $className = get_called_class();
        Onumoti::mySite($this,$className);

        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if ($user && session()->has('randomId')) {  
                ShoppingCart::where('user_id', session()->get('randomId'))->update(['user_id' => $user->id]);
                session()->forget('randomId');
            }
            return $next($request);
        });

    }
}
