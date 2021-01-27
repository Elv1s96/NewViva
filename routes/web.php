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
    return view('home');
});

Auth::routes();


Route::middleware('auth')->group(function() {
    Route::get('/', [App\Http\Controllers\TransactionController::class, 'index'])->name('home');
    Route::put('/add-money/{user}',[App\Http\Controllers\TransactionController::class, 'addMoney'])->name('add-money');
    Route::put('/convert-and-output/{user}',[App\Http\Controllers\TransactionController::class, 'convertAndOutput'])->name('convert-and-output');
});

Route::middleware('check.user.role')->prefix('admin')->group(function() {
    Route::get('/',[App\Http\Controllers\Admin\TransactionController::class,'index'])->name('homeAdmin');
});

