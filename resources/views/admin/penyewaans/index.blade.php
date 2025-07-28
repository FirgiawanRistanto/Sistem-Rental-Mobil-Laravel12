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
                    <td>{{ $penyewaan->mobil->merk }} ({{ $penyewaan->mobil->nopol }})</td>
                    <td>{{ $penyewaan->pelanggan->nama }}</td>
                    <td>{{ $penyewaan->tanggal_sewa }}</td>
                    <td>{{ $penyewaan->tanggal_kembali }}</td>
                    <td>{{ $penyewaan->total_biaya }}</td>
                    <td>{{ $penyewaan->status }}</td>
                    <td>
                        <a href="{{ route('admin.penyewaans.show', $penyewaan->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('admin.penyewaans.edit', $penyewaan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.penyewaans.destroy', $penyewaan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection