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
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::with(['roleUser' => function ($query) {
            $query->where('status', 1);
        }, 'roleUser.role'])
            ->where('email', $request->input('email'))
            ->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan.'])
                ->withInput();
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password salah.'])
                ->withInput();
        }

        $namaRole = Role::where('idrole', $user->roleUser[0]->idrole ?? null)->first();

        // Login user ke session
        Auth::login($user);

        // Simpan session user
        $request->session()->put([
            'user_id'    => $user->iduser,
            'user_name'  => $user->nama,
            'user_email' => $user->email,
            'user_role'  => $user->roleUser[0]->idrole ?? 'user',
            'user_role_name' => $namaRole->nama_role ?? 'User',
            'user_status' => $user->roleUser[0]->status ?? 'active'
        ]);

        // return redirect()->intended('/home')->with('success', 'Login berhasil!');

        $userRole = $user->roleUser[0]->idrole ?? null;

        switch ($userRole) {
            case '1':
            return redirect()->route()('admin.datamaster.datamaster')->with('Success', 'Login bergasil!');
            case '2':
            return redirect()->route()('dokter.dashboard')->with('Success', 'Login bergasil!');
            case '3':
            return redirect()->route()('perawat.dashboard')->with('Success', 'Login bergasil!');
            case '4':
            return redirect()->route()('resepsionis.dashboard')->with('Success', 'Login bergasil!');
            default:
            return redirect()->route()('pemilik.dashboard')->with('Success', 'Login bergasil!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('succes', 'Logout bergasil!');
    }
}
