<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    private const GUARD_USER = 'user';
    private const GUARD_ADMIN = 'admin';
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
//        if (Auth::guard($guard)->check()) {
//            return redirect(RouteServiceProvider::HOME);
//        }
        if(Auth::guard(self::GUARD_USER)->check() && $request->routeIs('user.*')){
            return redirect(RouteServiceProvider::HOME);
        }

        if(Auth::guard(self::GUARD_ADMIN)->check() && $request->routeIs('admin.*')){
            return redirect(RouteServiceProvider::ADMIN_HOME);
        }
        return $next($request);
    }
}
