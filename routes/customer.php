<?php

use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\HistoriTransaksiController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth' => 'CekRole:customer']], function () {
    Route::namespace('Customer')->group(function () {
        Route::get('/transaction-history', [HistoriTransaksiController::class, 'index'])->name('history');
        Route::get('/transaction-history-detail/{id}', [HistoriTransaksiController::class, 'show'])->name('detail.tansaksi');

        // Cart
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart-store', [CartController::class, 'store'])->name('cart.store');
        Route::delete('/cart-delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');

        // Order
        Route::get('/order', [CheckoutController::class, 'index']);
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout');
        Route::get('payment', [CheckoutController::class, 'payment'])->name('payment');

        // Invoice
        Route::get('/invoice', [CheckoutController::class, 'invoice'])->name('invoice');
        Route::get('/delete-payment-cookie', function () {
            $cookie = Cookie::forget('payment');
            return response()->json(['message' => 'Cookie deleted'])->withCookie($cookie);
        })->name('deletePaymentCookie');
    });
});
