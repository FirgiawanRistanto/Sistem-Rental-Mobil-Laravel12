@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Penyewaan</div>
    <div class="card-body">
        <form action="{{ route('admin.penyewaans.update', $penyewaan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="mobil_id" class="form-label">Mobil</label>
                <select name="mobil_id" id="mobil_id" class="form-control">
                    @foreach($mobils as $mobil)
                        <option value="{{ $mobil->id }}" {{ $penyewaan->mobil_id == $mobil->id ? 'selected' : '' }}>
                            {{ $mobil->merk }} {{ $mobil->tipe }} ({{ $mobil->nopol }})
                        </option>
                    @endforeach
                </select>
                @error('mobil_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="pelanggan_id" class="form-label">Pelanggan</label>
                <select name="pelanggan_id" id="pelanggan_id" class="form-control">
                    @foreach($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id }}" {{ $penyewaan->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>
                            {{ $pelanggan->nama }} ({{ $pelanggan->no_ktp }})
                        </option>
                    @endforeach
                </select>
                @error('pelanggan_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                <input type="text" name="tanggal_sewa" id="tanggal_sewa" class="form-control flatpickr" value="{{ $penyewaan->tanggal_sewa->format('Y-m-d') }}">
                @error('tanggal_sewa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                <input type="text" name="tanggal_kembali" id="tanggal_kembali" class="form-control flatpickr" value="{{ $penyewaan->tanggal_kembali->format('Y-m-d') }}">
                @error('tanggal_kembali')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="total_biaya" class="form-label">Total Biaya</label>
                <input type="number" name="total_biaya" id="total_biaya" class="form-control" value="{{ $penyewaan->total_biaya }}">
                @error('total_biaya')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr(".flatpickr", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d F Y",
            locale: "id",
            disableMobile: true,
        });
    });
</script>
@endpush
