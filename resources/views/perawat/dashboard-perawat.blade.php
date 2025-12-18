@extends('layouts.app')

@section('content')
    <main style="flex: 1; min-width: 0;">
        <div class="main-dashboard-content">
            {{-- Bagian Selamat Datang --}}
            <div class="welcome-section">
                <h1>Selamat Datang, {{ ucwords(session('user_name') ?? Auth::user()->nama) }}!</h1>
                <p>Anda login sebagai <strong>{{ session('user_role_name', 'Perawat') }}</strong>. Kelola administrasi
                    pasien dan rekam medis di sini.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Grid Navigasi Dashboard Sesuai Permintaan --}}
            <div class="dashboard-grid">
                {{-- 1. View Data Pasien --}}
                <a href="{{ route('perawat.pasien.index') }}" class="dashboard-card">
                    <h3><i class="fas fa-paw"></i> Data Pasien</h3>
                    <p>Lihat daftar semua pasien hewan yang terdaftar.</p>
                </a>

                {{-- 2. CRUD Rekam Medis --}}
                <a href="{{ route('perawat.rm.index') }}" class="dashboard-card">
                    <h3><i class="fas fa-notes-medical"></i> Rekam Medis</h3>
                    <p>Lihat detail dan kelola (hapus) data rekam medis pasien.</p>
                </a>

                {{-- 3. Profil --}}
                <a href="{{ route('perawat.profile.index') }}" class="dashboard-card">
                    <h3><i class="fas fa-user-nurse"></i> Profil Saya</h3>
                    <p>Lihat informasi profil Anda dan detail akun.</p>
                </a>
            </div>

            {{-- Form Logout Tersembunyi --}}
            <form id="logout-form-dashboard" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </main>
@endsection