@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="form-container">
        <h1><i class="fas fa-plus"></i> Tambah Pasien Baru</h1>
        
        <a href="{{ route('resepsionis.pets.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pasien
        </a>

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('resepsionis.pets.store') }}" method="POST">
            @csrf

            {{-- Nama Pasien --}}
            <div class="form-group">
                <label for="nama">Nama Pasien <span class="text-danger">*</span></label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Pemilik --}}
            <div class="form-group">
                <label for="idpemilik">Pemilik <span class="text-danger">*</span></label>
                <select id="idpemilik" name="idpemilik" required class="form-control select2-field">
                    <option value="">-- Pilih Pemilik --</option>
                    {{-- $pemiliks dikirim dari PetController@create --}}
                    @foreach ($pemiliks as $pemilik)
                        <option value="{{ $pemilik->idpemilik }}" {{ old('idpemilik') == $pemilik->idpemilik ? 'selected' : '' }}>
                            {{ $pemilik->nama_pemilik }} (ID: {{ $pemilik->idpemilik }})
                        </option>
                    @endforeach
                </select>
                @error('idpemilik')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jenis Hewan --}}
            <div class="form-group">
                <label for="idjenis_hewan">Jenis Hewan <span class="text-danger">*</span></label>
                <select id="idjenis_hewan" name="idjenis_hewan" required class="form-control">
                    <option value="">-- Pilih Jenis Hewan --</option>
                    {{-- $jenisHewans dikirim dari PetController@create --}}
                    @foreach ($jenisHewans as $jenis)
                        <option value="{{ $jenis->idjenis_hewan }}" {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}>
                            {{ $jenis->nama_jenis_hewan }}
                        </option>
                    @endforeach
                </select>
                @error('idjenis_hewan')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Ras Hewan --}}
            <div class="form-group">
                <label for="idras_hewan">Ras Hewan (Opsional)</label>
                <select id="idras_hewan" name="idras_hewan" class="form-control">
                    <option value="">-- Pilih Ras Hewan --</option>
                    {{-- $rasHewans dikirim dari PetController@create --}}
                    @foreach ($rasHewans as $ras)
                        <option value="{{ $ras->idras_hewan }}" {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}>
                            {{ $ras->nama_ras }}
                        </option>
                    @endforeach
                </select>
                @error('idras_hewan')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tanggal Lahir --}}
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                @error('tanggal_lahir')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                <select id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Jantan" {{ old('jenis_kelamin') == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                    <option value="Betina" {{ old('jenis_kelamin') == 'Betina' ? 'selected' : '' }}>Betina</option>
                </select>
                @error('jenis_kelamin')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Warna/Tanda --}}
            <div class="form-group">
                <label for="warna_tanda">Warna/Tanda Khas</label>
                <input type="text" id="warna_tanda" name="warna_tanda" value="{{ old('warna_tanda') }}" placeholder="Contoh: Putih belang coklat">
                @error('warna_tanda')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Data Pasien
            </button>
        </form>
    </div>
</div>

@push('styles')
    {{-- Select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single { height: 40px !important; }
        .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 38px !important; }
        .select2-container--default .select2-selection--single .select2-selection__arrow { height: 38px !important; }
    </style>
@endpush

@push('scripts')
    {{-- Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Aktifkan Select2 hanya untuk dropdown Pemilik
            $('#idpemilik').select2({
                theme: "default",
                placeholder: "Cari Pemilik",
                allowClear: true
            });
        });
    </script>
@endpush