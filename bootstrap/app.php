<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Mendaftarkan middleware alias agar bisa digunakan di Rute
        $middleware->alias([
            // Alias ini sudah tidak terpakai lagi dengan sistem login baru,
            // tapi kita biarkan saja agar tidak error jika masih ada sisa pemanggilan.
            'is_admin' => \App\Http\Middleware\IsAdmin::class,

            // Alias 'guest' ini SANGAT PENTING.
            // Ini memberitahu Laravel untuk menggunakan middleware RedirectIfAuthenticated
            // yang sudah kita modifikasi agar 'pintar' membedakan user dan admin.
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Bagian ini menangani kasus ketika pengguna yang BELUM LOGIN (tamu)
        // mencoba mengakses halaman yang terproteksi.
        $exceptions->render(function (AuthenticationException $e, Request $request) {

            // Cek jika halaman yang coba diakses adalah halaman admin
            if ($request->is('admin') || $request->is('admin/*')) {
                // Jika ya, maka kita paksa arahkan ke halaman login admin.
                return redirect()->guest(route('admin.login'));
            }

            // Jika bukan halaman admin, maka arahkan ke halaman login user biasa.
            return redirect()->guest(route('login'));
        });
    })->create();