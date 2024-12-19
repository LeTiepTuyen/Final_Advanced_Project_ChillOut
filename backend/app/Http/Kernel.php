<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

// Route kiểm tra log
Route::get('/test-log', function () {
    Log::info('Test log route accessed');
    return 'Log test successful!';
});

// Route kiểm tra exception
Route::get('/test-exception', function () {
    throw new \Exception('This is a test exception!');
});

// Fallback Route: xử lý 404 cho route không tồn tại
Route::fallback(function () {
    Log::warning('404 Not Found', [
        'url' => request()->fullUrl(),
        'method' => request()->method(),
        'ip' => request()->ip(),
    ]);

    return response()->view('errors.404', [], 404);
});

// Nếu bạn cần route catch-all cho frontend SPA
Route::get('/{any}', function () {
    return view('index');
})->where('any', '^(?!api|test-log|test-exception).*$');
