<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
   ->withMiddleware(function (Middleware $middleware) {
    // Global middleware
    $middleware->web(append: [
        // Remove this line: \App\Http\Middleware\HandleInertiaRequests::class,
        // ... other web middleware
    ]);

    $middleware->api(prepend: [
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        // ... other API middleware
    ]);

    // Middleware aliases
    $middleware->alias([
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        // Your custom middleware aliases:
        'role' => \App\Http\Middleware\CheckRole::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);

        

        // Middleware groups can be extended
        // $middleware->group('web', [...]);
        // $middleware->group('api', [...]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Exception handling
        $exceptions->dontReport([
            // ... exceptions not to report
        ]);

        $exceptions->reportable(function (Throwable $e) {
            // ... reportable exceptions
        });

        $exceptions->renderable(function (Throwable $e, $request) {
            // ... custom exception rendering
        });
    })->create();