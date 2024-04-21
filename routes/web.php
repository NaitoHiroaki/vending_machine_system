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

Route::get('/product_register', [App\Http\Controllers\ProductRegisterController::class, 'index'])->name('product_register');
Route::post('/product_register', [App\Http\Controllers\ProductRegisterController::class, 'store'])->name('store');
Route::get('/{id}', [App\Http\Controllers\ProductRegisterController::class, 'show'])->name('show');
Route::post('/{id}', [App\Http\Controllers\ProductRegisterController::class, 'update'])->name('update');
Route::get('/{id}/edit', [App\Http\Controllers\ProductRegisterController::class, 'edit'])->name('edit');
Route::post('/{id}/destroy', [App\Http\Controllers\ProductRegisterController::class, 'destroy'])->name('destroy');