<?php

use App\Http\Controllers\WebStoreController;
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

Route::get('/', [WebStoreController::class, 'homepage']);
Route::get('/product', [WebStoreController::class, 'product']);
Route::get('/detail-product', [WebStoreController::class, 'detailProduct']);
Route::get('/your-cart', [WebStoreController::class, 'cart']);
Route::get('/order', [WebStoreController::class, 'order']);
Route::get('/list-ukm', [WebStoreController::class, 'list_ukm']);
