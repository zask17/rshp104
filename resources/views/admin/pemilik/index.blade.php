@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Manajemen Data Pemilik</h1>
        <p>Kelola data lengkap pemilik hewan peliharaan.</p>
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
        <a href="{{ route('admin.pemilik.create') }}" class="add-btn">
            <i class="fas fa-user-plus"></i> Tambah Pemilik
        </a>

        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pemilik</th>
                    <th>Nomor WhatsApp</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pemilik as $item)
                <tr>
                    <td>{{ $item->idpemilik }}</td>
                    <td>{{ $item->nama_pemilik }}</td>
                    <td>{{ $item->no_wa }}</td>
                    <td>{{ $item->email ?? '-' }}</td>
                    <td>{{ Str::limit($item->alamat, 50) }}</td>
                    <td class="action-buttons">
                        {{-- Button Edit --}}
                        <a href="{{ route('admin.pemilik.edit', $item->idpemilik) }}" class="edit-btn">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        {{-- Form Delete --}}
                        <form action="{{ route('admin.pemilik.destroy', $item->idpemilik) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus data pemilik {{ $item->nama_pemilik }}? Tindakan ini tidak dapat dibatalkan.')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data pemilik yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection