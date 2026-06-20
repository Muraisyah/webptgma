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

use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth','role:Admin'])->prefix('admin')->group(function(){
    Route::get('/dashboard', function(){
        return view('admin.dashboard');
    })->name('admin.dashboard');
    // Resource routes for admin management
    Route::resource('users', App\Http\Controllers\UserController::class, ['as'=>'admin']);
    Route::resource('paket', App\Http\Controllers\PaketController::class, ['as'=>'admin']);
    Route::resource('hotel', App\Http\Controllers\HotelController::class, ['as'=>'admin']);
    Route::resource('rekening', App\Http\Controllers\RekeningController::class, ['as'=>'admin']);
    Route::resource('reservasi', App\Http\Controllers\ReservasiController::class, ['as'=>'admin']);
    Route::resource('transaksi', App\Http\Controllers\TransaksiController::class, ['as'=>'admin']);
    Route::resource('galeri', App\Http\Controllers\GaleriController::class, ['as'=>'admin']);
    Route::resource('dokumen', App\Http\Controllers\DokumenKeberangkatanController::class, ['as'=>'admin']);
});

Route::middleware(['auth','role:Pimpinan'])->prefix('pimpinan')->group(function(){
    Route::get('/dashboard', function(){
        return view('pimpinan.dashboard');
    })->name('pimpinan.dashboard');
});
