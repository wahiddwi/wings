<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('pesan/{id}', [App\Http\Controllers\CartController::class, 'index']);
Route::post('pesan/{id}', [App\Http\Controllers\CartController::class, 'order']);
Route::get('checkout', [App\Http\Controllers\CartController::class, 'checkout']);
Route::delete('checkout/{id}', [App\Http\Controllers\CartController::class, 'delete']);
Route::get('comfirm-checkout', [App\Http\Controllers\CartController::class, 'confirmation']);
// Route::get('report', [App\Http\Controllers\HomeController::class, 'report'])->name('report');
Route::get('report', [App\Http\Controllers\CartController::class, 'report'])->name('report');
