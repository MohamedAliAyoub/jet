<?php

namespace App\Http\Middleware;

use App\Services\LanguageService;
use Closure;

class HandleLanguageMiddleware
{
    public function handle($request, Closure $next, string $guard)
    {
        $language = ($guard === 'api')
        ? $request->header('Accept-Language')
        : session('locale');

        $locale = (new LanguageService)->getValidLocale($language);

        app()->setLocale($locale);

        return $next($request);
    }
}
