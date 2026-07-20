<?php
// app/Http/Middleware/CekPemberiKerja.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekPemberiKerja
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isPemberiKerja()) {
            abort(403, 'Akses ditolak. Halaman ini khusus untuk Pemberi Kerja.');
        }

        return $next($request);
    }
}