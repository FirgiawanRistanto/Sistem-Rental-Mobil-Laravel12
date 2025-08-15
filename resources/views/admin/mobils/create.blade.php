@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tambah Mobil Baru</div>
    <div class="card-body">
        <form action="{{ route('admin.mobils.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="merk" class="form-label">Merk:</label>
                <input type="text" class="form-control" id="merk" name="merk" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())">
                @error('merk')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tipe" class="form-label">Tipe:</label>
                <input type="text" class="form-control" id="tipe" name="tipe" required oninput="this.value = this.value.replace(/\b\w/g, l => l.toUpperCase())">
                @error('tipe')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nopol" class="form-label">Nomor Polisi:</label>
                <input type="text" class="form-control" id="nopol" name="nopol" required oninput="this.value = this.value.toUpperCase()" maxlength="11">
                @error('nopol')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="harga_sewa" class="form-label">Harga Sewa per Hari:</label>
                <input type="text" class="form-control" id="harga_sewa" name="harga_sewa" value="0" required pattern="[0-9]*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                @error('harga_sewa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="denda_per_hari" class="form-label">Denda per Hari:</label>
                <input type="text" class="form-control" id="denda_per_hari" name="denda_per_hari" value="0" required pattern="[0-9]*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                @error('denda_per_hari')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select" id="status" name="status">
                    <option value="tersedia">Tersedia</option>
                    <option value="disewa">Disewa</option>
                    <option value="perawatan">Perawatan</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jadwal_perawatan_berikutnya" class="form-label">Jadwal Perawatan Berikutnya:</label>
                <input type="text" class="form-control flatpickr" id="jadwal_perawatan_berikutnya" name="jadwal_perawatan_berikutnya">
                @error('jadwal_perawatan_berikutnya')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="periode_perawatan_hari" class="form-label">Periode Perawatan (hari):</label>
                <input type="number" class="form-control" id="periode_perawatan_hari" name="periode_perawatan_hari" min="0">
                @error('periode_perawatan_hari')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exterior_images" class="form-label">Gambar Eksterior:</label>
                <input type="file" class="form-control" id="exterior_images" name="exterior_images[]" multiple>
                @error('exterior_images.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exterior_labels" class="form-label">Label Gambar Eksterior (pisahkan dengan koma):</label>
                <textarea class="form-control" id="exterior_labels" name="exterior_labels"></textarea>
            </div>

            <div class="mb-3">
                <label for="exterior_urutan" class="form-label">Urutan Gambar Eksterior (pisahkan dengan koma):</label>
                <textarea class="form-control" id="exterior_urutan" name="exterior_urutan"></textarea>
            </div>

            <div class="mb-3">
                <label for="interior_images" class="form-label">Gambar Interior:</label>
                <input type="file" class="form-control" id="interior_images" name="interior_images[]" multiple>
                @error('interior_images.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="interior_labels" class="form-label">Label Gambar Interior (pisahkan dengan koma):</label>
                <textarea class="form-control" id="interior_labels" name="interior_labels"></textarea>
            </div>

            <div class="mb-3">
                <label for="interior_urutan" class="form-label">Urutan Gambar Interior (pisahkan dengan koma):</label>
                <textarea class="form-control" id="interior_urutan" name="interior_urutan"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.mobils.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#jadwal_perawatan_berikutnya", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d F Y",
            locale: "id",
            disableMobile: true,
        });
    });
</script>
@endpush
