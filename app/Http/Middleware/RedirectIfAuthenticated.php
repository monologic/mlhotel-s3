<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /*
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->usuariotipo->nombre != "Root") {
                if (Auth::user()->usuariotipo->nombre == "Administrador") 
                    return redirect('admin#');
                else
                    return redirect('admin#/user');
            }
            else{
                return redirect('admin#/root');
            }
        }*/
        if (Auth::guard($guard)->check()) {   
            return redirect('admin');
        }

        return $next($request);
    }
}
