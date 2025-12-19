<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PetController extends Controller
{
    // Melihat daftar semua pasien (Pet)
    public function index()
    {
        $pets = DB::table('pet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'pet.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select(
                'pet.*', 
                'user.nama as nama_pemilik', 
                'ras_hewan.nama_ras', 
                'jenis_hewan.nama_jenis_hewan'
            )
            ->orderBy('pet.idpet', 'desc')
            ->paginate(10);

        return view('dokter.pasien.index', compact('pets'));
    }

    // Melihat detail satu pasien (Gunakan ID untuk Query Builder)
    public function show($id)
    {
        // 1. Ambil Data Pet & Pemilik secara lengkap
        $pet = DB::table('pet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'pet.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select(
                'pet.*', 
                'user.nama as nama_pemilik', 
                'user.email as email_pemilik', 
                'pemilik.no_wa', 
                'pemilik.alamat', 
                'ras_hewan.nama_ras', 
                'jenis_hewan.nama_jenis_hewan'
            )
            ->where('pet.idpet', $id)
            ->first();

        if (!$pet) {
            return redirect()->route('dokter.pasien.index')->with('error', 'Data pasien tidak ditemukan.');
        }

        // 2. Ambil Riwayat Rekam Medis melalui tabel temu_dokter
        $riwayat_rekam_medis = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('role_user', 'rekam_medis.dokter_pemeriksa', '=', 'role_user.idrole_user')
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->select('rekam_medis.*', 'dokter_user.nama as nama_dokter')
            ->where('temu_dokter.idpet', $id)
            ->orderBy('rekam_medis.created_at', 'desc')
            ->get();

        return view('dokter.pasien.show', compact('pet', 'riwayat_rekam_medis'));
    }
}