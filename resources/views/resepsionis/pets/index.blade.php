@extends('layouts.app')

@section('content')
    <div class="page-container">
        <div class="page-header">
            <h1><i class="fas fa-cat"></i> Data Pasien (Pets)</h1>
            <p>Daftar lengkap semua hewan pasien yang terdaftar di sistem.</p>
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
            <a href="{{ route('resepsionis.pets.create') }}" class="add-btn">
                <i class="fas fa-plus"></i> Tambah Pasien Baru
            </a>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Pemilik</th>
                        <th>Jenis Hewan</th>
                        <th>Ras Hewan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Variabel $pets diambil dari PetController@index --}}
                    @forelse ($pets as $pet)
                        <tr>
                            <td>{{ $pet->idpet }}</td>
                            <td>{{ $pet->nama }}</td>
                            <td>{{ $pet->jenis_kelamin }}</td>
                            <td>{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d M Y') }}</td>
                            <td>{{ $pet->pemilik->nama_pemilik ?? 'N/A' }}</td>
                            <td>{{ $pet->jenisHewan->nama_jenis_hewan ?? 'N/A' }}</td>
                            <td>{{ $pet->rasHewan->nama_ras ?? 'N/A' }}</td>
                            <td class="action-buttons">
                                {{-- Button Edit --}}
                                <a href="{{ route('resepsionis.pets.edit', $pet->idpet) }}" class="edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                {{-- Form Delete --}}
                                <form action="{{ route('resepsionis.pets.destroy', $pet->idpet) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data pasien {{ $pet->nama }}?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center;">Tidak ada data pasien yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection