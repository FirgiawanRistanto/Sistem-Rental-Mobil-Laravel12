@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Detail Pelanggan</div>
    <div class="card-body">
        <p><strong>Nama:</strong> {{ $pelanggan->nama }}</p>
        <p><strong>No. KTP/SIM:</strong> {{ $pelanggan->no_ktp }}</p>
        <p><strong>No. HP:</strong> {{ $pelanggan->no_hp }}</p>
        <p><strong>Alamat:</strong> {{ $pelanggan->alamat }}</p>
        <a href="{{ route('admin.pelanggans.edit', $pelanggan->id) }}" class="btn btn-warning">Edit Pelanggan</a>
        <a href="{{ route('admin.pelanggans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection