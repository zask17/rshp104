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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', [SiteController::class, 'index'])->name('home');

Route::get('/', [SiteController::class, 'home']);

Route::get('/visi-misi', [SiteController::class, 'visiMisi'])->name('visi-misi');

Route::get('/layanan-rshp', [SiteController::class, 'layananRshp'])->name('layanan-rshp');

Route::get('/struktur-organisasi', [SiteController::class, 'strukturOrganisasi'])->name('struktur-organisasi');