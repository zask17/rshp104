@extends('layouts.app')

@section('title', 'Dashboard - RSHP UNAIR')

@section('content')
    <style>
        /* CSS GABUNGAN UNTUK DASHBOARD (Disarankan dipindahkan ke file CSS eksternal seperti public/css/dashboard.css) */
        
        *, html { margin: 0; padding: 0; box-sizing: border-box; }
        body { margin: 0; padding: 0; background-color: white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

        .dashboard-container { max-width: 1000px; margin: 30px auto; padding: 20px; }
        .welcome-section { background: linear-gradient(135deg, #6588e8, #4a6fc4); color: white; padding: 30px; border-radius: 10px; margin-bottom: 30px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .welcome-section h1 { margin: 0; font-size: 28px; }
        .welcome-section p { margin: 10px 0 0 0; font-size: 16px; }

        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .dashboard-card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-align: center; transition: transform 0.2s, box-shadow 0.2s; }
        .dashboard-card:hover { transform: translateY(-5px); box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15); }

        .dashboard-card h2, .dashboard-card h3 { 
            display: inline-block; background-color: #3EA2C7; color: white; font-weight: bold; 
            font-size: 20px; padding: 10px 20px; text-align: center; border-radius: 10px; 
            box-shadow: 2px 2px 5px 0px rgba(0, 0, 0, 0.25); margin-bottom: 15px; 
        }

        .dashboard-card p { color: #666; line-height: 1.6; margin: 15px 0; }
        .btn-dashboard { 
            background-color: #f1c40f; color: black; border: none; padding: 12px 25px; 
            border-radius: 5px; font-weight: bold; cursor: pointer; text-decoration: none; 
            display: inline-block; width: 100%; box-sizing: border-box; margin-top: 15px; 
            transition: background-color 0.3s, transform 0.2s; 
        }

        .btn-dashboard:hover { background-color: #e2b607; transform: translateY(-2px); }
        
        @media (max-width: 600px) {
            .dashboard-container { margin: 15px; padding: 10px; }
            .welcome-section h1 { font-size: 24px; }
            .dashboard-grid { grid-template-columns: 1fr; }
            .dashboard-card { padding: 20px; }
        }
        /* Style tambahan untuk Logout Button di Navigasi */
        .btn-logout { background-color: #e74c3c; color: white; }
        .btn-logout:hover { background-color: #c0392b; }

        /* Style Navigasi (sesuai style.css Anda) */
        nav { background-color: #1e3c72; display: flex; justify-content: space-between; align-items: center; padding: 1rem 2rem; }
        nav div img { width: 100px; }
        nav ul { display: flex; align-items: center; gap: 2rem; list-style: none; }
        nav ul li a { text-decoration: none; font-weight: bold; text-align: center; color: white; padding: 5px 10px; border-radius: 6px; transition: 0.3s; display: flex; flex-direction: column; align-items: center; position: relative; opacity: 0.6; transition: opacity 0.3s ease; }
        nav ul li a.active { opacity: 1; }

    </style>

    {{-- NAVIGASI (Dibuat ulang dari admindashboard.php) --}}
    <nav>
        <div class="logo-container">
            <img src="{{ asset('GAMBAR/LOGO UNAIR.png') }}" alt="Logo UNAIR" class="logo" style="width: 70px; height: auto;">
            <img src="{{ asset('GAMBAR/LOGO RSHP.png') }}" alt="Logo RSHP" class="logo" style="width: 70px; height: auto;">
        </div>
        <ul>
            <li><a href="{{ url('/') }}">Home<span class="underline"></span></a></li>
            <li><a href="{{ route('dashboard') }}" class="active">Dashboard<span class="underline" style="transform: scaleX(1);"></span></a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-dashboard btn-logout" style="width: auto;">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
    {{-- END NAVIGATION --}}


    <div class="dashboard-container">
        <div class="welcome-section">
            <h1>Selamat Datang di Dashboard RSHP UNAIR</h1>
            {{-- Menggunakan $user->nama dengan fallback yang aman --}}
            <p>Halo, {{ htmlspecialchars(ucfirst($user->nama ?? $user->name ?? 'Pengguna')) }}!
                {{-- Menggunakan $roleName yang sudah dipastikan ada di controller --}}
                Anda login sebagai {{ htmlspecialchars(ucfirst($roleName)) }}.</p>
        </div>

        <div class="dashboard-grid">
            
            {{-- Logika Kondisional berdasarkan Role ($roleName sekarang pasti terdefinisi) --}}

            @if ($roleName == 'Dokter')
                <div class="dashboard-card">
                    <h3>Jadwal Saya</h3>
                    <p>Lihat dan kelola jadwal praktik Anda. Atur shift, lihat appointment, dan kelola ketersediaan.</p>
                    <a href="#" class="btn-dashboard">Lihat Jadwal</a>
                </div>

                <div class="dashboard-card">
                    <h3>Data Pasien</h3>
                    <p>Kelola data pasien hewan. Lihat riwayat medis, update informasi, dan rekam diagnosis.</p>
                    <a href="#" class="btn-dashboard">Kelola Pasien</a>
                </div>

                <div class="dashboard-card">
                    <h3>Pendaftaran Online</h3>
                    <p>Lihat pendaftaran pasien online. Konfirmasi janji temu, dan tangani kasus darurat.</p>
                    <a href="#" class="btn-dashboard">Kelola Pendaftaran</a>
                </div>

                <div class="dashboard-card">
                    <h3>Rekam Medis</h3>
                    <p>Akses dan kelola rekam medis pasien. Buat catatan baru, update diagnosis, dan lihat riwayat penyakit.</p>
                    <a href="#" class="btn-dashboard">Rekam Medis</a>
                </div>

            @elseif ($roleName == 'Perawat')
                <div class="dashboard-card">
                    <h3>Jadwal Tugas</h3>
                    <p>Lihat jadwal tugas dan shift Anda. Periksa janji temu pasien dan daftar tugas harian.</p>
                    <a href="#" class="btn-dashboard">Lihat Jadwal</a>
                </div>

                <div class="dashboard-card">
                    <h3>Antrian Pasien</h3>
                    <p>Lihat daftar antrian pasien yang akan diperiksa. Kelola panggilan pasien dan status kedatangan.</p>
                    <a href="#" class="btn-dashboard">Lihat Antrian</a>
                </div>

                <div class="dashboard-card">
                    <h3>Pendaftaran & Data Pasien</h3>
                    <p>Bantu dalam proses pendaftaran pasien dan kelola data dasar pasien hewan.</p>
                    <a href="#" class="btn-dashboard">Kelola Pasien</a>
                </div>

                <div class="dashboard-card">
                    <h3>Administrasi Klinis</h3>
                    <p>Kelola data administrasi terkait tindakan klinis, seperti pendataan suhu, berat, dan tindakan awal.</p>
                    <a href="#" class="btn-dashboard">Administrasi</a>
                </div>

            @elseif ($roleName == 'Resepsionis')
                <div class="dashboard-card">
                    <h3>Daftar Pasien</h3>
                    <p>Lihat pasien yang sudah terdaftar atau mulai registrasi pasien baru.</p>
                    <a href="{{ route('resepsionis.pasien') }}" class="btn-dashboard">Kelola Pasien</a>
                </div>

                <div class="dashboard-card">
                    <h3>Temu Dokter</h3>
                    <p>Atur janji temu antara pasien dengan dokter yang tersedia.</p>
                    <a href="{{ route('resepsionis.temu.dokter') }}" class="btn-dashboard">Atur Janji Temu</a>
                </div>
            
            @else 
                {{-- Ini mencakup Administrator dan 'Akses Terbatas' --}}
                @if ($roleName == 'Administrator')
                    <div class="dashboard-card">
                        <h2>Data Master</h2>
                        <p>Kelola data master sistem seperti user, jenis hewan, ras, kategori, dan kode tindakan terapi.</p>
                        <a href="{{ route('admin.datamaster') }}" class="btn-dashboard">Kelola Data Master</a>
                    </div>
                @else
                    {{-- Role selain Dokter, Perawat, Resepsionis, dan Administrator (e.g., Akses Terbatas) --}}
                    <div class="dashboard-card">
                        <h2>Akses Ditolak</h2>
                        <p>Role Anda belum memiliki menu dashboard yang spesifik. Silakan hubungi Administrator.</p>
                        <a href="{{ url('/') }}" class="btn-dashboard btn-logout">Kembali ke Beranda</a>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection