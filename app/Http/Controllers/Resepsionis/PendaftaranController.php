<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter; // Menggunakan TemuDokter sebagai Model Registrasi
use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    /**
     * Menampilkan halaman data pendaftaran/antrean hari ini (INDEX).
     */
    public function index()
    {
        // 1. Ambil tanggal hari ini
        $today = now()->toDateString();

        // 2. Ambil data pendaftaran (temu_dokter) hari ini
        $pendaftarans = TemuDokter::whereDate('tanggal_temu', $today)
            ->with([
                'pet.pemilik',
                'roleUser.user'
            ])
            ->orderBy('waktu_temu', 'asc')
            ->get();

        return view('resepsionis.pendaftaran.index', compact('pendaftarans', 'today'));
    }

    /**
     * Menampilkan form untuk membuat pendaftaran/registrasi baru (CREATE).
     */
    public function create()
    {
        // Data yang dibutuhkan untuk form pendaftaran
        $pets = Pet::with('pemilik')->get();
        // Ambil user yang ber-role dokter
        $dokters = User::whereHas('roles', function ($query) {
            // FIX: Tambahkan kualifikasi tabel 'role'
            $query->where('role.idrole', 2); // ID Role Dokter = 2
        })->orderBy('nama')->get();

        return view('resepsionis.pendaftaran.create', compact('pets', 'dokters'));
    }

    /**
     * Menyimpan data pendaftaran/registrasi baru (STORE).
     */
    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'iddokter' => 'required|exists:user,iduser',
            // Untuk pendaftaran, tanggal dan waktu di-set otomatis hari ini
            'alasan' => 'nullable|string|max:255',
        ]);

        $today = now()->toDateString();
        $currentTime = now()->toTimeString('minute'); // Ambil waktu saat ini

        // Cari idrole_user
        $roleUser = DB::table('role_user')
            ->where('iduser', $request->iddokter)
            ->where('idrole', 2)
            ->first();

        if (!$roleUser) {
            return back()->withInput()->with('error', 'Role Dokter untuk user ini tidak ditemukan.');
        }

        try {
            // Logika sederhana untuk no_urut (ambil no urut terakhir hari ini)
            $lastTemu = TemuDokter::whereDate('tanggal_temu', $today)
                ->orderBy('no_urut', 'desc')
                ->first();
            $no_urut = ($lastTemu ? $lastTemu->no_urut : 0) + 1;

            TemuDokter::create([
                'idpet' => $request->idpet,
                'idrole_user' => $roleUser->idrole_user,
                'tanggal_temu' => $today,
                'waktu_temu' => $currentTime, // Waktu pendaftaran
                'alasan' => $request->alasan,
                'status' => 'Pending', // Default status untuk registrasi saat ini
                'no_urut' => $no_urut,
                'waktu_daftar' => now(),
            ]);

            return redirect()->route('resepsionis.pendaftaran.index')->with('success', 'Pasien berhasil didaftarkan! No. Urut: ' . $no_urut);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal mendaftarkan pasien: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form untuk mengedit pendaftaran (EDIT).
     */
    public function edit($idreservasi_dokter)
    {
        // Menggunakan TemuDokter Model untuk mencari data
        $pendaftaran = TemuDokter::with(['pet.pemilik', 'roleUser.user'])->findOrFail($idreservasi_dokter);

        // Ambil user yang ber-role dokter
        $dokters = User::whereHas('roles', function ($query) {
            $query->where('idrole', 2);
        })->orderBy('nama')->get();

        // Dapatkan ID USER dari idrole_user yang tersimpan di pendaftaran
        $pendaftaran->iddokter = $pendaftaran->roleUser->iduser ?? null;

        return view('resepsionis.pendaftaran.edit', compact('pendaftaran', 'dokters'));
    }

    /**
     * Memperbarui data pendaftaran/registrasi (UPDATE).
     */
    public function update(Request $request, $idreservasi_dokter)
    {
        $pendaftaran = TemuDokter::findOrFail($idreservasi_dokter);

        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'iddokter' => 'required|exists:user,iduser',
            // Waktu dan tanggal registrasi saat ini (walk-in) biasanya tidak diubah
            'status' => 'required|in:Pending,Dikonfirmasi,Selesai,Dibatalkan',
        ]);

        // Cari idrole_user
        $roleUser = DB::table('role_user')
            ->where('iduser', $request->iddokter)
            ->where('idrole', 2)
            ->first();

        if (!$roleUser) {
            return back()->withInput()->with('error', 'Role Dokter untuk user ini tidak ditemukan.');
        }

        try {
            $pendaftaran->update([
                'idpet' => $request->idpet,
                'idrole_user' => $roleUser->idrole_user,
                'alasan' => $request->alasan,
                'status' => $request->status,
            ]);

            return redirect()->route('resepsionis.pendaftaran.index')->with('success', 'Data Pendaftaran berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui Pendaftaran: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus pendaftaran/registrasi (DESTROY).
     */
    public function destroy($idreservasi_dokter)
    {
        $pendaftaran = TemuDokter::findOrFail($idreservasi_dokter);
        try {
            $pendaftaran->delete();
            return redirect()->route('resepsionis.pendaftaran.index')->with('success', 'Pendaftaran berhasil dibatalkan/dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus Pendaftaran: ' . $e->getMessage());
        }
    }
}
