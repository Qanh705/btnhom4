<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/about', 'App\Http\Controllers\HomeController@about');
Route::get('/contact', 'App\Http\Controllers\HomeController@contact');
Route::post('/contact', 'App\Http\Controllers\HomeController@contact');
Route::get('/search', 'App\Http\Controllers\HomeController@search')->name('search');

Route::get('/login', 'App\Http\Controllers\UserController@formlogin');
Route::post('/login', 'App\Http\Controllers\UserController@login');
Route::get('/logout', 'App\Http\Controllers\UserController@logout');

Route::get('/quenmatkhau', 'App\Http\Controllers\QuenMatKhauController@formquenmatkhau');
Route::post('/quenmatkhau', 'App\Http\Controllers\QuenMatKhauController@quenmatkhau')->name('quenmatkhau.update');

Route::get('/profile', 'App\Http\Controllers\ProfileController@profile');
Route::get('/update_address', 'App\Http\Controllers\ProfileController@editAddress')->name('address.show');
Route::post('/update_address', 'App\Http\Controllers\ProfileController@updateAddress')->name('update_address');
Route::get('/update_profile', 'App\Http\Controllers\ProfileController@showUpdateProfile')->name('show_update_profile');
Route::post('/update_profile','App\Http\Controllers\ProfileController@updateProfile')->name('update_profile');

Route::get('/register', 'App\Http\Controllers\RegisterController@formregister');
Route::post('/register', 'App\Http\Controllers\RegisterController@register')->name('register.submit');

Route::get('/cart', 'App\Http\Controllers\CartController@show');
Route::post('/cart', 'App\Http\Controllers\CartController@show');

Route::match(['get', 'post'], '/checkout', 'App\Http\Controllers\CheckoutController@checkout');

Route::get('/orders', 'App\Http\Controllers\OrdersController@showUserOrders');
Route::get('/orders/detail', 'App\Http\Controllers\OrdersController@detail');

Route::get('/qrcode', 'App\Http\Controllers\QrcodeController@showQRCode');
Route::post('/qrcode/confirmPayment', 'App\Http\Controllers\QrcodeController@confirmPayment');
