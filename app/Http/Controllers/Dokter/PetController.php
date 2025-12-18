<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pet; // Asumsi Model Pet sudah ada
use Illuminate\Http\Request;

class PetController extends Controller
{
    // Melihat daftar semua pasien (Pet)
    public function index()
    {
        // Load relasi Pemilik dan Ras Hewan
        $pets = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])
            ->orderBy('idpet', 'asc')
            ->paginate(10);

        return view('dokter.pasien.index', compact('pets'));
    }

    // Melihat detail satu pasien
    public function show(Pet $pet)
    {
        $pet->load(['pemilik.user', 'rasHewan.jenisHewan']);
        // Ambil riwayat rekam medis pasien tersebut melalui temuDokter
        $riwayat_rekam_medis = $pet->temuDokter()
            ->whereHas('rekamMedis') // Hanya yang sudah punya RM
            ->with(['rekamMedis'])
            ->orderBy('tanggal_temu', 'desc')
            ->get();

        return view('dokter.pasien.show', compact('pet', 'riwayat_rekam_medis'));
    }
}
