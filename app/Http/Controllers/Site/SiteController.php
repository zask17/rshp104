<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SiteController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function visiMisi()
    {
        return view('pages.visi-misi');
    }

    public function layananRshp()
    {
        return view('pages.layanan-rshp');
    }

    public function strukturOrganisasi()
    {
        return view('pages.struktur-organisasi');
    }

    public function cekKoneksi()
    {
        try {
            DB::connection()->getPdo();
            return 'Koneksi ke database berhasil!';
        } catch (\Exception $e) {
            return 'Koneksi ke database gagal: ' . $e->getMessage();
        }
    }





    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }



    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email'    => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         $user = Auth::user();

    //         // Mendapatkan objek Role aktif (menggunakan helper dari Model User)
    //         $activeRole = $user->getActiveRole();

    //         // 1. Cek apakah user memiliki role aktif
    //         if (!$activeRole) {
    //             Auth::logout();
    //             $request->session()->invalidate();
    //             return back()->withErrors(['email' => 'Anda tidak memiliki role aktif.']);
    //         }
            
    //         // 2. Redirect berdasarkan Role ID
    //         switch ($activeRole->idrole) {
    //             case 1: // Administrator
    //                 return redirect()->intended(route('admin.dashboard'));
    //             case 2: // Dokter
    //                 return redirect()->intended(route('dokter.dashboard')); 
    //             case 3: // Perawat
    //                 return redirect()->intended(route('perawat.dashboard'));
    //             case 4: // Resepsionis
    //                 return redirect()->intended(route('resepsionis.dashboard'));
    //             default:
    //                 // Jika ID role aktif tidak terdaftar di daftar switch
    //                 Auth::logout();
    //                 $request->session()->invalidate();
    //                 return back()->withErrors(['email' => 'Role aktif Anda tidak terdaftar dalam sistem redirect.']);
    //         }
    //     }

    //     // Jika Auth::attempt gagal (email/password salah)
    //     return back()->withErrors([
    //         'email' => 'Email atau password salah.',
    //     ]);
    // }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
