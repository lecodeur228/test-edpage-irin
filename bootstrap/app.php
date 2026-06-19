<?php

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web/index.php',
        api: __DIR__.'/../routes/api/index.php',
        commands: __DIR__.'/../routes/console.php',
        apiPrefix: 'api',
        then: function () {
            RateLimiter::for('api', function (Request $request) {
                return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
            });

            // If you have additional routes to load
            // Route::middleware('web')
            //     ->prefix('admin')
            //     ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Global middleware configuration
        // $middleware->append(YourMiddleware::class);

        // Middleware for groups
        // $middleware->web(append: [
        //     YourWebMiddleware::class,
        // ]);

        // $middleware->api(append: [
        //     YourApiMiddleware::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Exception configuration
    })->create();
