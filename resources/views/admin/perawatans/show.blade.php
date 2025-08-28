@extends('layouts.app')

@push('styles')
<style>
    .detail-perawatan-card .card-body h5 {
        font-size: 1.1rem;
    }
    .detail-perawatan-card .card-body p {
        font-size: 0.9rem;
    }
    .detail-perawatan-card .card-header h3 {
        font-size: 1.25rem;
    }
</style>
@endpush

@section('content')
<div class="card detail-perawatan-card">
    <div class="card-header">
        <h3>Detail Perawatan</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Informasi Mobil</h5>
                <p><strong>Merk/Tipe:</strong> {{ $perawatan->mobil->merk }} {{ $perawatan->mobil->tipe }}</p>
                <p><strong>No. Polisi:</strong> {{ $perawatan->mobil->nopol }}</p>
            </div>
            <div class="col-md-6">
                <h5>Detail Perawatan</h5>
                <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($perawatan->tanggal_mulai)->translatedFormat('d F Y') }}</p>
                <p><strong>Tanggal Selesai:</strong> {{ $perawatan->tanggal_selesai ? \Carbon\Carbon::parse($perawatan->tanggal_selesai)->translatedFormat('d F Y') : '-' }}</p>
                <p><strong>Biaya:</strong> Rp {{ number_format($perawatan->biaya, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> 
                    @if($perawatan->status == 'selesai')
                        <span class="badge bg-success">Selesai</span>
                    @else
                        <span class="badge bg-warning">Dalam Pengerjaan</span>
                    @endif
                </p>
            </div>
        </div>
        <hr>
        <h5>Deskripsi Perawatan</h5>
        <p>{{ $perawatan->deskripsi }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.perawatans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
