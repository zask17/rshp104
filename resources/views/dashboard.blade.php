@extends('layouts.app') 

@section('title', 'Dashboard - RSHP UNAIR')

@section('content')

 
    <div class="dashboard-container">
        <div class="welcome-section">
            <h1>Selamat Datang di Dashboard RSHP UNAIR</h1>
            <p>Halo, {{ htmlspecialchars(ucfirst($user->nama)) }}!
                Anda login sebagai {{ htmlspecialchars(ucfirst($roleName)) }}.</p>
        </div>

        <div class="dashboard-grid">
            
            @if ($roleName == 'Administrator')
                {{-- Menu untuk Administrator --}}
                <div class="dashboard-card">
                    <h2>Data Master</h2>
                    <p>Kelola data master sistem seperti user, jenis hewan, ras, kategori, dan kode tindakan terapi.</p>
                    {{-- Mengarahkan ke rute Data Master yang akan menampilkan datamaster.blade.php --}}
                    <a href="{{ route('admin.datamaster') }}" class="btn-dashboard">Kelola Data Master</a>
                </div>

            @elseif ($roleName == 'Dokter')
                {{-- Menu untuk Dokter --}}
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
                
                {{-- ... Tambahkan menu Dokter lainnya sesuai admindashboard.php ... --}}

            @elseif ($roleName == 'Perawat')
                {{-- Menu untuk Perawat --}}
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
                
                {{-- ... Tambahkan menu Perawat lainnya sesuai admindashboard.php ... --}}

            @elseif ($roleName == 'Resepsionis')
                {{-- Menu untuk Resepsionis --}}
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
                {{-- Pesan default jika role tidak dikenal atau belum diatur --}}
                <div class="dashboard-card">
                    <h2>Akses Terbatas</h2>
                    <p>Role Anda ({{ $roleName ?? 'Tidak Dikenal' }}) belum memiliki menu dashboard. Silakan hubungi Administrator.</p>
                </div>
            @endif
        </div>
    </div>

@endsection