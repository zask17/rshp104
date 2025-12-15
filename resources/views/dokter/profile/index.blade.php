{{-- resources/views/dokter/profile/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Profil Saya</h2>
    
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Informasi Akun</div>
        <div class="card-body">
            <p><strong>Nama Lengkap:</strong> {{ $user->nama }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Jabatan:</strong> {{ $user->roleUser->firstWhere('idrole', 2)->role->nama_role ?? 'Tidak Terdaftar' }}</p>
            <p><strong>Status Role:</strong> <span class="badge {{ $role_user_dokter->status == 1 ? 'bg-success' : 'bg-danger' }}">{{ $role_user_dokter->status == 1 ? 'Aktif' : 'Nonaktif' }}</span></p>
            
        </div>
    </div>
    
    {{-- Statistik --}}
    <div class="card mb-4">
        <div class="card-header bg-info text-white">Statistik Kinerja</div>
        <div class="card-body">
            <p><strong>Total Rekam Medis Ditangani:</strong> {{ number_format($jumlah_rekam_medis) }}</p>
            {{-- Tambahkan statistik lain jika ada --}}
        </div>
    </div>
    
    {{-- Di sini Anda bisa menambahkan form untuk mengubah profil jika diinginkan --}}
    
</div>
@endsection