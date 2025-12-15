{{-- resources/views/dokter/pasien/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <a href="{{ route('dokter.pasien.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Pasien</a>
    <h2>Detail Pasien: {{ $pet->nama }}</h2>
    
    {{-- Informasi Dasar Pasien --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Informasi Hewan</div>
        <div class="card-body">
            <p><strong>Jenis Kelamin:</strong> {{ $pet->jenis_kelamin == 'L' ? 'Jantan' : 'Betina' }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d F Y') }}</p>
            <p><strong>Usia:</strong> {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} tahun</p>
            <p><strong>Jenis Hewan:</strong> {{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</p>
            <p><strong>Ras:</strong> {{ $pet->rasHewan->nama_ras ?? '-' }}</p>
            <p><strong>Warna/Tanda:</strong> {{ $pet->warna_tanda }}</p>
        </div>
    </div>

    {{-- Informasi Pemilik --}}
    <div class="card mb-4">
        <div class="card-header bg-success text-white">Informasi Pemilik</div>
        <div class="card-body">
            <p><strong>Nama Pemilik:</strong> {{ $pet->pemilik->user->nama ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $pet->pemilik->user->email ?? '-' }}</p>
            <p><strong>No. WA:</strong> {{ $pet->pemilik->no_wa ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $pet->pemilik->alamat ?? '-' }}</p>
        </div>
    </div>

    {{-- Riwayat Rekam Medis --}}
    <h3>Riwayat Rekam Medis</h3>
    @forelse ($riwayat_rekam_medis as $temu)
        <div class="card mb-3">
            <div class="card-header">
                Pemeriksaan Tanggal: {{ \Carbon\Carbon::parse($temu->rekamMedis->created_at)->format('d F Y H:i') }}
            </div>
            <div class="card-body">
                <p><strong>Dokter Pemeriksa:</strong> {{ $temu->dokter->user->nama ?? '-' }}</p>
                <p><strong>Diagnosa:</strong> {{ Str::limit($temu->rekamMedis->diagnosa, 150) }}</p>
                <a href="{{ route('dokter.rekam-medis.show', $temu->rekamMedis->idrekam_medis) }}" class="btn btn-sm btn-primary">Lihat Detail RM</a>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">Belum ada riwayat Rekam Medis untuk pasien ini.</div>
    @endforelse

</div>
@endsection