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
                        <option value="{{ $mobil->id }}" data-harga="{{ $mobil->harga_sewa }}" {{ old('mobil_id', $penyewaan->mobil_id) == $mobil->id ? 'selected' : '' }}>
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
                        <option value="{{ $pelanggan->id }}" {{ old('pelanggan_id', $penyewaan->pelanggan_id) == $pelanggan->id ? 'selected' : '' }}>
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
                <input type="text" name="tanggal_sewa" id="tanggal_sewa" class="form-control flatpickr" value="{{ old('tanggal_sewa', $penyewaan->tanggal_sewa->format('Y-m-d H:i')) }}">
                @error('tanggal_sewa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                <input type="text" name="tanggal_kembali" id="tanggal_kembali" class="form-control flatpickr" value="{{ old('tanggal_kembali', $penyewaan->tanggal_kembali->format('Y-m-d H:i')) }}">
                @error('tanggal_kembali')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="total_biaya" class="form-label">Total Biaya</label>
                <input type="text" name="total_biaya" id="total_biaya" class="form-control" value="{{ old('total_biaya', $penyewaan->total_biaya) }}" readonly style="background-color: #e9ecef;">
                @error('total_biaya')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="Disewa" {{ old('status', $penyewaan->status) == 'Disewa' ? 'selected' : '' }}>Disewa</option>
                    <option value="Selesai" {{ old('status', $penyewaan->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
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
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            altInput: true,
            altFormat: "d F Y H:i",
            locale: "id",
            disableMobile: true,
        });

        // --- Custom validation for all required fields ---
        const requiredFields = document.querySelectorAll('[required]');
        requiredFields.forEach(function(field) {
            field.addEventListener('invalid', function(event) {
                if (event.target.validity.valueMissing) {
                    event.target.setCustomValidity('kolom ini tidak boleh kosong');
                }
            });

            field.addEventListener('input', function(event) {
                event.target.setCustomValidity('');
            });
        });

        const mobilSelect = document.getElementById('mobil_id');
        const tanggalSewaInput = document.getElementById('tanggal_sewa');
        const tanggalKembaliInput = document.getElementById('tanggal_kembali');
        const totalBiayaInput = document.getElementById('total_biaya');

        function calculateTotal() {
            const selectedMobil = mobilSelect.options[mobilSelect.selectedIndex];
            const hargaSewa = selectedMobil.getAttribute('data-harga');
            const tanggalSewa = new Date(tanggalSewaInput.value);
            const tanggalKembali = new Date(tanggalKembaliInput.value);

            if (hargaSewa && tanggalSewaInput.value && tanggalKembaliInput.value && tanggalKembali >= tanggalSewa) {
                const diffTime = Math.abs(tanggalKembali - tanggalSewa);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                // If rental is less than a full day, it still counts as 1 day.
                const rentalDays = diffDays === 0 ? 1 : diffDays;
                const totalBiaya = rentalDays * hargaSewa;
                totalBiayaInput.value = totalBiaya;
            } else {
                totalBiayaInput.value = 0;
            }
        }

        mobilSelect.addEventListener('change', calculateTotal);
        tanggalSewaInput.addEventListener('change', calculateTotal);
        tanggalKembaliInput.addEventListener('change', calculateTotal);

        // Initial calculation on page load
        calculateTotal();
    });
</script>
@endpush
