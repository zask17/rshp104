@extends('layouts.app')

@section('title', 'Tambah Data Pasien (Pet)')

@section('content')
<div class="page-container">
    <div class="form-container">
        <h1>Tambah Data Pasien (Pet)</h1>
        
        <a href="{{ route('admin.pets.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pasien
        </a>

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.pets.store') }}" method="POST">
            @csrf

            {{-- Nama Pet --}}
            <div class="form-group">
                {{-- FIX: Ubah nama_pet ke nama --}}
                <label for="nama">Nama Pasien <span class="text-danger">*</span></label>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old('nama') }}"
                    placeholder="Masukkan nama hewan"
                    required
                >
                @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Pemilik --}}
            <div class="form-group">
                <label for="idpemilik">Pemilik <span class="text-danger">*</span></label>
                <select id="idpemilik" name="idpemilik" required>
                    <option value="">Pilih Pemilik</option>
                    @foreach ($pemilik as $item)
                        <option value="{{ $item->idpemilik }}" {{ old('idpemilik') == $item->idpemilik ? 'selected' : '' }}>
                            {{ $item->nama_pemilik }} ({{ $item->no_hp ?? 'N/A' }})
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
                <select id="idjenis_hewan" name="idjenis_hewan" required>
                    <option value="">Pilih Jenis Hewan</option>
                    @foreach ($jenisHewan as $item)
                        <option value="{{ $item->idjenis_hewan }}" {{ old('idjenis_hewan') == $item->idjenis_hewan ? 'selected' : '' }}>
                            {{ $item->nama_jenis_hewan }}
                        </option>
                    @endforeach
                </select>
                @error('idjenis_hewan')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Ras Hewan (Dropdown ini memerlukan JS untuk filter dinamis) --}}
            <div class="form-group">
                <label for="idras_hewan">Ras Hewan <span class="text-danger">*</span></label>
                <select id="idras_hewan" name="idras_hewan" required>
                    <option value="">Pilih Jenis Hewan terlebih dahulu</option>
                    {{-- Opsi Ras Hewan akan diisi di sini --}}
                    @foreach ($rasHewan as $ras)
                        <option 
                            value="{{ $ras->idras_hewan }}" 
                            data-idjenis="{{ $ras->idjenis_hewan }}"
                            class="ras-option"
                            style="display:none;"
                            {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}
                        >
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
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input
                    type="date"
                    id="tanggal_lahir"
                    name="tanggal_lahir"
                    value="{{ old('tanggal_lahir') }}"
                >
                @error('tanggal_lahir')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                <select id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    {{-- FIX: Ubah ke Jantan/Betina sesuai Model Mutator --}}
                    <option value="Jantan" {{ old('jenis_kelamin') == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                    <option value="Betina" {{ old('jenis_kelamin') == 'Betina' ? 'selected' : '' }}>Betina</option>
                </select>
                @error('jenis_kelamin')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Warna --}}
            <div class="form-group">
                <label for="warna_tanda">Warna / Tanda Khas</label>
                <input
                    type="text"
                    id="warna_tanda"
                    name="warna_tanda"
                    value="{{ old('warna_tanda') }}"
                    placeholder="Contoh: Coklat Putih"
                >
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const jenisHewanSelect = document.getElementById('idjenis_hewan');
    const rasHewanSelect = document.getElementById('idras_hewan');
    const rasOptions = rasHewanSelect.querySelectorAll('.ras-option');
    // Simpan nilai lama (old value) untuk ras hewan
    const oldRasValue = '{{ old('idras_hewan') }}';

    function filterRas() {
        const selectedJenisId = jenisHewanSelect.value;
        let foundRas = false;
        
        // Reset selection and visibility
        rasHewanSelect.value = '';
        rasOptions.forEach(option => {
            option.style.display = 'none';
            option.removeAttribute('selected');
        });

        // Tampilkan opsi yang cocok dengan Jenis Hewan yang dipilih
        rasOptions.forEach(option => {
            if (option.getAttribute('data-idjenis') === selectedJenisId) {
                option.style.display = '';
                
                // Coba pilih ras yang sesuai dengan old value
                if (oldRasValue && option.value === oldRasValue && !foundRas) {
                     option.setAttribute('selected', 'selected');
                     rasHewanSelect.value = oldRasValue;
                     foundRas = true;
                }
                
                // Jika tidak ada old value yang dipilih, pilih yang pertama secara default
                if (!foundRas) {
                    // Hanya tandai yang pertama, jangan langsung set value
                    if(rasHewanSelect.value === '') {
                        rasHewanSelect.value = option.value;
                    }
                }
            }
        });
        
        // Pastikan rasHewanSelect memiliki value yang terlihat (jika tidak, reset)
        if (rasHewanSelect.querySelector('option:checked') && rasHewanSelect.querySelector('option:checked').style.display === 'none') {
            rasHewanSelect.value = '';
        }
        
        // Jika tidak ada jenis hewan yang dipilih, tampilkan opsi default
        if (!selectedJenisId) {
             rasHewanSelect.value = '';
        }
    }

    jenisHewanSelect.addEventListener('change', filterRas);

    // Initial run to handle old() values or default state
    filterRas();
});
</script>
@endsection