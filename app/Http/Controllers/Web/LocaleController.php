<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Switch application locale
     */
    public function switch(Request $request, string $locale)
    {
        $availableLocales = config('app.available_locales', ['en', 'ru', 'az']);
        
        if (!in_array($locale, $availableLocales)) {
            $locale = config('app.locale', 'en');
        }
        
        // Set locale in session
        session(['locale' => $locale]);
        app()->setLocale($locale);
        
        // Get redirect URL
        $redirectTo = $request->get('redirect', route('home', ['locale' => $locale]));
        
        // Parse the URL to extract path
        $parsedUrl = parse_url($redirectTo);
        $path = $parsedUrl['path'] ?? '/';
        
        // Remove existing locale from path if present
        foreach ($availableLocales as $loc) {
            $path = preg_replace('#^/' . $loc . '(/?)#', '/', $path);
        }
        
        // Add new locale to path
        if ($path === '/' || $path === '') {
            $newPath = '/' . $locale . '/';
        } else {
            $newPath = '/' . $locale . $path;
        }
        
        // Reconstruct URL with port
        $scheme = $parsedUrl['scheme'] ?? request()->getScheme();
        $host = $parsedUrl['host'] ?? request()->getHost();
        $port = $parsedUrl['port'] ?? request()->getPort();
        $query = isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '';
        $fragment = isset($parsedUrl['fragment']) ? '#' . $parsedUrl['fragment'] : '';
        
        // Build URL with port if needed (not default ports)
        $portPart = ($port && !in_array($port, [80, 443])) ? ':' . $port : '';
        $newUrl = $scheme . '://' . $host . $portPart . $newPath . $query . $fragment;
        
        return redirect($newUrl);
    }
}

