@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Manajemen Mobil</div>
    <div class="card-body">
        <a href="{{ route('admin.mobils.create') }}" class="btn btn-primary mb-3">Tambah Mobil Baru</a>
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Nopol</th>
                    <th>Harga Sewa</th>
                    <th>Disewa</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mobils as $mobil)
                <tr>
                    <td>{{ $mobil->merk }}</td>
                    <td>{{ $mobil->tipe }}</td>
                    <td>{{ $mobil->nopol }}</td>
                    <td>Rp {{ number_format($mobil->harga_sewa, 0, ',', '.') }}</td>
                    <td>{{ $mobil->disewa }} Kali</td>
                    <td>
                        @if($mobil->status == 'tersedia')
                        <span class="badge bg-success">Tersedia</span>
                        @elseif($mobil->status == 'disewa')
                        <span class="badge bg-primary">Disewa</span>
                        @elseif($mobil->status == 'perawatan')
                        <span class="badge bg-danger">Perawatan</span>
                        @else
                        <span class="badge bg-secondary">{{ ucfirst($mobil->status) }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.mobils.show', $mobil->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('admin.mobils.edit', $mobil->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.mobils.destroy', $mobil->id) }}" method="POST" style="display:inline;">
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