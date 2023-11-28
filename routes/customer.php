<?php

use App\Http\Controllers\Customer\HistoriTransaksiController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth' => 'CekRole:customer']], function () {
    Route::namespace('Customer')->group(function () {
        Route::get('/transaction-history', [HistoriTransaksiController::class, 'index']);
        Route::get('/transaction-history-detail/{id}', [HistoriTransaksiController::class, 'show'])->name('detail.tansaksi');
    });
});
