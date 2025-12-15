{{-- resources/views/dokter/rekam_medis/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Janji Temu</a>
    <h2>Buat Rekam Medis Baru</h2>
    
    <div class="alert alert-info">
        <p>Pasien: <strong>{{ $temuDokter->pet->nama }}</strong> (Pemilik: {{ $temuDokter->pet->pemilik->user->nama ?? '-' }})</p>
        <p>Janji Temu: {{ \Carbon\Carbon::parse($temuDokter->tanggal_temu)->format('d F Y') }} pukul {{ \Carbon\Carbon::parse($temuDokter->waktu_temu)->format('H:i') }}</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dokter.rekam-medis.store') }}" method="POST">
        @csrf
        <input type="hidden" name="idreservasi_dokter" value="{{ $temuDokter->idreservasi_dokter }}">

        <div class="form-group mb-3">
            <label for="anamnesa">Anamnesa (Riwayat Pasien)</label>
            <textarea name="anamnesa" id="anamnesa" class="form-control" rows="4" required>{{ old('anamnesa') }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="temuan_klinis">Temuan Klinis (Hasil Pemeriksaan Fisik/Penunjang)</label>
            <textarea name="temuan_klinis" id="temuan_klinis" class="form-control" rows="4" required>{{ old('temuan_klinis') }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="diagnosa">Diagnosa</label>
            <textarea name="diagnosa" id="diagnosa" class="form-control" rows="3" required>{{ old('diagnosa') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Buat Rekam Medis & Lanjut ke Detail Tindakan</button>
    </form>
</div>
@endsection