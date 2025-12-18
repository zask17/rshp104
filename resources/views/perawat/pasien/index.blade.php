@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Daftar Seluruh Pasien</h1>
        <p>Data hewan peliharaan yang terdaftar di sistem RSHP.</p>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Nama Pasien</th>
                <th>Jenis / Ras</th>
                <th>Pemilik</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pets as $pet)
            <tr>
                <td><strong>{{ $pet->nama }}</strong></td>
                <td>{{ $pet->nama_jenis_hewan }} / {{ $pet->nama_ras }}</td>
                <td>{{ $pet->nama_pemilik }}</td>
                <td><span class="status-badge status-confirmed">Terdaftar</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top:20px">{{ $pets->links() }}</div>
</div>
@endsection