<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminAuthenticated
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
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if(Auth::User()->role->name == "admin"){
            return $next($request);
        }

        if(Auth::User()->role->name == "custom"){
            
            return redirect()->route('home.index');

        }

        if(Auth::User()->role->name == "template"){

            return redirect()->route('dashboard.index');

        }

        if(Auth::User()->role->name == "developer"){
            return redirect()->route('dev-dashboard.index');
        }
    }
}
