<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // // Lindungi Controller ini, hanya user yang sudah login bisa mengakses
    // // Menggunakan method middleware() (Cara modern)
    // public function middleware()
    // {
    //     return [
    //         'auth' // Middleware 'auth' akan melindungi semua method di Controller ini
    //     ];
    // }

    // Menampilkan halaman dashboard (Mengganti admindashboard.php)
    public function index()
    {
        // Data user yang sedang login
        $user = Auth::user();
        
        //Role user disimpan di sesi (dibuat di AuthController)
        // Jika tidak ada di sesi, fallback ke 'Administrator'
        $role = session('user_role_name', 'Administrator');

        $user_info = [
            'full_name' => $user->nama ?? $user->name, // Gunakan kolom 'nama' jika ada
            'role' => $role,
            'email_verified_at' => $user->email_verified_at,
        ];

        // View dashboard.blade.php ada di resources/views/dashboard.blade.php
        return view('dashboard', compact('user_info'));
    }
}
