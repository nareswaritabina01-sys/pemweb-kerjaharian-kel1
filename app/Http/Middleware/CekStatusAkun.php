<?php
// app/Http/Middleware/CekStatusAkun.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekStatusAkun
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && ! $user->isAktif()) {
            $pesan = $user->isBanned()
                ? 'Akun Anda telah diblokir. Hubungi admin untuk informasi lebih lanjut.'
                : 'Akun Anda dinonaktifkan. Hubungi admin untuk informasi lebih lanjut.';

            /** @var StatefulGuard $guard */
            $guard = Auth::guard();
            $guard->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', $pesan);
        }

        return $next($request);
    }
}
