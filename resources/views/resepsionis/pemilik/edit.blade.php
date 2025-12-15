@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="form-container">
        <h1><i class="fas fa-edit"></i> Edit Pemilik: {{ $pemilik->nama_pemilik }}</h1>
        
        <a href="{{ route('resepsionis.pemilik.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pemilik
        </a>

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('resepsionis.pemilik.update', $pemilik->idpemilik) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Pemilik --}}
            <div class="form-group">
                <label for="nama">Nama Pemilik <span class="text-danger">*</span></label>
                {{-- Nama kolom di PemilikController adalah 'nama' --}}
                <input type="text" id="nama" name="nama" value="{{ old('nama', $pemilik->nama) }}" required>
                @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- No. Telepon (WA) --}}
            <div class="form-group">
                <label for="telepon">No. Telepon (WA) <span class="text-danger">*</span></label>
                {{-- Nama kolom di PemilikController adalah 'telepon' --}}
                <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $pemilik->telepon) }}" required>
                @error('telepon')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="form-group">
                <label for="alamat">Alamat <span class="text-danger">*</span></label>
                <textarea id="alamat" name="alamat" rows="3" required>{{ old('alamat', $pemilik->alamat) }}</textarea>
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