<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Services\ErrorHandler;


Route::get('/products', [ProductController::class, 'getAllProducts']);

Route::get('/products/{id}', [ProductController::class, 'getProductById']);

// User authentication routes
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('auth.profile');
});


// Demo 403 error
Route::get('/admin', function () {
    ErrorHandler::logAndAbortForbidden(
        '403 Forbidden: Unauthorized access to admin route.',
        'You do not have permission to access this page.'
    );
});

// Demo 500 error
Route::get('/test-500', function () {
    \App\Services\ErrorHandler::logAndAbortServerError(
        '500 Internal Server Error: Simulated error.',
        'This is a simulated 500 error.'
    );
});




// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');