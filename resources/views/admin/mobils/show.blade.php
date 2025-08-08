@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Detail Mobil</div>
    <div class="card-body">
        <p><strong>Merk:</strong> {{ $mobil->merk }}</p>
        <p><strong>Tipe:</strong> {{ $mobil->tipe }}</p>
        <p><strong>Nomor Polisi:</strong> {{ $mobil->nopol }}</p>
        <p><strong>Harga Sewa per Hari:</strong> {{ $mobil->harga_sewa }}</p>
        <p><strong>Denda per Hari:</strong> {{ $mobil->denda_per_hari }}</p>
        <p><strong>Status:</strong> {{ $mobil->status }}</p>
        <p><strong>Jadwal Perawatan Berikutnya:</strong> {{ $mobil->jadwal_perawatan_berikutnya ? \Carbon\Carbon::parse($mobil->jadwal_perawatan_berikutnya)->format('d F Y') : '-' }}</p>
        <p><strong>Periode Perawatan:</strong> {{ $mobil->periode_perawatan_hari ? $mobil->periode_perawatan_hari . ' hari' : '-' }}</p>
        <a href="{{ route('admin.mobils.edit', $mobil->id) }}" class="btn btn-warning">Edit Mobil</a>
        <a href="{{ route('admin.mobils.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection