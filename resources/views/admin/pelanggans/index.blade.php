@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Manajemen Pelanggan</div>
    <div class="card-body">
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
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection