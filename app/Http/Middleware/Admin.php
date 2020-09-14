<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if(Auth::check() &&  (auth()->user()->role == 1 or auth()->user()->role == 2)){
            return $next($request);
        }
        return redirect('home')->with('error',"You don't have admin access.");
    }
}
