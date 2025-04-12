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
use App\Http\Controllers\MenuController;

Route::get('/menu', [MenuController::class, 'index']);
Route::post('/menu/buy-now', [MenuController::class, 'buyNow']);
Route::get('/goi-y', 'App\Http\Controllers\ProductController@goiY');
use App\Http\Controllers\ProductController;

use App\Http\Controllers\CategoryController;

Route::get('/category/{category}', [CategoryController::class, 'show']);




