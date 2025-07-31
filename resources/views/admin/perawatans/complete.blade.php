@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Selesaikan Perawatan</div>
    <div class="card-body">
        <form action="{{ route('admin.perawatans.complete', $perawatan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Mobil:</label>
                <p>{{ $perawatan->mobil->merk }} {{ $perawatan->mobil->tipe }} ({{ $perawatan->mobil->nopol }})</p>
            </div>
            <div class="mb-3">
                <label>Tanggal Mulai:</label>
                <p>{{ $perawatan->tanggal_mulai }}</p>
            </div>
            <div class="mb-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai:</label>
                <input type="text" class="form-control flatpickr" id="tanggal_selesai" name="tanggal_selesai" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi:</label>
                <p>{{ $perawatan->deskripsi }}</p>
            </div>
            <div class="mb-3">
                <label>Biaya:</label>
                <p>Rp {{ number_format($perawatan->biaya, 0, ',', '.') }}</p>
            </div>
            <button type="submit" class="btn btn-primary">Selesaikan Perawatan</button>
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
