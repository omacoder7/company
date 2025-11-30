<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $availableLocales = config('app.available_locales', ['en', 'ru', 'az']);
        
        // Get locale from route parameter
        $locale = $request->route('locale');
        
        // If no locale in route, try to get from session
        if (!$locale) {
            $locale = session('locale');
        }
        
        // If no locale in session, try to get from Accept-Language header
        if (!$locale) {
            $preferredLanguage = $request->getPreferredLanguage($availableLocales);
            if ($preferredLanguage) {
                $locale = $preferredLanguage;
            }
        }
        
        // Fallback to default locale
        if (!$locale || !in_array($locale, $availableLocales)) {
            $locale = config('app.locale', 'en');
        }
        
        // Set application locale
        app()->setLocale($locale);
        
        // Store in session
        session(['locale' => $locale]);
        
        return $next($request);
    }
}

