@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Penyewaan</div>
    <div class="card-body">
        <form action="{{ route('admin.penyewaans.update', $penyewaan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="mobil_id" class="form-label">Mobil:</label>
                <select class="form-select" id="mobil_id" name="mobil_id" required>
                    @foreach($mobils as $mobil)
                        <option value="{{ $mobil->id }}" {{ $mobil->id == $penyewaan->mobil_id ? 'selected' : '' }}>{{ $mobil->merk }} ({{ $mobil->nopol }})</option>
                    @endforeach
                </select>
                @error('mobil_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pelanggan_id" class="form-label">Pelanggan:</label>
                <select class="form-select" id="pelanggan_id" name="pelanggan_id" required>
                    @foreach($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id }}" {{ $pelanggan->id == $penyewaan->pelanggan_id ? 'selected' : '' }}>{{ $pelanggan->nama }} ({{ $pelanggan->no_ktp }})</option>
                    @endforeach
                </select>
                @error('pelanggan_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_sewa" class="form-label">Tanggal Sewa:</label>
                <input type="date" class="form-control" id="tanggal_sewa" name="tanggal_sewa" value="{{ $penyewaan->tanggal_sewa }}" required>
                @error('tanggal_sewa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali:</label>
                <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value="{{ $penyewaan->tanggal_kembali }}" required>
                @error('tanggal_kembali')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_kembali_aktual" class="form-label">Tanggal Kembali Aktual:</label>
                <input type="date" class="form-control" id="tanggal_kembali_aktual" name="tanggal_kembali_aktual" value="{{ $penyewaan->tanggal_kembali_aktual }}">
                @error('tanggal_kembali_aktual')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="total_biaya" class="form-label">Total Biaya:</label>
                <input type="number" class="form-control" id="total_biaya" name="total_biaya" value="{{ $penyewaan->total_biaya }}" required>
                @error('total_biaya')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="denda" class="form-label">Denda:</label>
                <input type="number" class="form-control" id="denda" name="denda" value="{{ $penyewaan->denda }}" readonly>
                @error('denda')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select" id="status" name="status">
                    <option value="Disewa" {{ $penyewaan->status == 'Disewa' ? 'selected' : '' }}>Disewa</option>
                    <option value="Selesai" {{ $penyewaan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.penyewaans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection