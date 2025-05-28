<?php

use App\Http\Controllers\DashboardController;
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

use App\Http\Controllers\ItemController;

Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
