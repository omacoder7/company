<?php

namespace App\Helpers;

class LocaleHelper
{
    /**
     * Get available locales
     */
    public static function getAvailableLocales(): array
    {
        return config('app.available_locales', ['en', 'ru', 'az']);
    }

    /**
     * Get locale name
     */
    public static function getLocaleName(string $locale): string
    {
        $names = [
            'en' => 'English',
            'ru' => 'Русский',
            'az' => 'Azərbaycan',
        ];

        return $names[$locale] ?? $locale;
    }

    /**
     * Get current locale
     */
    public static function current(): string
    {
        return app()->getLocale();
    }

    /**
     * Switch locale
     */
    public static function switch(string $locale): void
    {
        if (in_array($locale, self::getAvailableLocales())) {
            app()->setLocale($locale);
            session(['locale' => $locale]);
        }
    }

    /**
     * Generate route with current locale
     */
    public static function route(string $name, array $parameters = []): string
    {
        $locale = app()->getLocale();
        $parameters['locale'] = $locale;
        return route($name, $parameters);
    }
}

