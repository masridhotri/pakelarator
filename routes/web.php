<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\bukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;

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

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('dologin', [AuthController::class, 'doLogin']);
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('doregister', [AuthController::class, 'doRegister']);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::post('dologout', [AuthController::class, 'dologout'])->name('dologout');
    Route::get('dashboard', [HomeController::class, 'index'])->name('home');

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/buku', [bukuController::class, 'index'])->name('showbuku');
    Route::get('/buku/create', [bukuController::class, 'create'])->name('addbuku');
    Route::post('/buku/store', [bukuController::class, 'store'])->name('bukustore');
    Route::post('/buku/destroy/{id}', [bukuController::class, 'destroy'])->name('bukdel');



   


    Route::get('user-export', [UserController::class, 'export']);
    Route::get('buku-export', [bukuController::class, 'export']);
    Route::get('kategori-export', [KategoriController::class, 'export']);
    Route::get('peminjaman-export', [PeminjamanController::class, 'export']);
});
