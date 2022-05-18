<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsDemo
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
         
    if(auth()->check())
    {
        if (auth()->user()->role == 1) {
            return redirect('user_dashboard');
        }
        elseif(auth()->user()->role == 0)
        {
            return redirect('dashboard');
        }
        else
        {
            return redirect('/');
        }
    }

        return $next($request);
    }
}
