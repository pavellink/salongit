<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role && Auth::user()->role < 10){
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
