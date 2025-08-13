@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Mobil</div>
    <div class="card-body">
        <form action="{{ route('admin.mobils.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
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
                <input type="text" class="form-control" id="harga_sewa" name="harga_sewa" value="{{ $mobil->harga_sewa }}" required pattern="[0-9]*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                @error('harga_sewa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="denda_per_hari" class="form-label">Denda per Hari:</label>
                <input type="text" class="form-control" id="denda_per_hari" name="denda_per_hari" value="{{ $mobil->denda_per_hari }}" required pattern="[0-9]*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
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
            <div class="mb-3">
                <label for="jadwal_perawatan_berikutnya" class="form-label">Jadwal Perawatan Berikutnya:</label>
                <input type="text" class="form-control flatpickr" id="jadwal_perawatan_berikutnya" name="jadwal_perawatan_berikutnya" value="{{ old('jadwal_perawatan_berikutnya', $mobil->jadwal_perawatan_berikutnya) }}">
                @error('jadwal_perawatan_berikutnya')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="periode_perawatan_hari" class="form-label">Periode Perawatan (hari):</label>
                <input type="number" class="form-control" id="periode_perawatan_hari" name="periode_perawatan_hari" value="{{ old('periode_perawatan_hari', $mobil->periode_perawatan_hari) }}" min="0">
                @error('periode_perawatan_hari')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="card mt-4">
                <div class="card-header">Galeri Gambar</div>
                <div class="card-body">
                    <h5>Gambar Tersimpan</h5>
                    <div class="row">
                        @foreach($mobil->gambars as $gambar)
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $gambar->path) }}" class="card-img-top">
                                    <div class="card-body">
                                        <p class="card-text">{{ $gambar->label }} ({{ $gambar->tipe }})</p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="deleted_images[]" value="{{ $gambar->id }}">
                                            <label class="form-check-label">Hapus</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <h5>Upload Gambar Baru</h5>
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
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.mobils.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
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
