<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardPerawatController extends Controller
{
    // Dashboard Utama
    public function index()
    {
        $userId = Auth::id();
        $profil = DB::table('perawat')
            ->join('user', 'perawat.id_user', '=', 'user.iduser')
            ->where('perawat.id_user', $userId)
            ->select('perawat.*', 'user.nama', 'user.email')
            ->first();

        if (!$profil) {
            $profil = (object) [
                'nama' => Auth::user()->nama, 
                'pendidikan' => '-', 
                'no_hp' => '-', 
                'jenis_kelamin' => '-'
            ];
        }

        return view('perawat.dashboard-perawat', compact('profil'));
    }

    /**
     * Menampilkan daftar seluruh pasien (Peliharaan)
     * Fungsi ini ditambahkan untuk memperbaiki error 'pasienIndex does not exist'
     */
    public function pasienIndex()
    {
        $pets = DB::table('pet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('jenis_hewan', 'pet.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->select(
                'pet.*', 
                'pemilik.nama_pemilik', 
                'jenis_hewan.nama_jenis_hewan', 
                'ras_hewan.nama_ras'
            )
            ->paginate(10); // Menyesuaikan dengan $pets->links() di view index

        return view('perawat.pasien.index', compact('pets'));
    }

    // 1. List Rekam Medis (Read)
    public function rmIndex()
    {
        $rekamMedis = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('role_user', 'rekam_medis.dokter_pemeriksa', '=', 'role_user.idrole_user')
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->select('rekam_medis.*', 'pet.nama as nama_pet', 'dokter_user.nama as nama_dokter')
            ->orderBy('rekam_medis.created_at', 'desc')
            ->paginate(10);

        return view('perawat.rekam_medis.index', compact('rekamMedis'));
    }

    // ... (Fungsi rmCreate, rmStore, rmEdit, rmUpdate, destroyRekamMedis tetap sama)
}