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
Route::get('/welcome', [FrontendController::class, 'home']);
Route::get('/contact-us', [FrontendController::class, 'contact']);
Route::get('/our-product', [FrontendController::class, 'product']);
Route::get('/our-product-detail/{id}', [FrontendController::class, 'productdetail'])->name('productdetail');

// Back End
Route::get('/profile', [BackendController::class, 'index'])->name('profile');
Route::get('/edit-profile/{id}', [BackendController::class, 'edit'])->name('edit');
Route::post('/update-profile/{id}', [BackendController::class, 'update'])->name('update-profile');

// Filter Product By Category
Route::get('/filter-product/{slug}', [FrontendController::class, 'filterProduk'])->name('filterProduk');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/pengelola.php';
require __DIR__ . '/customer.php';
require __DIR__ . '/webStore.php';
