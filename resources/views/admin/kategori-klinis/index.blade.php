@extends('layouts.app')

@section('title', 'Manajemen Kategori Klinis')

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Manajemen Kategori Klinis</h1>
        <p>Kelola kategori yang digunakan untuk keperluan klinis dan rekam medis.</p>
    </div>

    <div class="main-content">
        {{-- Menampilkan pesan Session (Success/Error) --}}
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form Tambah Kategori Klinis Baru --}}
        <div class="form-container" style="margin-bottom: 30px; padding: 20px;">
            <h2 class="form-title-text">Tambah Kategori Klinis Baru</h2>
            <form action="{{ route('admin.kategori-klinis.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_kategori_klinis">Nama Kategori Klinis <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        id="nama_kategori_klinis"
                        name="nama_kategori_klinis"
                        value="{{ old('nama_kategori_klinis') }}"
                        placeholder="Contoh: Terapi"
                        class="@error('nama_kategori_klinis') is-invalid @enderror"
                        required
                    >
                    @error('nama_kategori_klinis')
                        <div class="invalid-feedback" style="color: red; font-size: 0.9em;">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </form>
        </div>
        
        {{-- Tabel Daftar Kategori Klinis --}}
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori Klinis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategoriKlinis as $item)
                <tr>
                    <td>{{ $item->idkategori_klinis }}</td>
                    <td>{{ $item->nama_kategori_klinis }}</td>
                    <td class="action-buttons">
                        {{-- Button Edit --}}
                        <a href="{{ route('admin.kategori-klinis.edit', $item->idkategori_klinis) }}" class="edit-btn">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        {{-- Form Delete --}}
                        <form action="{{ route('admin.kategori-klinis.destroy', $item->idkategori_klinis) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori klinis {{ $item->nama_kategori_klinis }}? Tindakan ini tidak dapat dibatalkan jika masih ada relasi data.')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center;">Tidak ada data kategori klinis.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection