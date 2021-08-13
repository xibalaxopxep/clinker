<?php

namespace App\Http\Middleware;

use Closure;


class Marketing {

    public function handle($request, Closure $next) {
        if (!is_null(\Auth::guard('marketing')->user())) {
            return $next($request);
        } else {
            return redirect()->route('home.index');
        }
    }

}
