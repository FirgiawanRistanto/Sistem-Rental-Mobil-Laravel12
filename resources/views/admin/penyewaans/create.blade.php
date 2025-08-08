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
                <label for="pelanggan_id" class="form-label">Pelanggan:</label>
                <div class="input-group">
                    <select class="form-select" id="pelanggan_id" name="pelanggan_id" required>
                        <option value="" disabled selected>Pilih Pelanggan</option>
                        @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }} ({{ $pelanggan->no_ktp }})</option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addPelangganModal">+</button>
                </div>
                @error('pelanggan_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_sewa" class="form-label">Tanggal Sewa:</label>
                <input type="text" class="form-control flatpickr" id="tanggal_sewa" name="tanggal_sewa" required>
                @error('tanggal_sewa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali:</label>
                <input type="text" class="form-control flatpickr" id="tanggal_kembali" name="tanggal_kembali" required>
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

<!-- Modal Tambah Pelanggan -->
<div class="modal fade" id="addPelangganModal" tabindex="-1" aria-labelledby="addPelangganModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPelangganModalLabel">Tambah Pelanggan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPelangganForm">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_modal" class="form-label">Nama Pelanggan:</label>
                        <input type="text" class="form-control" id="nama_modal" name="nama" required>
                        <div class="invalid-feedback" id="nama_modal_error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="no_ktp_modal" class="form-label">No. KTP/SIM:</label>
                        <input type="text" class="form-control" id="no_ktp_modal" name="no_ktp" required maxlength="16">
                        <div class="invalid-feedback" id="no_ktp_modal_error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp_modal" class="form-label">Nomor HP:</label>
                        <input type="text" class="form-control" id="no_hp_modal" name="no_hp" required maxlength="13">
                        <div class="invalid-feedback" id="no_hp_modal_error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_modal" class="form-label">Alamat:</label>
                        <textarea class="form-control" id="alamat_modal" name="alamat" rows="3" required></textarea>
                        <div class="invalid-feedback" id="alamat_modal_error"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="savePelangganBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tom-Select Initialization
        const pelangganSelect = new TomSelect("#pelanggan_id",{
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        flatpickr(".flatpickr", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            altInput: true,
            altFormat: "d F Y H:i",
            locale: "id",
            disableMobile: true,
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

        // Modal Pelanggan Logic
        const addPelangganModal = new bootstrap.Modal(document.getElementById('addPelangganModal'));
        const savePelangganBtn = document.getElementById('savePelangganBtn');
        const addPelangganForm = document.getElementById('addPelangganForm');

        savePelangganBtn.addEventListener('click', function() {
            const formData = new FormData(addPelangganForm);
            fetch('{{ route("admin.pelanggans.storeAjax") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                    // Clear previous errors
                    document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
                    document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid'));

                    // Display new errors
                    for (const key in data.errors) {
                        const errorElement = document.getElementById(key + '_modal_error');
                        const inputElement = document.getElementById(key + '_modal');
                        if (errorElement) {
                            errorElement.textContent = data.errors[key][0];
                            inputElement.classList.add('is-invalid');
                        }
                    }
                } else {
                    // Clear form and errors
                    addPelangganForm.reset();
                    document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
                    document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid'));

                    // Add new option to Tom-Select
                    pelangganSelect.addOption({
                        value: data.id,
                        text: `${data.nama} (${data.no_ktp})`
                    });
                    pelangganSelect.setValue(data.id);

                    // Close modal
                    addPelangganModal.hide();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
@endpush

@endsection