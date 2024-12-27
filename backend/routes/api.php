<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\AuthController;
use App\Services\ErrorHandler;
use App\Http\Middleware\RestrictExternalRequests;

Route::apiResource('products', ProductController::class);

// Public routes
// Route::get('/products', [ProductController::class, 'index'])->middleware(RestrictExternalRequests::class);
// Route::get('/products/{product}', [ProductController::class, 'show'])->middleware(RestrictExternalRequests::class);
Route::apiResource('products', ProductController::class)
    ->only(['index', 'show'])
    ->middleware(RestrictExternalRequests::class);

// Route::get('/sanctum/csrf-cookie', function () {
//     return response()->json(['message' => 'CSRF cookie set successfully']);
// });

// Route::get('/debug-sentry', function () {
//     throw new Exception('My first Sentry error!');
// });

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    // Route::get('/profile', [AuthController::class, 'profile'])->name('auth.profile');

    // API resources
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('products', ProductController::class)->except(['index', 'show']);
});


Route::get('/debug-exception', function () {
    throw new Exception('This is a test exception for Pulse.');
});
// Demo error handling
Route::get('/admin', function () {
    ErrorHandler::logAndAbortForbidden(
        '403 Forbidden: Unauthorized access to admin route.',
        'You do not have permission to access this page.'
    );
});

Route::get('/test-500', function () {
    \App\Services\ErrorHandler::logAndAbortServerError(
        '500 Internal Server Error: Simulated error.',
        'This is a simulated 500 error.'
    );
});
