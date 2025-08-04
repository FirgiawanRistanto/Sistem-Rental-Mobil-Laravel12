@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Manajemen Penyewaan</div>
    <div class="card-body">
        <a href="{{ route('admin.penyewaans.create') }}" class="btn btn-primary mb-3">Tambah Penyewaan Baru</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Mobil</th>
                    <th>Pelanggan</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penyewaans as $penyewaan)
                <tr>
                    <td>BOOK-{{ str_pad($penyewaan->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $penyewaan->mobil->merk }} ({{ $penyewaan->mobil->nopol }})</td>
                    <td>{{ $penyewaan->pelanggan->nama }}</td>
                    <td>{{ $penyewaan->tanggal_sewa->translatedFormat('d F Y') }}</td>
                    <td>{{ $penyewaan->tanggal_kembali->translatedFormat('d F Y') }}</td>
                    <td>Rp {{ number_format($penyewaan->total_biaya, 0, ',', '.') }}</td>
                    <td>{{ $penyewaan->status }}</td>
                    <td>
                        <a href="{{ route('admin.penyewaans.show', $penyewaan->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('admin.penyewaans.edit', $penyewaan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection