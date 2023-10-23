<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\Admin\RoomsTypeController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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
Route::get('/',[HomeController::class, 'index'])->name('user');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/loginPost', [UserController::class, 'loginPost'])->name('login.store');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/registerPost', [UserController::class, 'registerPost'])->name('register.store');
Route::get('/logout', [UserController::class, 'loginout'])->name('loginout');
Route::get('/logon', [AdminController::class, 'logon'])->name('logon');
Route::post('/logonPost', [AdminController::class, 'logonstore'])->name('logon.store');
Route::get('/logonout', [AdminController::class, 'logonout'])->name('logonout');

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [DashBoardController::class, 'index'])->name('user.index');
    Route::resource('rooms', RoomsController::class);
    Route::resource('rooms_type', RoomsTypeController::class);
    Route::resource('bookings', BookingsController::class);
    Route::get('/trash', [RoomsTypeController::class, 'trash'])->name('rooms_type.trash');
    Route::get('/restore/{id}', [RoomsTypeController::class, 'restore'])->name('rooms_type.restore');
    Route::get('/forceDelete/{id}', [RoomsTypeController::class, 'forceDeleted'])->name('rooms_type.forceDeleted');
});