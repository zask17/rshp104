<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    // 1. Melihat daftar janji temu yang terkait dengan dokter yang sedang login
    public function index()
    {
        // Dapatkan idrole_user dokter yang sedang login
        $idrole_user = Auth::user()->roleUser()->where('idrole', 2)->first()->idrole_user;

        $temuDokters = TemuDokter::where('idrole_user', $idrole_user)
            ->with(['pet.pemilik.user', 'rekamMedis'])
            ->whereIn('status', ['Daftar', 'Selesai'])
            ->orderBy('tanggal_temu', 'desc')
            ->orderBy('waktu_temu', 'desc')
            ->paginate(10);

        return view('dokter.rekam_medis.index', compact('temuDokters'));
    }

    // 2. Tampilkan form untuk membuat Rekam Medis baru
    public function create(TemuDokter $temuDokter)
    {
        if ($temuDokter->rekamMedis) {
            return redirect()->route('dokter.rekam-medis.show', $temuDokter->rekamMedis->idrekam_medis)
                ->with('error', 'Rekam Medis sudah tersedia untuk janji temu ini.');
        }

        $temuDokter->load(['pet.pemilik.user']);
        return view('dokter.rekam_medis.create', compact('temuDokter'));
    }

    // 3. Menyimpan Rekam Medis baru
    public function store(Request $request)
    {
        $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'anamnesa' => 'required|string|max:1000',
            'temuan_klinis' => 'required|string|max:1000',
            'diagnosa' => 'required|string|max:1000',
        ]);

        $idrole_user_dokter = Auth::user()->roleUser()->where('idrole', 2)->first()->idrole_user;

        $rekamMedis = RekamMedis::create([
            'created_at' => now(),
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
            'idreservasi_dokter' => $request->idreservasi_dokter,
            'dokter_pemeriksa' => $idrole_user_dokter,
        ]);
        
        // Update status temu dokter (Opsional)
        TemuDokter::find($request->idreservasi_dokter)->update(['status' => 'Selesai']);

        return redirect()->route('dokter.rekam-medis.show', $rekamMedis->idrekam_medis)
            ->with('success', 'Rekam Medis berhasil dibuat. Silakan tambahkan Detail Tindakan/Terapi.');
    }

    // 4. Melihat Rekam Medis dan Detailnya (Read)
    public function show(RekamMedis $rekamMedis)
    {
        $rekamMedis->load(['temuDokter.pet.pemilik.user', 'detailRekamMedis.kodeTindakanTerapi.kategori']);
        
        // Ambil semua kode tindakan/terapi untuk dropdown
        $kodeTindakanTerapi = \App\Models\KodeTindakanTerapi::with('kategori')->get();

        return view('dokter.rekam_medis.show', compact('rekamMedis', 'kodeTindakanTerapi'));
    }
}