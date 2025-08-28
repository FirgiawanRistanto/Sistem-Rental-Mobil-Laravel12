@extends('layouts.app')

@push('styles')
<style>
    .perawatan-table th,
    .perawatan-table td {
        text-align: center;
        vertical-align: middle;
        font-size: 0.8rem; /* Adjusted font size */
    }
    .perawatan-table .aksi-kolom .btn {
        padding: 0.15rem 0.4rem;
        font-size: 0.75rem;
        border-radius: 0.2rem;
    }
</style>
@endpush

@section('content')
<div class="card">
    <div class="card-header">Manajemen Perawatan Mobil</div>
    <div class="card-body">
        <a href="{{ route('admin.perawatans.create') }}" class="btn btn-primary mb-3">Tambah Catatan Perawatan</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered perawatan-table">
                <thead>
                    <tr>
                        <th>Mobil</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Deskripsi</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($perawatans as $perawatan)
                    <tr>
                        <td>{{ $perawatan->mobil->merk }} {{ $perawatan->mobil->tipe }} ({{ $perawatan->mobil->nopol }})</td>
                        <td>{{ $perawatan->tanggal_mulai }}</td>
                        <td>{{ $perawatan->tanggal_selesai ?? '-' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($perawatan->deskripsi, 30, '...') }}</td>
                        <td>Rp {{ number_format($perawatan->biaya, 0, ',', '.') }}</td>
                        <td>
                            @if($perawatan->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-warning">Dalam Pengerjaan</span>
                            @endif
                        </td>
                        <td class="aksi-kolom">
                            <a href="{{ route('admin.perawatans.show', $perawatan->id) }}" class="btn btn-success btn-sm">Lihat</a>
                            <a href="{{ route('admin.perawatans.edit', $perawatan->id) }}" class="btn btn-info btn-sm">Edit</a>
                            @if($perawatan->status == 'dalam pengerjaan')
                                <a href="{{ route('admin.perawatans.completeForm', $perawatan->id) }}" class="btn btn-warning btn-sm">Selesaikan</a>
                            @endif
                            <form action="{{ route('admin.perawatans.destroy', $perawatan->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
