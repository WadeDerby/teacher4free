<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->scope == 1){
                return redirect('teacher/' .Auth::user()->username. '');
            }elseif (Auth::user()->scope == 2) {
                return redirect('school/' .Auth::user()->username. '');
            }else{
                return redirect('/');
            }
        }

        return $next($request);
    }
}
