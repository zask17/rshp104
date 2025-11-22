<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Ambil user dan roleUser yang statusnya aktif (status = 1)
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

        // Periksa apakah user memiliki role aktif (karena di eager loading sudah difilter status=1)
        $activeRoleUser = $user->roleUser->first();

        if (!$activeRoleUser) {
            // User ditemukan, password benar, tetapi tidak memiliki role/hak akses aktif
            return redirect()->back()
                ->withErrors(['email' => 'Akun Anda tidak memiliki hak akses aktif.'])
                ->withInput();
        }
        
        // Role harusnya sudah ter-load melalui eager loading roleUser.role
        $role = $activeRoleUser->role; 

        // Login user ke session
        Auth::login($user);

        // Simpan session user
        $request->session()->put([
            'user_id'        => $user->iduser,
            'user_name'      => $user->nama,
            'user_email'     => $user->email,
            'user_role'      => $activeRoleUser->idrole,
            'user_role_name' => $role->nama_role ?? 'User',
            'user_status'    => 'active'
        ]);

        $userRole = $activeRoleUser->idrole;

        // Redirect berdasarkan role
        switch ($userRole) {
            case '1':
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
            case '2':
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!');
            case '3':
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil!');
            case '4':
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
            default:
                // Default redirect ke /home jika role tidak dikenali
                return redirect($this->redirectTo)->with('success', 'Login berhasil!');
        }
    } // Penutup yang BENAR untuk method login()

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('Success', 'Logout berhasil!');
    }
}