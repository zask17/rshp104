<?php

use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [SiteController::class, 'home'])->name('home');

Route::get('/visi-misi', [SiteController::class, 'visiMisi'])->name('visi-misi');

Route::get('/layanan-rshp', [SiteController::class, 'layananRshp'])->name('layanan-rshp');

Route::get('/struktur-organisasi', [SiteController::class, 'strukturOrganisasi'])->name('struktur-organisasi');


// --- RUTE HALAMAN AUTH ---

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// LOGIN
Route::get('/login', [SiteController::class, 'showLogin'])->name('login');
Route::post('/login', [SiteController::class, 'login'])->name('login.process');

// // REGISTER
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register'])->name('register.process');


// LOGOUT
Route::post('/logout', [SiteController::class, 'logout'])->name('logout');



// YANG BISA DIAKSES ADMIN

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini tempat Anda dapat mendaftarkan rute web untuk aplikasi Anda.
|
*/

// --- RUTE OTENTIKASI DAN DASHBOARD ---
// Rute untuk user yang sudah login (dilindungi oleh 'auth' middleware)
Route::middleware(['auth'])->group(function () {
    // Rute utama Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute Logout (menggunakan metode POST)
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    // --- RUTE PERAN (Aksi Khusus) ---
    // Rute untuk Resepsionis
    // Ganti 'ResepsionisController' dengan controller yang sesuai
    Route::get('/resepsionis/pasien', function () {
        return view('resepsionis.pasien'); // Ganti dengan logika controller Anda
    })->name('resepsionis.pasien');
    
    Route::get('/resepsionis/temu-dokter', function () {
        return view('resepsionis.temu-dokter'); // Ganti dengan logika controller Anda
    })->name('resepsionis.temu.dokter');

    // Rute untuk Administrator
    // Ganti 'AdminController' dengan controller yang sesuai
    Route::get('/admin/datamaster', function () {
        return view('admin.datamaster'); // Ganti dengan logika controller Anda
    })->name('admin.datamaster');
});

// --- RUTE BERANDA/LANDING PAGE ---
// // Rute Home/Landing Page
// Route::get('/', function () {
//     return view('home'); // Ganti dengan view home Anda yang sebenarnya
// });

// Tambahkan rute login di sini jika Anda tidak menggunakan Breeze/Jetstream
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// ... Rute lain di bawah ini ...