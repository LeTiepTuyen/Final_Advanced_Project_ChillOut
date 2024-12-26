<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Sentry\Laravel\Integration;
use App\Exceptions\ProductNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(EnsureFrontendRequestsAreStateful::class);
        $middleware->alias([
            'abilities' => CheckAbilities::class,
            'ability' => CheckForAnyAbility::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        Integration::handles($exceptions);


        $exceptions->report(function (ProductNotFoundException $e) {
            $e->report(); // Gọi phương thức report() từ ProductNotFoundException
        });

        $exceptions->render(function (ProductNotFoundException $e, Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return $e->render($request);
            }
        });



    })->create();
