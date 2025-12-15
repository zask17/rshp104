@extends('layouts.app')

@section('content')
    <div class="page-container">
        <div class="page-header">
            <h1><i class="fas fa-user-friends"></i> Data Pemilik Hewan</h1>
            <p>Daftar lengkap semua pemilik hewan pasien yang terdaftar di sistem.</p>
        </div>

        <div class="main-content">
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

            {{-- Button Tambah --}}
            <a href="{{ route('resepsionis.pemilik.create') }}" class="add-btn">
                <i class="fas fa-user-plus"></i> Tambah Pemilik Baru
            </a>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pemilik</th>
                        <th>Alamat</th>
                        <th>No. Telepon (WA)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Variabel $pemiliks diambil dari PemilikController@index --}}
                    @forelse ($pemiliks as $pemilik)
                        <tr>
                            <td>{{ $pemilik->idpemilik }}</td>
                            <td>{{ $pemilik->nama_pemilik }}</td>
                            <td>{{ $pemilik->alamat }}</td>
                            <td>{{ $pemilik->no_wa }}</td>
                            <td class="action-buttons">
                                {{-- Button Edit --}}
                                <a href="{{ route('resepsionis.pemilik.edit', $pemilik->idpemilik) }}" class="edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                {{-- Form Delete --}}
                                <form action="{{ route('resepsionis.pemilik.destroy', $pemilik->idpemilik) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data pemilik {{ $pemilik->nama_pemilik }}?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak ada data pemilik yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection