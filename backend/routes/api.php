<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\AuthController;
use App\Services\ErrorHandler;

// Public User authentication routes
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // User routes
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('auth.profile');

    // API resources
    Route::apiResource('products', ProductController::class);
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('orders', OrderController::class);
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
