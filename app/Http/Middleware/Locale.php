<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $configLanguages = config('locale.languages');
        if (config('locale.status')) {
            $sessionLocale = Session::get('locale');
            if (Session::has('locale') and \array_key_exists($sessionLocale, $configLanguages)) {
                App::setLocale($sessionLocale);
            } else {
                $userLanguages = preg_split('/[,;]/', $request->server('HTTP_ACCEPT_LANGUAGE'));
                foreach ($userLanguages as $language) {
                    if (\array_key_exists($language, $configLanguages)) {
                        App::setLocale($language);
                        \setlocale(LC_TIME, $configLanguages[$language][2]);
                        Carbon::setLocale($configLanguages[$language][0]);
                        if ($configLanguages[$language][2]) {
                            \session(['lang-rtl' => true]);
                        } else {
                            Session::forget('lang-rtl');
                        }
                        break;
                    }
                }
            }
        }

        return $next($request);
    }
}
