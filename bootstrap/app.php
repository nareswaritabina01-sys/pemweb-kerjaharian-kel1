<?php

use App\Http\Middleware\CekAdmin;
use App\Http\Middleware\CekPemberiKerja;
use App\Http\Middleware\CekPencariKerja;
use App\Http\Middleware\CekStatusAkun;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'cek.admin' => CekAdmin::class,
            'cek.pemberi-kerja' => CekPemberiKerja::class,
            'cek.pencari-kerja' => CekPencariKerja::class,
            'cek.status-akun' => CekStatusAkun::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();