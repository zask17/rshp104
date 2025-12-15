{{-- resources/views/dokter/rekam_medis/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Janji Temu Saya & Rekam Medis</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped data-table">
            <thead>
                <tr>
                    <th>No. Urut</th>
                    <th>Tanggal/Waktu Temu</th>
                    <th>Pasien (Pet)</th>
                    <th>Pemilik</th>
                    <th>Status</th>
                    <th>RM Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($temuDokters as $temu)
                    <tr>
                        <td>{{ $temu->no_urut }}</td>
                        <td>{{ \Carbon\Carbon::parse($temu->tanggal_temu)->format('d M Y') }} / {{ \Carbon\Carbon::parse($temu->waktu_temu)->format('H:i') }}</td>
                        <td>{{ $temu->pet->nama }}</td>
                        <td>{{ $temu->pet->pemilik->user->nama ?? '-' }}</td>
                        <td><span class="badge {{ $temu->status == 'Selesai' ? 'bg-success' : 'bg-warning' }}">{{ $temu->status }}</span></td>
                        <td>
                            @if ($temu->rekamMedis)
                                <span class="badge bg-primary">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Belum Ada</span>
                            @endif
                        </td>
                        <td>
                            @if ($temu->rekamMedis)
                                <a href="{{ route('dokter.rekam-medis.show', $temu->rekamMedis->idrekam_medis) }}" class="btn btn-primary btn-sm">Lihat RM</a>
                            @else
                                <a href="{{ route('dokter.rekam-medis.create', $temu->idreservasi_dokter) }}" class="btn btn-success btn-sm">Buat RM</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada janji temu yang harus Anda tangani.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $temuDokters->links() }}
    </div>
</div>
@endsection