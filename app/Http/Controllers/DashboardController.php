<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman Dashboard sesuai dengan role pengguna.
     * Logika otentikasi diambil dari middleware Laravel (Auth Middleware).
     */
    public function index()
    {
        // 1. Ambil informasi user yang sudah terotentikasi oleh Laravel Auth
        // Asumsi: Nama pengguna dan Role tersimpan di model User atau melalui guard.
        // Jika Anda menggunakan data dari database, ini adalah cara untuk mengambilnya.
        $user = Auth::user();

        // 2. Tentukan Role Name
        // Dalam contoh PHP murni Anda, role diambil dari $_SESSION['role'].
        // Di Laravel, kita asumsikan properti 'role' ada pada model User.
        $roleName = $user->role ?? 'Akses Terbatas'; // Ganti dengan field role yang sebenarnya

        // 3. Data yang akan dikirim ke view
        $data = [
            'user' => $user,
            'roleName' => $roleName,
        ];

        // 4. Tampilkan view dashboard
        return view('dashboard.index', $data);
    }

    /**
     * Proses Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan ke halaman login
        return redirect('/login');
    }
}