<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">Tambah Penyewaan Baru</div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.penyewaans.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="mobil_id" class="form-label">Mobil:</label>
                <select class="form-select" id="mobil_id" name="mobil_id" required>
                    <?php $__currentLoopData = $mobils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mobil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($mobil->id); ?>" data-harga="<?php echo e($mobil->harga_sewa); ?>"><?php echo e($mobil->merk); ?> (<?php echo e($mobil->nopol); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['mobil_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-3">
                <label for="pelanggan_id" class="form-label">Pelanggan:</label>
                <div class="input-group">
                    <select class="form-select" id="pelanggan_id" name="pelanggan_id" required>
                        <option value="" disabled selected>Pilih Pelanggan</option>
                        <?php $__currentLoopData = $pelanggans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pelanggan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($pelanggan->id); ?>"><?php echo e($pelanggan->nama); ?> (<?php echo e($pelanggan->no_ktp); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addPelangganModal">+</button>
                </div>
                <?php $__errorArgs = ['pelanggan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-3">
                <label for="tanggal_sewa" class="form-label">Tanggal Sewa:</label>
                <input type="text" class="form-control flatpickr" id="tanggal_sewa" name="tanggal_sewa" required>
                <?php $__errorArgs = ['tanggal_sewa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali:</label>
                <input type="text" class="form-control flatpickr" id="tanggal_kembali" name="tanggal_kembali" required>
                <?php $__errorArgs = ['tanggal_kembali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-3">
                <label for="total_biaya" class="form-label">Total Biaya:</label>
                <input type="text" class="form-control" id="total_biaya" name="total_biaya" required readonly style="background-color: #e9ecef;">
                <?php $__errorArgs = ['total_biaya'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select" id="status" name="status">
                    <option value="Disewa">Disewa</option>
                    <option value="Selesai">Selesai</option>
                </select>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?php echo e(route('admin.penyewaans.index')); ?>" class="btn btn-secondary">Kembali</a>
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
                    <?php echo csrf_field(); ?>
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

<?php $__env->startPush('scripts'); ?>
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
            fetch('<?php echo e(route("admin.pelanggans.storeAjax")); ?>', {
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
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/penyewaans/create.blade.php ENDPATH**/ ?>