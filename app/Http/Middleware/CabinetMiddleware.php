<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class CabinetMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()){
            if (Auth::user()->role > 0){
                return redirect('/calendar');
            }

            return $next($request);


        } else {
            return redirect('/')->with('success', 'Требуется авторизация на сайте!');
        }
    }
}
