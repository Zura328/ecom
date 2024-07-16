<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        if (!Auth::check() || Auth::user()->role != $role) {
            // Redirect or abort if user doesn't have the correct role
            return redirect()->route('home')->with('fail', "You don't have access on that webpage");
        }

        return $next($request);
    }
}