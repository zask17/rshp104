@extends('layouts.app')

@section('content')
<div class="page-container">
    {{-- Header dengan Gradient sesuai style.css --}}
    <div class="page-header">
        <h1>Daftar Pasien Terdaftar (Pets)</h1>
        <p>Gunakan halaman ini untuk melihat informasi medis pasien hewan yang terdaftar di RSHP UNAIR.</p>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Data dengan class .data-table dari style.css --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>ID Pet</th>
                <th>Nama Pet</th>
                <th>Jenis Hewan</th>
                <th>Ras</th>
                <th>Nama Pemilik</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pets as $pet)
                <tr>
                    <td>{{ $pet->idpet }}</td>
                    <td><strong>{{ $pet->nama }}</strong></td>
                    <td>{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                    <td>{{ $pet->rasHewan->nama_ras ?? '-' }}</td>
                    <td>{{ $pet->pemilik->user->nama ?? 'Pemilik Tidak Terdaftar' }}</td>
                    <td style="text-align: center;">
                        {{-- Menggunakan style .edit-link (warna oranye) dari style.css --}}
                        <a href="{{ route('dokter.pasien.show', $pet->idpet) }}" class="edit-link">
                            <i class="fas fa-eye"></i> Lihat Riwayat Medis
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada data pasien yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Navigasi Paginasi --}}
    <div style="margin-top: 20px; display: flex; justify-content: center;">
        {{ $pets->links() }}
    </div>
</div>
@endsection