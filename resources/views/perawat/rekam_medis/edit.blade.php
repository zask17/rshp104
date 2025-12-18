@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Edit Rekam Medis: {{ $rm->nama_pet }}</h1>
    </div>

    <div class="form-container">
        <form action="{{ route('perawat.rm.update', $rm->idrekam_medis) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Anamnesa</label>
                <textarea name="anamnesa" rows="4" required>{{ $rm->anamnesa }}</textarea>
            </div>

            <div class="form-group">
                <label>Temuan Klinis</label>
                <textarea name="temuan_klinis" rows="4">{{ $rm->temuan_klinis }}</textarea>
            </div>

            <div class="form-group">
                <label>Diagnosa</label>
                <textarea name="diagnosa" rows="3" required>{{ $rm->diagnosa }}</textarea>
            </div>

            <button type="submit" class="btn-submit">Perbarui Rekam Medis</button>
            <a href="{{ route('perawat.rm.index') }}" class="back-link" style="display:block; text-align:center; margin-top:15px;">Batal</a>
        </form>
    </div>
</div>
@endsection