<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/products', [ProductController::class, 'getAllProducts']);
Route::get('/products/search',[ProductController::class,'searchByName']);
Route::get('/products/{id}', [ProductController::class, 'getProductById']);
