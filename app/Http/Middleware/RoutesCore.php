<?php

namespace App\Http\Middleware;

use Closure;
use App\Hotel;

use Illuminate\Support\Facades\Auth;

class RoutesCore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $checked = \Session::get('checked');
        if ( $checked['checked'] == 0) {
            return redirect('incomplete');
        }
        if ( $checked['checked'] == 2) {
            return redirect('expired');
        }
        return $next($request);
    }
}
