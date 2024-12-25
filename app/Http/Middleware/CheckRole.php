<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Pastikan pengguna terautentikasi
        if (!Auth::check()) {
            return redirect('/login'); // Redirect ke halaman login jika tidak login
        }

        // Periksa peran pengguna
        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized access'); // Tampilkan pesan akses ditolak
        }

        return $next($request);
    }
}
