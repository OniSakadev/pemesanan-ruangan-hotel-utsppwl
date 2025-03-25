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
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan pengguna sudah login
        if (Auth::check() && Auth::user()->usertype == 'user') {
            return $next($request);
        }

        // Jika tidak memiliki akses, arahkan kembali
        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
