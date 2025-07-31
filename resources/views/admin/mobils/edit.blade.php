@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Mobil</div>
    <div class="card-body">
        <form action="{{ route('admin.mobils.update', $mobil->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="merk" class="form-label">Merk:</label>
                <input type="text" class="form-control" id="merk" name="merk" value="{{ $mobil->merk }}" required>
                @error('merk')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tipe" class="form-label">Tipe:</label>
                <input type="text" class="form-control" id="tipe" name="tipe" value="{{ $mobil->tipe }}" required>
                @error('tipe')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nopol" class="form-label">Nomor Polisi:</label>
                <input type="text" class="form-control" id="nopol" name="nopol" value="{{ $mobil->nopol }}" required>
                @error('nopol')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="harga_sewa" class="form-label">Harga Sewa per Hari:</label>
                <input type="number" class="form-control" id="harga_sewa" name="harga_sewa" value="{{ $mobil->harga_sewa }}" required>
                @error('harga_sewa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="denda_per_hari" class="form-label">Denda per Hari:</label>
                <input type="number" class="form-control" id="denda_per_hari" name="denda_per_hari" value="{{ $mobil->denda_per_hari }}" required>
                @error('denda_per_hari')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select" id="status" name="status">
                    <option value="tersedia" {{ $mobil->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="disewa" {{ $mobil->status == 'disewa' ? 'selected' : '' }}>Disewa</option>
                    <option value="perawatan" {{ $mobil->status == 'perawatan' ? 'selected' : '' }}>Perawatan</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.mobils.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection