<?php

namespace App\Http\Middleware;

use Closure;

class CustomCKFinderAuth
{
    public function handle($request, Closure $next)
    {
        if (\Auth::check()) {
            config(['ckfinder.authentication' => function() use ($request) {
                return true;
            }] );
        } else {
            config(['ckfinder.authentication' => function() use ($request) {
                return false;
            }] );
        }

        return $next($request);
    }
}
