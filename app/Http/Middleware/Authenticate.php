<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    protected function redirectTo($request)
    {
//        if (!$request->expectsJson()) {
        $edition = $request->route()->getAction('edition');
        $prefix = $request->route()->getAction('routePrefix');
        $route = is_null($edition) ? null : $edition . '.' . ($prefix . 'login');
//        dd($edition, $prefix, $route, $request->route());
        return route($route);
//        }
    }
}
