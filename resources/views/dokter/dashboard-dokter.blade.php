@extends('layouts.app')

@section('content')
    <main style="flex: 1; min-width: 0;">
        <div class="main-dashboard-content">
            <div class="welcome-section">
                <h1>Selamat Datang, {{ ucwords(session('user_name') ?? Auth::user()->nama) }}!</h1>
                <p>Anda login sebagai <strong>{{ session('user_role_name', 'Dokter') }}</strong>. Berikut adalah menu utama untuk peran Anda.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="dashboard-grid">
                
                {{-- 1. Janji Temu & Rekam Medis (CRUD RM) --}}
                <a href="{{ route('dokter.rekam-medis.index') }}" class="dashboard-card">
                    <h3><i class="fas fa-notes-medical"></i> Rekam Medis</h3>
                    <p>Kelola janji temu pasien dan buat/lihat Rekam Medis.</p>
                </a>

                {{-- 2. Data Pasien (View Data Pasien) --}}
                <a href="{{ route('dokter.pasien.index') }}" class="dashboard-card">
                    <h3><i class="fas fa-paw"></i> Data Pasien</h3>
                    <p>Lihat detail informasi pasien (hewan peliharaan) dan riwayatnya.</p>
                </a>

                {{-- 3. Profil Dokter (View Profil) --}}
                <a href="{{ route('dokter.profile.index') }}" class="dashboard-card">
                    <h3><i class="fas fa-user-md"></i> Profil Saya</h3>
                    <p>Lihat dan kelola informasi pribadi Anda.</p>
                </a>
                
            </div>

            <form id="logout-form-dashboard" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </main>
@endsection