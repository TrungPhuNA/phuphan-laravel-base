<?php

use App\Http\Middleware\PermissionMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__.'/../routes/web.php',
            __DIR__.'/../routes/auth.php',
            __DIR__.'/../routes/admin.php',
        ],

        commands: __DIR__.'/../routes/console.php',
        health: '/up'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'check.login.admin' => \App\Http\Middleware\CheckLoginMiddleware::class,
            'permission'        => PermissionMiddleware::class,
            'log.requests'      => \App\Http\Middleware\LogRequestsMiddleware::class,
        ]);
//        $middleware->append(PermissionMiddleware::class);
//        $middleware->append(\App\Http\Middleware\LogRequestsMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
