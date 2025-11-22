<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan form login (jika Anda tidak menggunakan Blade bawaan Laravel).
     */
    public function showLoginForm()
    {
        // Asumsi: View untuk login Anda ada di resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Handle permintaan login (mereplikasi login_post.php)
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba otentikasi user dasar (Verifikasi email dan password)
        if (Auth::attempt($credentials, $request->remember)) {
            $user = Auth::user();
            
            // 3. Periksa Role Aktif (Mereplikasi logika JOIN di login_post.php)
            $activeRole = $user->activeRole();

            if ($activeRole) {
                // Login berhasil dan Role Aktif ditemukan.

                // Di Laravel, kita tidak perlu menyimpan role ke $_SESSION secara manual 
                // jika kita menggunakan logic di DashboardController yang sudah diperbaiki.
                // Namun, kita bisa menyimpan nama role ke sesi untuk akses cepat.
                $request->session()->put('active_role_name', $activeRole->nama_role);

                $request->session()->regenerate();

                // 4. Redirect ke Dashboard (admindashboard.php Anda)
                return redirect()->intended(route('dashboard'));

            } else {
                // User terotentikasi, tapi tidak memiliki role aktif
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Anda tidak memiliki role aktif.',
                ])->onlyInput('email');
            }
        }

        // 5. Otentikasi gagal (Email/Password salah)
        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ])->onlyInput('email');
    }

    /**
     * Handle proses logout.
     * (Anda bisa menggunakan fungsi ini atau yang ada di DashboardController)
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}