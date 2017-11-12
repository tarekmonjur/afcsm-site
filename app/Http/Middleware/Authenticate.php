<?php

namespace App\Http\Middleware;

use Closure;

class Authenticate
{

    public function handle($request, Closure $next)
    {
        if(!app('session')->has('api-token') || app('session')->get('api-token') ==''){
            return redirect('/');
        }

        return $next($request);
    }
}
