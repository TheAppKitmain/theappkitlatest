<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Template
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

        if(Auth::User()->role->name == "custom"){

            if(Auth::User()->parent_id == 0)
            {
                return redirect()->route('home.index');
            }
            else
            {
                Auth::loginUsingId(Auth::User()->parent_id);
                return redirect()->route('home.index');
            }  
        }

        if(Auth::User()->role->name == "template"){
            
            if(Auth::User()->parent_id == 0)
            {
                return redirect()->route('dashboard.index');
            }
            else
            {
                Auth::loginUsingId(Auth::User()->parent_id);
                return redirect()->route('dashboard.index');
            } 
        }

        if(Auth::User()->role->name == "admin"){
            return redirect()->route('admin.index');
        }

        if(Auth::User()->role->name == "developer"){
            return redirect()->route('dev-dashboard.index');
        }
    }
}
