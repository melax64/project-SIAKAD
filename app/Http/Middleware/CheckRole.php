<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah user memiliki role yang sesuai
        // Asumsi: di tabel users ada kolom 'role' atau 'usertype'
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        // Jika role tidak cocok, lempar error 403 atau redirect
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}