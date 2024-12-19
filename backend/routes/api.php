<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;

Route::get('/products', [ProductController::class, 'getAllProducts']);
Route::get('/products/search', [ProductController::class, 'searchByName']);
Route::get('/products/{id}', [ProductController::class, 'getProductById']);

// User authentication routes
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('auth.profile');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
