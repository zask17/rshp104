<?php

use App\Http\Controllers\Site\SiteController;
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
// CEK KONEKSI

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

// --- RUTE HALAMAN STATIS (CLOSURE) ---

Route::get('/', [SiteController::class, 'home'])->name('home');

Route::get('/visi-misi', [SiteController::class, 'visiMisi'])->name('visi-misi');

Route::get('/layanan-rshp', [SiteController::class, 'layananRshp'])->name('layanan-rshp');

Route::get('/struktur-organisasi', [SiteController::class, 'strukturOrganisasi'])->name('struktur-organisasi');



// --- RUTE HALAMAN AUTH ---
