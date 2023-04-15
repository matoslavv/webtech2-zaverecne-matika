<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function changeLocale($locale)
    {
        if (in_array($locale, config('app.supported_locales'))) {
            session()->put('locale', $locale);
            App::setLocale($locale);
            return redirect()->back();
        } else {
            abort(400);
        }
    }
}
