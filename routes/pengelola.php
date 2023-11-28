<?php

use App\Http\Controllers\Pengelola\ProductController;
use App\Http\Controllers\Pengelola\TransaksiController;
use App\Http\Controllers\Pengelola\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth' => 'CekRole:pengelola']], function () {
    Route::namespace('Pengelola')->group(function () {
        // Product
        Route::get('/product', [ProductController::class, 'index'])->name('product.index');
        Route::get('/add-product', [ProductController::class, 'create']);
        Route::post('/product-store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product-edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product-update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/product-delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

        // Transaction
        Route::get('/transaction', [TransaksiController::class, 'index'])->name('transaction.index');
        Route::get('/transaction-detail/{id}', [TransaksiController::class, 'show'])->name('transaction.show');

        // Withdraw
        Route::get('/withdraw', [WithdrawController::class, 'index'])->name('withdraw.index');
        Route::get('/add-withdraw', [WithdrawController::class, 'create']);
        Route::post('/withdraw-store', [WithdrawController::class, 'store'])->name('withdraw.store');
        Route::get('/withdraw-detail/{id}', [WithdrawController::class, 'show'])->name('withdraw.show');
    });
});
