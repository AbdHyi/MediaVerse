<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // Lapisan 1: pastikan user sudah login
        // (redundant dengan middleware 'auth', tapi aman sebagai pengaman kedua)
        if (! $user) {
            abort(403, 'Anda harus login untuk mengakses halaman ini.');
        }

        // Lapisan 2: pastikan akun masih aktif
        // Menangkap kasus: akun dinonaktifkan SETELAH user sudah login (sesi lama)
        if (! $user->is_active) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            abort(403, 'Akun Anda telah dinonaktifkan. Hubungi administrator.');
        }

        // Lapisan 3: pastikan role sesuai daftar yang diizinkan
        if (! in_array($user->role, $roles, true)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}