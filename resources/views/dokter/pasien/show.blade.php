@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Detail Pasien: {{ $pet->nama }}</h1>
    </div>

    <a href="{{ route('dokter.pasien.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pasien
    </a>

    <div class="dashboard-grid">
        {{-- Informasi Hewan --}}
        <div class="dashboard-card" style="text-align: left;">
            <h3 style="background-color: #3EA2C7; width: 100%;">Informasi Hewan</h3>
            <div style="padding-top: 15px;">
                <p><strong>Jenis Kelamin:</strong> {{ $pet->jenis_kelamin == '1' ? 'Jantan' : 'Betina' }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d F Y') }}</p>
                <p><strong>Usia:</strong> {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} Tahun</p>
                <p><strong>Jenis Hewan:</strong> {{ $pet->nama_jenis_hewan }}</p>
                <p><strong>Ras:</strong> {{ $pet->nama_ras }}</p>
                <p><strong>Warna/Tanda:</strong> {{ $pet->warna_tanda }}</p>
            </div>
        </div>

        {{-- Informasi Pemilik --}}
        <div class="dashboard-card" style="text-align: left;">
            <h3 style="background-color: #2ecc71; width: 100%;">Informasi Pemilik</h3>
            <div style="padding-top: 15px;">
                <p><strong>Nama Pemilik:</strong> {{ $pet->nama_pemilik }}</p>
                <p><strong>Email:</strong> {{ $pet->email_pemilik }}</p>
                <p><strong>No. WA:</strong> {{ $pet->no_wa }}</p>
                <p><strong>Alamat:</strong> {{ $pet->alamat }}</p>
            </div>
        </div>
    </div>

    <div class="subjudul">Riwayat Rekam Medis</div>
    
    @forelse ($riwayat_rekam_medis as $rm)
        <div class="dashboard-card" style="margin-bottom: 20px; text-align: left; border-left: 5px solid #6588e8;">
            <p><strong>Tanggal Pemeriksaan:</strong> {{ \Carbon\Carbon::parse($rm->created_at)->format('d F Y H:i') }}</p>
            <p><strong>Dokter Pemeriksa:</strong> {{ $rm->nama_dokter }}</p>
            <hr>
            <p><strong>Anamnesa:</strong><br>{{ $rm->anamnesa }}</p>
            <p><strong>Diagnosa:</strong><br><span style="color: #e74c3c; font-weight: bold;">{{ $rm->diagnosa }}</span></p>
            <div style="text-align: right; margin-top: 10px;">
                <a href="{{ route('dokter.rekam-medis.show', $rm->idrekam_medis) }}" class="btn-dashboard">Lihat Detail Tindakan</a>
            </div>
        </div>
    @empty
        <div class="alert alert-basic" style="background-color: #fcf8e3; color: #8a6d3b; border-color: #faebcc;">
            <i class="fas fa-info-circle"></i> Belum ada riwayat Rekam Medis untuk pasien ini.
        </div>
    @endforelse
</div>
@endsection