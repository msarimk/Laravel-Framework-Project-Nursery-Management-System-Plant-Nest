<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin == 0) {
            return $next($request);
        }
        else if(Auth::check() && Auth::user()->is_admin == 1){
            return redirect()->back()->withErrors(['notAuth'=>'You are performing as an Administrator.']);
        }
        else{
            return redirect()->back()->withErrors(['notAuth'=>'Please Login First Then Continue For Shopping Thank You.']);
        }
    }
}
