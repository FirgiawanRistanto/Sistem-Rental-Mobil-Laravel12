@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Detail Penyewaan</div>
    <div class="card-body">
        <p><strong>Mobil:</strong> {{ $penyewaan->mobil->merk }} ({{ $penyewaan->mobil->nopol }})</p>
        <p><strong>Pelanggan:</strong> {{ $penyewaan->pelanggan->nama }}</p>
        <p><strong>Tanggal Sewa:</strong> {{ $penyewaan->tanggal_sewa->translatedFormat('d F Y') }}</p>
        <p><strong>Tanggal Kembali:</strong> {{ $penyewaan->tanggal_kembali->translatedFormat('d F Y') }}</p>
        <p><strong>Tanggal Kembali Aktual:</strong> {{ $penyewaan->tanggal_kembali_aktual ? $penyewaan->tanggal_kembali_aktual->translatedFormat('d F Y') : '-' }}</p>
        <p><strong>Total Biaya:</strong> {{ $penyewaan->total_biaya }}</p>
        <p><strong>Denda:</strong> {{ $penyewaan->denda }}</p>
        <p><strong>Status:</strong> {{ $penyewaan->status }}</p>
        <a href="{{ route('admin.penyewaans.edit', $penyewaan->id) }}" class="btn btn-warning">Edit Penyewaan</a>
        <a href="{{ route('admin.penyewaans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection