<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Admin
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
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request);
        }
        else if(Auth::check() && Auth::user()->is_admin == 0){
            // auth()->logout();
        // Redirect to a specific page or return a 403 Forbidden response
        return redirect()->route('home');
        }
        else{
            // auth()->logout();
            return redirect('/login')->withErrors(['permission'=>'You do not have permission to access Admin Panel.']);
        }
    }
}
