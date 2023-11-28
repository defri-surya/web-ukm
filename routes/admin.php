<?php

use App\Http\Controllers\Superadmin\CategoryController;
use App\Http\Controllers\Superadmin\ProductAdminController;
use App\Http\Controllers\Superadmin\TransaksiAdminController;
use App\Http\Controllers\Superadmin\WithdrawAdminController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth' => 'CekRole:superadmin']], function () {
    Route::namespace('Superadmin')->group(function () {
        // Product
        Route::get('/productAdmin', [ProductAdminController::class, 'index'])->name('productAdmin.index');

        // Category
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/category-store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/category-update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category-delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

        // Transaction
        Route::get('/transactionAdmin', [TransaksiAdminController::class, 'index'])->name('transactionAdmin.index');
        Route::get('/transaction-detailAdmin/{id}', [TransaksiAdminController::class, 'show'])->name('transactionAdmin.show');

        // Withdraw
        Route::get('/withdrawAdmin', [WithdrawAdminController::class, 'index'])->name('withdrawAdmin.index');
        Route::get('/withdraw-detailAdmin/{id}', [WithdrawAdminController::class, 'show'])->name('withdrawAdmin.show');
        Route::put('/withdraw-approved/{id}', [WithdrawAdminController::class, 'approve'])->name('withdrawAdmin.approve');
        Route::put('/withdraw-rejected/{id}', [WithdrawAdminController::class, 'reject'])->name('withdrawAdmin.reject');
    });
});
