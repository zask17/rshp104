{{-- resources/views/dokter/rekam_medis/show.blade.php --}}
@extends('layouts.app') 

@section('content')
<div class="container mt-4">
    <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Janji Temu</a>
    <h2>Rekam Medis Pasien: {{ $rekamMedis->temuDokter->pet->nama }}</h2>
    <p>Pemeriksaan oleh: {{ $rekamMedis->dokter->user->nama ?? 'Dokter' }} pada {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d F Y H:i') }}</p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            Periksa input Anda di form Tambah Tindakan/Terapi.
        </div>
    @endif

    {{-- Detail Rekam Medis Utama --}}
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">Diagnosis dan Temuan</div>
        <div class="card-body">
            <h5>Anamnesa:</h5>
            <p>{{ $rekamMedis->anamnesa }}</p>
            <hr>
            <h5>Temuan Klinis:</h5>
            <p>{{ $rekamMedis->temuan_klinis }}</p>
            <hr>
            <h5>Diagnosa:</h5>
            <p class="font-weight-bold">{{ $rekamMedis->diagnosa }}</p>
        </div>
    </div>
    
    {{-- Tabel Detail Tindakan / Terapi (CRUD) --}}
    <h3>Detail Tindakan / Terapi</h3>
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-sm">
            <thead class="bg-light">
                <tr>
                    <th>Kode</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Detail (Dosis/Catatan)</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekamMedis->detailRekamMedis as $detail)
                <tr>
                    <td>{{ $detail->kodeTindakanTerapi->kode }}</td>
                    <td>{{ $detail->kodeTindakanTerapi->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi }}</td>
                    <td>{{ $detail->detail }}</td>
                    <td>
                        {{-- Form Delete --}}
                        <form action="{{ route('dokter.detail-rekam-medis.destroy', $detail->iddetail_rekam_medis) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus detail ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada tindakan atau terapi yang dicatat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Form Tambah Tindakan/Terapi Baru --}}
    <h4>Tambah Tindakan/Terapi Baru</h4>
    <div class="card p-3">
        <form action="{{ route('dokter.detail-rekam-medis.store', $rekamMedis->idrekam_medis) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="idkode_tindakan_terapi">Tindakan / Terapi:</label>
                    <select name="idkode_tindakan_terapi" class="form-control" required>
                        <option value="">Pilih Kode Tindakan</option>
                        @foreach($kodeTindakanTerapi as $kode)
                            <option value="{{ $kode->idkode_tindakan_terapi }}" {{ old('idkode_tindakan_terapi') == $kode->idkode_tindakan_terapi ? 'selected' : '' }}>
                                {{ $kode->kode }} - {{ $kode->deskripsi_tindakan_terapi }} ({{ $kode->kategori->nama_kategori ?? 'Tanpa Kategori' }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="detail">Detail Tambahan (Dosis/Catatan):</label>
                    <textarea name="detail" class="form-control" rows="1">{{ old('detail') }}</textarea>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Detail Tindakan/Terapi</button>
        </form>
    </div>
</div>
@endsection