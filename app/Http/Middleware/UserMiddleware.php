<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin' && $request->is('user/*')) {
                return redirect('/admin/dashboard');
            } elseif (Auth::user()->role == 'user' && $request->is('admin/*')) {
                return redirect('/dashboard');
            }
        }
        return $next($request);
    }
    
}
