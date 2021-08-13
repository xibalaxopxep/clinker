<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class Admin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $current_route = $request->route()->getName();
        if (strpos($current_route, 'create') !== false) {
            $parent_route = str_replace('create', 'index', $current_route);
            $method = 'create';
        } elseif (strpos($current_route, 'edit') !== false) {
            $parent_route = str_replace('edit', 'index', $current_route);
            $method = 'edit';
        } else {
            $parent_route = null;
            $method = 'index';
        }
        if (!is_null(Auth::user())) {
                if (Auth::user()->role_id <> User::ROLE_ADMINISTRATOR) {
                    if (!in_array($current_route, Auth::user()->role->route())) {
                        abort(403);
                    }
                }
                if ($parent_route == null) {
                    $parent_route = $current_route;
                }
                $config = \DB::table('config')->where('id', 1)->first();
                \View::share(['current_route' => $current_route, 'parent_route' => $parent_route, 'method' => $method, 'config' => $config]);

                session_start();
                    $_SESSION['KCFINDER'] = []; //
                    $_SESSION['KCFINDER'] = array('disabled' => false, 'uploadURL' => "/public/upload");
                return $next($request);

        } else {
            return redirect()->route('login');
        }
    }

}
