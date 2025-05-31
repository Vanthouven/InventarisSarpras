<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckFirstUserOrAdmin
{
    /**
     * Handle an incoming request.
     * 
     * - Jika tabel `users` BELUM punya satupun baris (User::count() === 0),
     *   biarkan akses publik (return $next()).
     * - Jika sudah ada user, periksa:
     *     • Jika belum login → redirect ke halaman login.
     *     • Jika login tapi role ≠ 'admin' → abort(403).
     *     • Jika login & role = 'admin' → biarkan akses.
     */
    public function handle(Request $request, Closure $next)
    {
        // 1) Cek jumlah user
        if (User::count() === 0) {
            // Tabel users masih kosong → akses publik
            return $next($request);
        }

        // 2) Tabel sudah punya user → harus sudah login
        if (! $request->user()) {
            // Tidak login → redirect ke login
            return redirect()->route('login');
        }

        // 3) Jika sudah login, periksa role-nya
        if ($request->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        // 4) Kalau sudah login & role = admin → biarkan akses
        return $next($request);
    }
}
