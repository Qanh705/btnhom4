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


Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/about', 'App\Http\Controllers\HomeController@about');

Route::get('/menu', 'App\Http\Controllers\MenuController@index');
Route::post('/menu/buy-now', 'App\Http\Controllers\MenuController@buyNow');

Route::get('/goiY', 'App\Http\Controllers\ProductController@goiY');

Route::get('/category/{category}', 'App\Http\Controllers\CategoryController@show');

Route::get('/quick_view/{id}', 'App\Http\Controllers\ProductController@chitiet');


