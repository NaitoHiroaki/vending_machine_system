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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])
->controller(App\Http\Controllers\ProductRegisterController::class)
->group(function(){ 
    Route::get('/product_register', 'index')->name('product_register');
    Route::post('/product_register', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/{id}', 'update')->name('update');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::post('/{id}/destroy', 'destroy')->name('destroy');
});