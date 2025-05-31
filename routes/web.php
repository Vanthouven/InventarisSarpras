<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\AccountController;

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

// Public
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes yang hanya untuk admin atau petugas
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/items',     [ItemController::class,    'index'])->name('items.index');
    Route::post('/items',    [ItemController::class,    'store'])->name('items.store');
    Route::resource('items', ItemController::class)->except(['show']);
});

// Route yang hanya untuk admin
Route::middleware(['firstOrAdmin'])->group(function () {
    Route::get('/accounts',          [AccountController::class, 'index'])->name('accounts.index');
    Route::get('/accounts/create',   [AccountController::class, 'create'])->name('accounts.create');
    Route::post('/accounts',         [AccountController::class, 'store'])->name('accounts.store');
    Route::delete('/accounts/{user}',[AccountController::class, 'destroy'])->name('accounts.destroy');
});

// Route untuk semua yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/home',            [AuthController::class,    'home'])->name('home');
    Route::get('/borrowings',      [BorrowingController::class,'index'])->name('borrowings.index');
    Route::get('/borrowings/create', [BorrowingController::class,'create'])->name('borrowings.create');
    Route::post('/borrowings',     [BorrowingController::class,'store'])->name('borrowings.store');
    Route::post('/borrowings/{id}/return', [BorrowingController::class, 'markReturned'])
         ->name('borrowings.return');
});