<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\LoadInfoComercio;
use App\Http\Middleware\SetLocale;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web:        __DIR__.'/../routes/web.php',
        commands:   __DIR__.'/../routes/console.php',
        health:     '/up',
        then: function () {
            Route::middleware('web')
                ->prefix('shop')
                ->group(base_path('routes/shop.php'));

            Route::middleware('web')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(SetLocale::class);
        $middleware->append(LoadInfoComercio::class);
    
        $middleware->alias([
            'auth'          => \App\Http\Middleware\Authenticate::class,
            'extend.auth'   => \App\Http\Middleware\ExtendAuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
