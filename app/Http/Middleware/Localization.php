<?php

namespace App\Http\Middleware;

use App\Repositories\AppSettingsRepository;

use Closure;
use App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        } else {
            App::setLocale(session()->put('locale', 'en'));
        }
        return $next($request);
    }
}
