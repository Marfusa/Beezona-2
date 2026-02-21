<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 👇👇👇 ЦЕЙ БЛОК НАЙВАЖЛИВІШИЙ 👇👇👇
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);
        // 👆👆👆 БЕЗ НЬОГО МОВА НЕ ПЕРЕМИКАТИМЕТЬСЯ
        
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();