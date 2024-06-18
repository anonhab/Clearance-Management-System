<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use App\Http\Middleware\CheckEmployeeID;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        // Register middleware aliases
        $middleware->alias([
            'stake' => \App\Http\Middleware\StakeholderMiddleware::class,
            'boss' => \App\Http\Middleware\BossMiddleware::class,
            'emp' => \App\Http\Middleware\EmployeeMiddleware::class,
            'admin'=>\App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function ($exceptions) {
        // Configure exception handling
    })
    ->create();
