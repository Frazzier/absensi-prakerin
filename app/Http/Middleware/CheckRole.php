<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        foreach(explode('&', $role) as $r) {
            if (isset(auth()->user()->role) && auth()->user()->role == $r) {
                return $next($request);
            }
        }

        return redirect('/login');
    }
}