<?php


use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(EnsureFrontendRequestsAreStateful::class);
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->report(function (App\Exceptions\ProductNotFoundException $e) {
            logger()->warning('Product not found', ['product_id' => $e->getProductId()]);
        });


        $exceptions->render(function (App\Exceptions\ProductNotFoundException $e, Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return $e->render($request);
            }
        });






    })->create();



