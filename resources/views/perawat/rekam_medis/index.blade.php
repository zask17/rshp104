@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Manajemen Rekam Medis (Perawat)</h1>
        <p>Gunakan halaman ini untuk memantau dan mengelola data riwayat medis pasien.</p>
    </div>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pemeriksaan</th>
                <th>Nama Pasien</th>
                <th>Dokter Pemeriksa</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekamMedis as $rm)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($rm->created_at)->format('d F Y') }}</td>
                <td><strong>{{ $rm->nama_pet }}</strong></td>
                <td>{{ $rm->nama_dokter }}</td>
                <td style="text-align: center;">
                    <a href="{{ route('perawat.rm.show', $rm->idrekam_medis) }}" class="edit-link">
                        <i class="fas fa-eye"></i> Detail
                    </a> |
                    <form action="{{ route('perawat.rm.destroy', $rm->idrekam_medis) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="delete-link" onclick="return confirm('Apakah Anda yakin ingin menghapus data rekam medis ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 20px;">{{ $rekamMedis->links() }}</div>
</div>
@endsection