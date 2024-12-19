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

Route::get('/test-500', function () {
    abort(500, 'This is a simulated 500 error.');
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

// Route dành riêng cho SPA (Frontend), đặt ở cuối cùng
Route::get('/{any}', function () {
    return view('index');
})->where('any', '^(?!api|test-log|test-exception).*$');

Route::get('/test-403', function () {
    abort(403, 'You are not authorized to access this resource.');
});
