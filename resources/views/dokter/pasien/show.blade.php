@extends('layouts.app')

@section('content')
<div class="page-container">
    {{-- Header dengan Gradient sesuai style.css --}}
    <div class="page-header">
        <h1>Detail Pasien: {{ $pet->nama }}</h1>
        <p>Lihat informasi lengkap hewan peliharaan dan riwayat medisnya di sini.</p>
    </div>

    <a href="{{ route('dokter.pasien.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pasien
    </a>

    {{-- Grid Informasi Dasar menggunakan .dashboard-grid dari style.css --}}
    <div class="dashboard-grid">
        {{-- Card Informasi Hewan --}}
        <div class="dashboard-card" style="text-align: left;">
            <h3 style="background-color: #3EA2C7; width: 100%;">
                <i class="fas fa-paw"></i> Informasi Hewan
            </h3>
            <div style="padding-top: 15px;">
                <p><strong>Jenis Kelamin:</strong> {{ $pet->jenis_kelamin }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d F Y') }}</p>
                <p><strong>Usia:</strong> {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} Tahun</p>
                <p><strong>Jenis Hewan:</strong> {{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</p>
                <p><strong>Ras:</strong> {{ $pet->rasHewan->nama_ras ?? '-' }}</p>
                <p><strong>Warna/Tanda:</strong> {{ $pet->warna_tanda }}</p>
            </div>
        </div>

        {{-- Card Informasi Pemilik --}}
        <div class="dashboard-card" style="text-align: left;">
            <h3 style="background-color: #2ecc71; width: 100%;">
                <i class="fas fa-user"></i> Informasi Pemilik
            </h3>
            <div style="padding-top: 15px;">
                <p><strong>Nama Pemilik:</strong> {{ $pet->pemilik->user->nama ?? '-' }}</p>
                <p><strong>Email:</strong> {{ $pet->pemilik->user->email ?? '-' }}</p>
                <p><strong>No. WA:</strong> {{ $pet->pemilik->no_wa ?? '-' }}</p>
                <p><strong>Alamat:</strong> {{ $pet->pemilik->alamat ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Riwayat Rekam Medis --}}
    <div class="subjudul">Riwayat Rekam Medis</div>
    
    @forelse ($riwayat_rekam_medis as $temu)
        <div class="dashboard-card" style="margin-bottom: 20px; text-align: left; border-left: 5px solid #6588e8;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                <h4 style="color: #1e3c72; margin: 0;">
                    <i class="fas fa-calendar-check"></i> 
                    Pemeriksaan: {{ \Carbon\Carbon::parse($temu->rekamMedis->created_at)->format('d F Y H:i') }}
                </h4>
                <span class="status-badge status-confirmed">Selesai</span>
            </div>
            
            <div style="padding: 15px 0;">
                <p><strong>Dokter Pemeriksa:</strong> {{ $temu->dokter->user->nama ?? '-' }}</p>
                <p><strong>Diagnosa:</strong><br>{{ $temu->rekamMedis->diagnosa }}</p>
            </div>

            <div style="text-align: right;">
                <a href="{{ route('dokter.rekam-medis.show', $temu->rekamMedis->idrekam_medis) }}" class="btn-dashboard" style="font-size: 14px; padding: 8px 15px;">
                    Lihat Detail Lengkap & Tindakan
                </a>
            </div>
        </div>
    @empty
        <div class="alert alert-basic" style="background-color: #fcf8e3; color: #8a6d3b; border-color: #faebcc;">
            <i class="fas fa-exclamation-triangle"></i> Belum ada riwayat Rekam Medis untuk pasien ini.
        </div>
    @endforelse

</div>
@endsection