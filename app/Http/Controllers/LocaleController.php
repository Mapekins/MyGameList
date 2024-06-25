<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\App;
use Illuminate\support\Facades\Session;

class LocaleController extends Controller
{
    public function setLocale($lang)
    {
        if(in_array($lang,['en','ru','lv'])){
            App::setLocale($lang);
            Session::put('locale',$lang);
        }
        return back();
    }
}
