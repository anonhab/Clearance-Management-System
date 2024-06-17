<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use App\Http\Middleware\CheckEmployeeID; // Import your middleware class

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        // Register middleware aliases
        $middleware->alias([
            'ensure' => \App\Http\Middleware\EnsureUserIsAuthenticated::class,
        ]);
        $middleware->alias([
            'check' => \App\Http\Middleware\CheckEmployeeID::class,
        ]);
    })
    ->withExceptions(function ($exceptions) {
        // Configure exception handling
    })
    ->create();
