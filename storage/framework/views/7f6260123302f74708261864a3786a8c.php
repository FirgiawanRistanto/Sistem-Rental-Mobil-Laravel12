<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">Tambah Catatan Perawatan</div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.perawatans.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="mobil_id" class="form-label">Pilih Mobil:</label>
                <select class="form-select" id="mobil_id" name="mobil_id" required>
                    <option value="">-- Pilih Mobil --</option>
                    <?php $__currentLoopData = $mobils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mobil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($mobil->id); ?>" <?php echo e(request('mobil_id') == $mobil->id ? 'selected' : ''); ?>><?php echo e($mobil->merk); ?> <?php echo e($mobil->tipe); ?> (<?php echo e($mobil->nopol); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <a href="<?php echo e(route('admin.perawatans.index')); ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/flatpickr.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/flatpickr.id.js')); ?>"></script>
<script>
    flatpickr(".flatpickr", {
        altInput: true,
        altFormat: "j F Y",
        dateFormat: "Y-m-d",
        locale: "id"
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/perawatans/create.blade.php ENDPATH**/ ?>