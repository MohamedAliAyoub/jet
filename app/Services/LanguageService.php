<?php

namespace App\Services;

class LanguageService
{
    public function getValidLocale(?string $language): string
    {
        return in_array($language, ['ar', 'en'])
            ? $language
            : config('app.locale');
    }
}
