{{-- resources/views/dokter/pasien/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Data Semua Pasien (Pet)</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped data-table">
            <thead>
                <tr>
                    <th>ID Pet</th>
                    <th>Nama Pet</th>
                    <th>Jenis Hewan</th>
                    <th>Ras</th>
                    <th>Pemilik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pets as $pet)
                    <tr>
                        <td>{{ $pet->idpet }}</td>
                        <td>{{ $pet->nama }}</td>
                        <td>{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                        <td>{{ $pet->rasHewan->nama_ras ?? '-' }}</td>
                        <td>{{ $pet->pemilik->user->nama ?? 'Pemilik Tidak Terdaftar' }}</td>
                        <td>
                            <a href="{{ route('dokter.pasien.show', $pet->idpet) }}" class="btn btn-info btn-sm">Lihat Riwayat</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada pasien terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="d-flex justify-content-center">
        {{ $pets->links() }}
    </div>
</div>
@endsection