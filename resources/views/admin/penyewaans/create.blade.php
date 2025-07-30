@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tambah Penyewaan Baru</div>
    <div class="card-body">
        <form action="{{ route('admin.penyewaans.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="mobil_id" class="form-label">Mobil:</label>
                <select class="form-select" id="mobil_id" name="mobil_id" required>
                    @foreach($mobils as $mobil)
                        <option value="{{ $mobil->id }}" data-harga="{{ $mobil->harga_sewa }}">{{ $mobil->merk }} ({{ $mobil->nopol }})</option>
                    @endforeach
                </select>
                @error('mobil_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pelanggan:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="no_ktp" class="form-label">No. KTP/SIM:</label>
                <input type="text" class="form-control" id="no_ktp" name="no_ktp" required maxlength="16">
                @error('no_ktp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">Nomor HP:</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" required maxlength="13">
                @error('no_hp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                @error('alamat')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_sewa" class="form-label">Tanggal Sewa:</label>
                <input type="date" class="form-control" id="tanggal_sewa" name="tanggal_sewa" required>
                @error('tanggal_sewa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali:</label>
                <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required>
                @error('tanggal_kembali')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="total_biaya" class="form-label">Total Biaya:</label>
                <input type="text" class="form-control" id="total_biaya" name="total_biaya" required readonly style="background-color: #e9ecef;">
                @error('total_biaya')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select" id="status" name="status">
                    <option value="Disewa">Disewa</option>
                    <option value="Selesai">Selesai</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.penyewaans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobilSelect = document.getElementById('mobil_id');
        const tanggalSewaInput = document.getElementById('tanggal_sewa');
        const tanggalKembaliInput = document.getElementById('tanggal_kembali');
        const totalBiayaInput = document.getElementById('total_biaya');

        function calculateTotal() {
            const selectedMobil = mobilSelect.options[mobilSelect.selectedIndex];
            const hargaSewa = selectedMobil.getAttribute('data-harga');
            const tanggalSewa = new Date(tanggalSewaInput.value);
            const tanggalKembali = new Date(tanggalKembaliInput.value);

            if (hargaSewa && tanggalSewa && tanggalKembali && tanggalKembali >= tanggalSewa) {
                const diffTime = Math.abs(tanggalKembali - tanggalSewa);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                const totalBiaya = diffDays * hargaSewa;
                totalBiayaInput.value = totalBiaya;
            } else {
                totalBiayaInput.value = 0;
            }
        }

        mobilSelect.addEventListener('change', calculateTotal);
        tanggalSewaInput.addEventListener('change', calculateTotal);
        tanggalKembaliInput.addEventListener('change', calculateTotal);
    });
</script>
@endpush

@endsection