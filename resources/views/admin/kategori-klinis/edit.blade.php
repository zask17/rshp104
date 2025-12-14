@extends('layouts.app')

@section('title', 'Edit Kategori Klinis')

@section('content')
<div class="page-container">
    <div class="form-container">
        <h1>Edit Kategori Klinis: {{ $kategoriKlinis->nama_kategori_klinis }}</h1>
        
        <a href="{{ route('admin.kategori-klinis.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Kategori Klinis
        </a>

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.kategori-klinis.update', $kategoriKlinis->idkategori_klinis) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_kategori_klinis">Nama Kategori Klinis Baru <span class="text-danger">*</span></label>
                <input
                    type="text"
                    id="nama_kategori_klinis"
                    name="nama_kategori_klinis"
                    {{-- Mengambil nilai lama dari session, atau nilai dari database --}}
                    value="{{ old('nama_kategori_klinis', $kategoriKlinis->nama_kategori_klinis) }}"
                    placeholder="Masukkan nama kategori klinis"
                    class="@error('nama_kategori_klinis') is-invalid @enderror"
                    required
                >
                @error('nama_kategori_klinis')
                    <div class="invalid-feedback" style="color: red; font-size: 0.9em;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit" style="background-color: #f1c40f; color: black;">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection