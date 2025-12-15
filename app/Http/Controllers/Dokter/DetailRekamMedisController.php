<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use Illuminate\Http\Request;

class DetailRekamMedisController extends Controller
{
    // Menyimpan Detail Rekam Medis baru (Create)
    public function store(Request $request, RekamMedis $rekamMedis)
    {
        $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string|max:1000',
        ]);

        DetailRekamMedis::create([
            'idrekam_medis' => $rekamMedis->idrekam_medis,
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail' => $request->detail,
        ]);

        return redirect()->route('dokter.rekam-medis.show', $rekamMedis->idrekam_medis)
            ->with('success', 'Detail tindakan/terapi berhasil ditambahkan.');
    }

    // Mengubah Detail Rekam Medis (Update)
    public function update(Request $request, DetailRekamMedis $detailRekamMedis)
    {
        $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string|max:1000',
        ]);

        $detailRekamMedis->update([
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail' => $request->detail,
        ]);

        return redirect()->route('dokter.rekam-medis.show', $detailRekamMedis->idrekam_medis)
            ->with('success', 'Detail tindakan/terapi berhasil diubah.');
    }

    // Menghapus Detail Rekam Medis (Delete)
    public function destroy(DetailRekamMedis $detailRekamMedis)
    {
        $idrekam_medis = $detailRekamMedis->idrekam_medis;
        $detailRekamMedis->delete();

        return redirect()->route('dokter.rekam-medis.show', $idrekam_medis)
            ->with('success', 'Detail tindakan/terapi berhasil dihapus.');
    }
}