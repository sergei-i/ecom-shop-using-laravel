<?php

namespace App\Http\Middleware;

use Closure;
use DebugBar\DebugBar;
use Illuminate\Support\Facades\App;

class SetLocale
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
        App::setLocale(session('locale'));
        return $next($request);
    }
}
