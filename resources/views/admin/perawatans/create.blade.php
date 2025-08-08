@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tambah Catatan Perawatan</div>
    <div class="card-body">
        <form action="{{ route('admin.perawatans.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="mobil_id" class="form-label">Pilih Mobil:</label>
                <select class="form-select" id="mobil_id" name="mobil_id" required>
                    <option value="">-- Pilih Mobil --</option>
                    @foreach($mobils as $mobil)
                        <option value="{{ $mobil->id }}" {{ request('mobil_id') == $mobil->id ? 'selected' : '' }}>{{ $mobil->merk }} {{ $mobil->tipe }} ({{ $mobil->nopol }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai:</label>
                <input type="text" class="form-control flatpickr" id="tanggal_mulai" name="tanggal_mulai" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Perawatan:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="biaya" class="form-label">Biaya Perawatan:</label>
                <input type="number" class="form-control" id="biaya" name="biaya" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.perawatans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/js/flatpickr.id.js') }}"></script>
<script>
    flatpickr(".flatpickr", {
        altInput: true,
        altFormat: "j F Y",
        dateFormat: "Y-m-d",
        locale: "id"
    });
</script>
@endpush
