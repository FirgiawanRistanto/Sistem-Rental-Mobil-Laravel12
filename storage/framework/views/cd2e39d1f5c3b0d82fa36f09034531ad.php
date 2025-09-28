<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">Edit Penyewaan</div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.penyewaans.update', $penyewaan->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label for="mobil_id" class="form-label">Mobil</label>
                <select name="mobil_id" id="mobil_id" class="form-control">
                    <?php $__currentLoopData = $mobils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mobil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($mobil->id); ?>" data-harga="<?php echo e($mobil->harga_sewa); ?>" <?php echo e(old('mobil_id', $penyewaan->mobil_id) == $mobil->id ? 'selected' : ''); ?>>
                            <?php echo e($mobil->merk); ?> <?php echo e($mobil->tipe); ?> (<?php echo e($mobil->nopol); ?>)
                        </option>
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
                <label for="pelanggan_id" class="form-label">Pelanggan</label>
                <select name="pelanggan_id" id="pelanggan_id" class="form-control">
                    <?php $__currentLoopData = $pelanggans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pelanggan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($pelanggan->id); ?>" <?php echo e(old('pelanggan_id', $penyewaan->pelanggan_id) == $pelanggan->id ? 'selected' : ''); ?>>
                            <?php echo e($pelanggan->nama); ?> (<?php echo e($pelanggan->no_ktp); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
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
                <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                <input type="text" name="tanggal_sewa" id="tanggal_sewa" class="form-control flatpickr" value="<?php echo e(old('tanggal_sewa', $penyewaan->tanggal_sewa->format('Y-m-d H:i'))); ?>">
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
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                <input type="text" name="tanggal_kembali" id="tanggal_kembali" class="form-control flatpickr" value="<?php echo e(old('tanggal_kembali', $penyewaan->tanggal_kembali->format('Y-m-d H:i'))); ?>">
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
                <label for="total_biaya" class="form-label">Total Biaya</label>
                <input type="text" name="total_biaya" id="total_biaya" class="form-control" value="<?php echo e(old('total_biaya', $penyewaan->total_biaya)); ?>" readonly style="background-color: #e9ecef;">
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
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="Disewa" <?php echo e(old('status', $penyewaan->status) == 'Disewa' ? 'selected' : ''); ?>>Disewa</option>
                    <option value="Selesai" <?php echo e(old('status', $penyewaan->status) == 'Selesai' ? 'selected' : ''); ?>>Selesai</option>
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

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?php echo e(route('admin.penyewaans.index')); ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/penyewaans/edit.blade.php ENDPATH**/ ?>