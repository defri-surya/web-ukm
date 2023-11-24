<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Front End
Route::get('/', [FrontendController::class, 'home']);
Route::get('/contact-us', [FrontendController::class, 'contact']);
Route::get('/product', [FrontendController::class, 'product']);
Route::get('/product-detail', [FrontendController::class, 'productdetail']);
Route::get('/cart', [FrontendController::class, 'cart']);
Route::get('/order', [FrontendController::class, 'order']);

// Back End
Route::get('/profile', [BackendController::class, 'index'])->name('profile');
Route::get('/edit-profile/{id}', [BackendController::class, 'edit'])->name('edit');
Route::post('/update-profile/{id}', [BackendController::class, 'update'])->name('update-profile');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/pengelola.php';
require __DIR__ . '/customer.php';
