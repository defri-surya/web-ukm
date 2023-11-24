<?php

use App\Http\Controllers\Pengelola\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth' => 'CekRole:pengelola']], function () {
    Route::namespace('Pengelola')->group(function () {
        Route::get('/product', [ProductController::class, 'index']);
    });
});
