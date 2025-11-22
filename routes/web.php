<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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


// CEK KONEKSI

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');


// --- RUTE HALAMAN AWAL ---

Route::get('/', [SiteController::class, 'home']);

Route::get('/visi-misi', [SiteController::class, 'visiMisi'])->name('visi-misi');

Route::get('/layanan-rshp', [SiteController::class, 'layananRshp'])->name('layanan-rshp');

Route::get('/struktur-organisasi', [SiteController::class, 'strukturOrganisasi'])->name('struktur-organisasi');



// --- RUTE HALAMAN LOGIN ---

// LOGIN
Route::get('/login', [SiteController::class, 'showLogin'])->name('login');
Route::post('/login', [SiteController::class, 'login'])->name('login.process');

// // REGISTER
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register'])->name('register.process');


// LOGOUT
Route::post('/logout', [SiteController::class, 'logout'])->name('logout');

// --- RUTE HALAMAN AUTH ---

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
