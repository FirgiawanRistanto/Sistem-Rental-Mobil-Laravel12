<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">Selesaikan Perawatan</div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.perawatans.complete', $perawatan->id)); ?>" method="POST" id="complete-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-3">
                <label>Mobil:</label>
                <p><?php echo e($perawatan->mobil->merk); ?> <?php echo e($perawatan->mobil->tipe); ?> (<?php echo e($perawatan->mobil->nopol); ?>)</p>
            </div>
            <div class="mb-3">
                <label>Tanggal Mulai:</label>
                <p><?php echo e($perawatan->tanggal_mulai); ?></p>
            </div>
            <div class="mb-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai:</label>
                <input type="text" class="form-control flatpickr" id="tanggal_selesai" name="tanggal_selesai" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi:</label>
                <p><?php echo e($perawatan->deskripsi); ?></p>
            </div>
            <div class="mb-3">
                <label>Biaya:</label>
                <p>Rp <?php echo e(number_format($perawatan->biaya, 0, ',', '.')); ?></p>
            </div>
            <button type="button" id="submit-button" class="btn btn-primary">Selesaikan Perawatan</button>
            <a href="<?php echo e(route('admin.perawatans.index')); ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/flatpickr.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/flatpickr.id.js')); ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('complete-form');
        const submitButton = document.getElementById('submit-button');
        const tanggalSelesaiInput = document.getElementById('tanggal_selesai');

        flatpickr(".flatpickr", {
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
            locale: "id"
        });

        submitButton.addEventListener('click', function(event) {
            if (!tanggalSelesaiInput.value) {
                // We don't need preventDefault() because the button is type="button"
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tanggal selesai tidak boleh kosong!',
                });
            } else {
                form.submit();
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/perawatans/complete.blade.php ENDPATH**/ ?>