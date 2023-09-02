<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/products', [App\Http\Controllers\productController::class, 'index'])->name('index')->middleware('auth');
Route::get('products/create', [App\Http\Controllers\productController::class, 'create'])->name('products.create')->middleware('auth');
Route::post('products/store', [App\Http\Controllers\productController::class, 'store'])->name('products.store')->middleware('auth');
Route::get('products/edit/{product}', [App\Http\Controllers\productController::class, 'edit'])->name('products.edit')->middleware('auth');
Route::put('products/update/{product}', [App\Http\Controllers\productController::class, 'update'])->name('products.update')->middleware('auth');
Route::delete('products/delete/{product}', [App\Http\Controllers\productController::class, 'destroy'])->name('products.destroy')->middleware('auth');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
