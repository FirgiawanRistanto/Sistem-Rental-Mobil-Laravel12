@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Manajemen Pelanggan</div>
    <div class="card-body">
        <a href="{{ route('admin.pelanggans.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan Baru</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No. KTP/SIM</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelanggans as $pelanggan)
                <tr>
                    <td>{{ $pelanggan->nama }}</td>
                    <td>{{ $pelanggan->no_ktp }}</td>
                    <td>{{ $pelanggan->no_hp }}</td>
                    <td>{{ $pelanggan->alamat }}</td>
                    <td>
                        <a href="{{ route('admin.pelanggans.show', $pelanggan->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('admin.pelanggans.edit', $pelanggan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.pelanggans.destroy', $pelanggan->id) }}" method="POST" style="display:inline;">
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