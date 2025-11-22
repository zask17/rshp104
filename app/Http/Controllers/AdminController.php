<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }


    /**
     * Menampilkan halaman Data Master (khusus Admin).
     * Ini akan menggunakan datamaster.blade.php
     * @return \Illuminate\View\View
     */
    
    // public function dashboard()
    // {
    //     return view('admin.datamaster'); // Atau nama view dashboard admin Anda
    // }

    // Fungsi untuk view Data Master
    public function dataMaster()
    {
        return view('admin.datamaster');
    }



        /**
     * Menampilkan halaman Dashboard utama (sesuai role).
     * Ini menggantikan fungsi utama admindashboard.php.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Asumsi: Kita menggunakan helper getActiveRole() yang sudah kita definisikan sebelumnya
        // Jika ada masalah, pastikan method ini sudah benar di Model User.php
        $activeRole = $user->getActiveRole();

        $roleName = $activeRole ? $activeRole->nama_role : null;

        return view('dashboard.main', [
            'user' => $user,
            'roleName' => $roleName,
        ]);
    }
}
