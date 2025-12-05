@extends('layouts.app')

@section('title', 'Edit Data Pemilik')

@section('content')
<div class="page-container">
    <div class="form-container">
        <h1>Edit Data Pemilik: {{ $pemilik->nama_pemilik }}</h1>
        
        <a href="{{ route('admin.pemilik.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pemilik
        </a>

        <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
            @csrf
            @method('PUT') {{-- Gunakan metode PUT untuk update --}}

            {{-- Nama Pemilik --}}
            <div class="form-group">
                <label for="nama_pemilik">Nama Pemilik <span class="text-danger">*</span></label>
                <input
                    type="text"
                    id="nama_pemilik"
                    name="nama_pemilik"
                    value="{{ old('nama_pemilik', $pemilik->nama_pemilik) }}"
                    placeholder="Masukkan nama lengkap pemilik"
                    required
                >
                @error('nama_pemilik')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nomor WhatsApp --}}
            <div class="form-group">
                <label for="no_wa">Nomor WhatsApp <span class="text-danger">*</span></label>
                <input
                    type="text"
                    id="no_wa"
                    name="no_wa"
                    value="{{ old('no_wa', $pemilik->no_wa) }}"
                    placeholder="Masukkan nomor WhatsApp aktif"
                    required
                >
                @error('no_wa')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Email (Optional) --}}
            <div class="form-group">
                <label for="email">Email (Opsional)</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $pemilik->email) }}"
                    placeholder="Masukkan alamat email (jika ada)"
                >
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="form-group">
                <label for="alamat">Alamat Lengkap <span class="text-danger">*</span></label>
                <textarea
                    id="alamat"
                    name="alamat"
                    rows="3"
                    placeholder="Masukkan alamat lengkap pemilik"
                    required
                >{{ old('alamat', $pemilik->alamat) }}</textarea>
                @error('alamat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Perbarui Data Pemilik
            </button>
        </form>
    </div>
</div>
@endsection