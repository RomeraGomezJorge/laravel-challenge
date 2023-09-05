<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Locale
{
    public function handle(Request $request, Closure $next)
    {
        $selectedLanguage = $this->getSelectedLanguage($request);

        if ($selectedLanguage) {
            app()->setLocale($selectedLanguage);
        }

        return $next($request);
    }

    private function getSelectedLanguage(Request $request)
    {
        $languages       = array_keys(config('app.languages'));
        $changeLanguage  = $request->input('change_language');
        $sessionLanguage = session('language');

        if ($changeLanguage) {
            session()->put('language', $changeLanguage);
            return $changeLanguage;
        } elseif ( in_array($sessionLanguage, $languages)) {
            return $sessionLanguage;
        }

        return null;
    }
}
