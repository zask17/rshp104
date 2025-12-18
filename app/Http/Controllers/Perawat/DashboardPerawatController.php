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
            $profil = (object) ['nama' => Auth::user()->nama, 'pendidikan' => '-', 'no_hp' => '-', 'jenis_kelamin' => '-'];
        }

        return view('perawat.dashboard-perawat', compact('profil'));
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

    // 2. Form Tambah (Create)
    public function rmCreate()
    {
        // Hanya ambil janji temu yang belum memiliki rekam medis
        $janjiTemu = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->leftJoin('rekam_medis', 'temu_dokter.idreservasi_dokter', '=', 'rekam_medis.idreservasi_dokter')
            ->whereNull('rekam_medis.idrekam_medis')
            ->select('temu_dokter.*', 'pet.nama as nama_pet')
            ->get();

        return view('perawat.rekam_medis.create', compact('janjiTemu'));
    }

    // Simpan Data (Store)
    public function rmStore(Request $request)
    {
        $request->validate([
            'idreservasi_dokter' => 'required',
            'anamnesa' => 'required|string|max:1000',
            'diagnosa' => 'required|string|max:1000',
        ]);

        $janji = DB::table('temu_dokter')->where('idreservasi_dokter', $request->idreservasi_dokter)->first();

        DB::table('rekam_medis')->insert([
            'created_at' => now(),
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
            'idreservasi_dokter' => $request->idreservasi_dokter,
            'dokter_pemeriksa' => $janji->idrole_user, // Otomatis ke dokter di janji temu
        ]);

        return redirect()->route('perawat.rm.index')->with('success', 'Rekam medis berhasil dibuat.');
    }

    // 3. Form Edit (Update)
    public function rmEdit($id)
    {
        $rm = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->where('rekam_medis.idrekam_medis', $id)
            ->select('rekam_medis.*', 'pet.nama as nama_pet')
            ->first();

        return view('perawat.rekam_medis.edit', compact('rm'));
    }

    public function rmUpdate(Request $request, $id)
    {
        DB::table('rekam_medis')->where('idrekam_medis', $id)->update([
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
        ]);

        return redirect()->route('perawat.rm.index')->with('success', 'Rekam medis berhasil diperbarui.');
    }

    // 4. Hapus (Delete)
    public function destroyRekamMedis($id)
    {
        DB::transaction(function () use ($id) {
            // Hapus detail terlebih dahulu karena foreign key
            DB::table('detail_rekam_medis')->where('idrekam_medis', $id)->delete();
            DB::table('rekam_medis')->where('idrekam_medis', $id)->delete();
        });

        return redirect()->route('perawat.rm.index')->with('success', 'Data berhasil dihapus.');
    }
}