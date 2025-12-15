@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="form-container">
        <h1><i class="fas fa-user-plus"></i> Registrasi Pasien (Walk-in)</h1>
        <p>Mendaftarkan pasien untuk kunjungan hari ini.</p>

        <a href="{{ route('resepsionis.pendaftaran.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Antrean Pendaftaran
        </a>

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('resepsionis.pendaftaran.store') }}" method="POST">
            @csrf

            {{-- Pasien (Pet) --}}
            <div class="form-group">
                <label for="idpet">Pilih Pasien (Pet) <span class="text-danger">*</span></label>
                <select id="idpet" name="idpet" required class="form-control select2-field">
                    <option value="">-- Cari Nama Pet atau Pemilik --</option>
                    @foreach ($pets as $pet)
                        <option value="{{ $pet->idpet }}" {{ old('idpet') == $pet->idpet ? 'selected' : '' }}>
                            {{ $pet->nama }} (Pemilik: {{ $pet->pemilik->nama_pemilik ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
                @error('idpet')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Dokter --}}
            <div class="form-group">
                <label for="iddokter">Pilih Dokter Bertugas <span class="text-danger">*</span></label>
                <select id="iddokter" name="iddokter" required class="form-control select2-field">
                    <option value="">-- Pilih Dokter --</option>
                    @foreach ($dokters as $dokter)
                        <option value="{{ $dokter->iduser }}" {{ old('iddokter') == $dokter->iduser ? 'selected' : '' }}>
                            {{ $dokter->nama }}
                        </option>
                    @endforeach
                </select>
                @error('iddokter')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Alasan/Keluhan --}}
            <div class="form-group">
                <label for="alasan">Alasan/Keluhan Singkat</label>
                <textarea id="alasan" name="alasan" rows="3"
                    placeholder="Contoh: Panas dan tidak nafsu makan">{{ old('alasan') }}</textarea>
                @error('alasan')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-check"></i> Daftarkan Pasien
            </button>
        </form>
    </div>
</div>