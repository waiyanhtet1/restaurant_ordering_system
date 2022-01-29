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

// orderPanel
Route::get('/', [App\Http\Controllers\OrderController::class,'index'])->name('order.form');
Route::post('order_submit', [App\Http\Controllers\OrderController::class,'submit'])->name('order.submit');

// Kitchen Panel
Route::resource('/dish',App\Http\Controllers\DishController::class);

Route::get('order', [App\Http\Controllers\DishController::class,'order'])->name('kitchen.order');
Route::get('/order/{order}/approve', [App\Http\Controllers\DishController::class,'approve']);
Route::get('/order/{order}/cancel', [App\Http\Controllers\DishController::class,'cancel']);
Route::get('/order/{order}/ready', [App\Http\Controllers\DishController::class,'ready']);

Route::get('/order/{order}/serve', [App\Http\Controllers\OrderController::class,'serve']);


Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confim' => false,
]);

