<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Ambil Data Profil Pemilik
        $dataPemilik = DB::table('pemilik')
            ->where('iduser', $userId)
            ->first();

        if (!$dataPemilik) {
            return redirect()->route('home')->with('error', 'Profil pemilik tidak ditemukan.');
        }

        // 2. Ambil Daftar Peliharaan (Pet)
        $peliharaan = DB::table('pet')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'pet.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->where('pet.idpemilik', $dataPemilik->idpemilik)
            ->select('pet.*', 'ras_hewan.nama_ras', 'jenis_hewan.nama_jenis_hewan')
            ->get();

        // 3. Ambil Jadwal Temu Dokter
        $jadwalTemu = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->where('pet.idpemilik', $dataPemilik->idpemilik)
            ->select('temu_dokter.*', 'pet.nama as nama_pet', 'dokter_user.nama as nama_dokter')
            ->orderBy('tanggal_temu', 'asc')
            ->get();

        // 4. Ambil Riwayat Rekam Medis
        $rekamMedis = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('role_user', 'rekam_medis.dokter_pemeriksa', '=', 'role_user.idrole_user')
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->where('pet.idpemilik', $dataPemilik->idpemilik)
            ->select('rekam_medis.*', 'pet.nama as nama_pet', 'dokter_user.nama as nama_dokter', 'temu_dokter.tanggal_temu')
            ->orderBy('rekam_medis.created_at', 'desc')
            ->get();

        return view('pemilik.dashboard-pemilik', compact('dataPemilik', 'peliharaan', 'jadwalTemu', 'rekamMedis'));
    }
}