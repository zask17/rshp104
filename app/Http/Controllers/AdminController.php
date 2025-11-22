<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // public function dashboard()
    // {
    //     return view('admin.datamaster'); // Atau nama view dashboard admin Anda
    // }

    // Fungsi untuk view Data Master
    public function dataMaster()
    {
        return view('admin.datamaster');
    }
}
