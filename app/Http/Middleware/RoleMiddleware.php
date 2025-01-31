<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Memastikan user sudah login dan memiliki role yang sesuai
        if (Auth::check()) {
            $role = 'admin'; // Misalnya, set role admin secara statis atau berdasarkan kondisi lain
            if (Auth::user()->role === $role) {
                return $next($request);
            }
        }

        // Jika role tidak sesuai, redirect ke halaman lain
        return redirect('/');
    }
}
