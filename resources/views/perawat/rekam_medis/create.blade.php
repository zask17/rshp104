@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Input Rekam Medis Baru</h1>
    </div>
    <div class="form-container">
        <form action="{{ route('perawat.rm.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Pilih Janji Temu Pasien</label>
                <select name="idreservasi_dokter" required>
                    @foreach($janjiTemu as $jt)
                        <option value="{{ $jt->idreservasi_dokter }}">{{ $jt->nama_pet }} ({{ $jt->tanggal_temu }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Anamnesa</label>
                <textarea name="anamnesa" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label>Temuan Klinis</label>
                <textarea name="temuan_klinis" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Diagnosa</label>
                <textarea name="diagnosa" rows="2" required></textarea>
            </div>
            <button type="submit" class="btn-submit">Simpan Rekam Medis</button>
        </form>
    </div>
</div>
@endsection