<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
        public function home()
    {
        return view('pages.home');
    }

    public function visiMisi()
    {
        return view('pages.visi-misi');
    }

    public function layananRshp()
    {
        return view('pages.layanan-rshp');
    }

    public function strukturOrganisasi()
    {
        return view('pages.struktur-organisasi');
    }

    public function cekKoneksi()
    {
        try {
            \DB::connection()->getPdo();
            return 'Koneksi ke database berhasil!';
        }catch(\Exception $e){
            return 'Koneksi ke database gagal: ' . $e->getMessage();
        }
    }
}
