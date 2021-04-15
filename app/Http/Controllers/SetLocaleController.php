<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocaleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  string  $locale
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $locale)
    {
        try {
            if(array_key_exists($locale, config('locale.languages'))){
                Session::put('locale', $locale);
                App::setLocale($locale);
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            return redirect()->back();
        }
    }
}
