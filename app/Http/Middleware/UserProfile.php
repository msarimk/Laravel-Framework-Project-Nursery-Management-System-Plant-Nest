<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserProfile
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
        $userId = (int) $request->route('id'); // Get the user ID from the route
        $user = User::Find($userId);

        if ($user === null) {
            if (Auth::check()) {
                return redirect()->back()->withErrors(['Auth' => 'User not found']);
            } else {
                return redirect()->back();
            }
        }
        elseif (Auth::check() && Auth::user()->id == $user->id) {
            return $next($request);
        }
         elseif (Auth::check()) {
            if ($user->is_admin == 1 &&  Auth::user()->is_admin == 1) {
                return redirect()->back()->withErrors(['Auth' => 'You are performing as an Administrator']);
            } else {
                return redirect()->back()->withErrors(['Auth' => 'You dont have rights to view this profile']);
            }
        }

         else {
            return redirect()->back();
        }
        
    }
}
