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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login/admin');
        }

        // 2. Cek apakah Role user sesuai dengan yang diminta (admin/mahasiswa/dosen)
        if (Auth::user()->role !== $role) {
            // Jika beda, tampilkan error 403 (Forbidden)
            abort(403, 'Akses Ditolak! Anda bukan ' . ucfirst($role));
        }

        return $next($request);
    }
}