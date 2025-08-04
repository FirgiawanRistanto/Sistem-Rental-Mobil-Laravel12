@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Data Pelanggan</div>
    <div class="card-body">
        <form action="{{ route('admin.pelanggans.update', $pelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $pelanggan->nama }}" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="no_ktp" class="form-label">No. KTP/SIM:</label>
                <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{ $pelanggan->no_ktp }}" required maxlength="16" pattern="[0-9]*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                @error('no_ktp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">Nomor HP:</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $pelanggan->no_hp }}" required maxlength="13" pattern="[0-9]*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                @error('no_hp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $pelanggan->alamat }}</textarea>
                @error('alamat')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.pelanggans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
