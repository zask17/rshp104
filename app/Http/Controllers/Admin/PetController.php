<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet; 
use App\Models\Pemilik; 
use App\Models\JenisHewan; 
use App\Models\RasHewan; 
use Illuminate\Validation\Rule;

class PetController extends Controller
{
    /**
     * Menampilkan daftar semua hewan peliharaan (pasien).
     */
    public function index()
    {
        // Eager load semua relasi
        $pets = Pet::with(['pemilik', 'jenisHewan', 'rasHewan'])->get();
        return view('admin.pets.index', compact('pets'));
    }

    /**
     * Menampilkan formulir untuk membuat hewan peliharaan baru.
     */
    public function create()
    {
        $pemilik = Pemilik::orderBy('nama_pemilik')->get();
        $jenisHewan = JenisHewan::orderBy('nama_jenis_hewan')->get();
        $rasHewan = RasHewan::all(); 

        return view('admin.pets.create', compact('pemilik', 'jenisHewan', 'rasHewan'));
    }

    /**
     * Menyimpan hewan peliharaan baru ke database.
     */
    public function store(Request $request)
    {
        // PENTING: Panggil helper validasi yang diperbarui
        $validatedData = $this->validatePet($request);

        Pet::create($validatedData);

        return redirect()->route('admin.pets.index')
                         ->with('success', 'Data Pasien (Pet) berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir untuk mengedit hewan peliharaan tertentu.
     */
    public function edit($idpet) 
    {
        $pet = Pet::with(['jenisHewan', 'rasHewan'])->find($idpet); 

        if (!$pet) {
            return redirect()->route('admin.pets.index')
                             ->with('error', 'Pasien tidak ditemukan.');
        }
        
        $pemilik = Pemilik::orderBy('nama_pemilik')->get();
        $jenisHewan = JenisHewan::orderBy('nama_jenis_hewan')->get();
        // Ambil SEMUA Ras agar filter JS di view tetap berfungsi
        $rasHewan = RasHewan::all(); 

        return view('admin.pets.edit', compact('pet', 'pemilik', 'jenisHewan', 'rasHewan'));
    }

    /**
     * Memperbarui hewan peliharaan tertentu di database.
     */
    public function update(Request $request, $idpet) 
    {
        $pet = Pet::find($idpet);

        if (!$pet) {
             return redirect()->route('admin.pets.index')
                             ->with('error', 'Pasien tidak ditemukan.');
        }
        
        $validatedData = $this->validatePet($request, $pet->idpet);

        $pet->update($validatedData);

        return redirect()->route('admin.pets.index')
                         ->with('success', 'Data Pasien (Pet) berhasil diperbarui.');
    }

    /**
     * Menghapus hewan peliharaan tertentu dari database.
     */
    public function destroy($idpet) 
    {
        $pet = Pet::find($idpet);

        if (!$pet) {
             return redirect()->route('admin.pets.index')
                             ->with('error', 'Pasien tidak ditemukan.');
        }

        try {
            $pet->delete();
            return redirect()->route('admin.pets.index')
                             ->with('success', 'Data Pasien (Pet) berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.pets.index')
                             ->with('error', 'Gagal menghapus data pasien. Pastikan tidak ada rekam medis terkait. Error: ' . $e->getMessage());
        }
    } 

    /**
     * Helper untuk validasi data Pet.
     */
    private function validatePet(Request $request, $id = null)
    {
        // Kita akan menggunakan 'nama' dan 'jenis_kelamin' yang sesuai dengan Model Mutator
        return $request->validate([
            // FIX: Ubah 'nama_pet' menjadi 'nama' (nama kolom DB)
            'nama' => 'required|string|max:255|min:2', 
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
            'idras_hewan' => [
                'required',
                Rule::exists('ras_hewan', 'idras_hewan')->where(function ($query) use ($request) {
                    return $query->where('idjenis_hewan', $request->idjenis_hewan);
                }),
            ],
            'tanggal_lahir' => 'nullable|date',
            // FIX: Ganti 'Laki-laki,Perempuan' ke 'Jantan,Betina' sesuai Model Pet.php
            'jenis_kelamin' => 'required|in:Jantan,Betina', 
            // FIX: Ubah 'warna' menjadi 'warna_tanda' (nama kolom DB)
            'warna_tanda' => 'nullable|string|max:100', 
        ], [
            'idras_hewan.exists' => 'Ras hewan tidak cocok dengan jenis hewan yang dipilih.',
            'nama.required' => 'Nama pasien tidak boleh kosong.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Jantan atau Betina.',
            'warna_tanda.max' => 'Warna/tanda maksimal 100 karakter.',
        ]);
    }
}