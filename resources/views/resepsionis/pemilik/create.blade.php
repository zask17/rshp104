@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="form-container">
        <h1><i class="fas fa-user-plus"></i> Tambah Pemilik Baru</h1>
        
        <a href="{{ route('resepsionis.pemilik.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pemilik
        </a>

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('resepsionis.pemilik.store') }}" method="POST">
            @csrf

            {{-- Nama Pemilik --}}
            <div class="form-group">
                <label for="nama">Nama Pemilik <span class="text-danger">*</span></label>
                {{-- Nama kolom di PemilikController adalah 'nama' --}}
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- No. Telepon (WA) --}}
            <div class="form-group">
                <label for="telepon">No. Telepon (WA) <span class="text-danger">*</span></label>
                {{-- Nama kolom di PemilikController adalah 'telepon' --}}
                <input type="text" id="telepon" name="telepon" value="{{ old('telepon') }}" required placeholder="Contoh: 081234567890">
                @error('telepon')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="form-group">
                <label for="alamat">Alamat <span class="text-danger">*</span></label>
                <textarea id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Data Pemilik
            </button>
        </form>
    </div>
</div>
@endsection