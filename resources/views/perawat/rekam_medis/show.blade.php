@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Detail Riwayat Medis: {{ $rekamMedis->nama_pet }}</h1>
        <p>Pemeriksaan dilakukan pada {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d F Y H:i') }}</p>
    </div>

    <div class="dashboard-card" style="text-align:left; margin-bottom:30px; border-left: 5px solid #6588e8;">
        <h3><i class="fas fa-stethoscope"></i> Catatan Diagnosa</h3>
        <div style="padding: 15px;">
            <p><strong>Anamnesa:</strong><br>{{ $rekamMedis->anamnesa }}</p>
            <p><strong>Diagnosa Utama:</strong><br><span style="color: #e74c3c; font-weight: bold;">{{ $rekamMedis->diagnosa }}</span></p>
            <p><strong>Temuan Klinis:</strong><br>{{ $rekamMedis->temuan_klinis ?? '-' }}</p>
        </div>
    </div>

    <div class="subjudul">Daftar Tindakan & Terapi</div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Kategori</th>
                <th>Deskripsi Tindakan</th>
                <th>Catatan Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse($details as $d)
            <tr>
                <td><span class="status-badge status-completed">{{ $d->kode }}</span></td>
                <td>{{ $d->nama_kategori }}</td>
                <td>{{ $d->deskripsi_tindakan_terapi }}</td>
                <td>{{ $d->detail ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center;">Belum ada tindakan medis yang tercatat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="text-align:center; margin-top:30px">
        <a href="{{ route('perawat.rm.index') }}" class="btn-dashboard">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>
@endsection