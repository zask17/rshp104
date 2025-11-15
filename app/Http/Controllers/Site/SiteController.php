<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    // public function index()
    // {
    //     return view ('site.home');
    // }

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
}
