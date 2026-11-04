<?php

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
        // alias middleware pembatas role petugas
        $middleware->alias([
            'role' => \App\Http\Middleware\CekRole::class,
        ]);

        // arahkan tamu (belum login) ke hidden login petugas
        $middleware->redirectGuestsTo(fn () => route('panel.login'));

        // arahkan yg sdh login menjauh dr halaman tamu
        $middleware->redirectUsersTo(fn () => route('panel.dashboard'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
