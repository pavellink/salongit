<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role > 0){
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
