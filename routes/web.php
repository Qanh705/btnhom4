<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'updateQty'])->name('cart.updateQty');
    Route::post('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');
    Route::post('/cart/delete-all', [CartController::class, 'deleteAll'])->name('cart.deleteAll');
});