<?php
/**
 * Created by PhpStorm.
 * User: Tarek
 * Date: 10/4/2017
 * Time: 3:38 PM
 */

namespace App\Http\Middleware;

use Closure;

class RedirectIfAuthenticated
{

    public function handle($request, Closure $next)
    {
        if(app('session')->has('api-token') && app('session')->get('api-token') !=''){
            return redirect('/dashboard');
        }

        return $next($request);
    }

}