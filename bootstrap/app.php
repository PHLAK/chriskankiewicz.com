<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(
    basePath: dirname(__DIR__)
)->withRouting(
    commands: __DIR__ . '/../routes/console.php',
)->withMiddleware(function (Middleware $middleware): void {
    $middleware->throttleApi();
    $middleware->trustProxies(at: '*');

    $middleware->alias([
        'auth' => \App\Http\Middleware\Authenticate::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
    ]);
})->withExceptions(function (Exceptions $exceptions): void {
    // ...
})->create();
