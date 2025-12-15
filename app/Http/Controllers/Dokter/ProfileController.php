<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis; // Digunakan untuk statistik

class ProfileController extends Controller
{
    // Melihat profil dokter sendiri
    public function index()
    {
        $user = Auth::user();
        $user->load(['roleUser.role']);

        // Ambil ID role_user sebagai Dokter
        $role_user_dokter = $user->roleUser->where('idrole', 2)->first();

        // Statistik
        $jumlah_rekam_medis = 0;
        if($role_user_dokter) {
             $jumlah_rekam_medis = RekamMedis::where('dokter_pemeriksa', $role_user_dokter->idrole_user)->count();
        }

        return view('dokter.profile.index', compact('user', 'role_user_dokter', 'jumlah_rekam_medis'));
    }
}