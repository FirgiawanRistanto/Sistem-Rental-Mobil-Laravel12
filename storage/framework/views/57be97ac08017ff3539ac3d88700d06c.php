<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">Edit Mobil</div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.mobils.update', $mobil->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-3">
                <label for="merk" class="form-label">Merk:</label>
                <input type="text" class="form-control" id="merk" name="merk" value="<?php echo e($mobil->merk); ?>" required>
                <?php $__errorArgs = ['merk'];
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
                <label for="tipe" class="form-label">Tipe:</label>
                <input type="text" class="form-control" id="tipe" name="tipe" value="<?php echo e($mobil->tipe); ?>" required>
                <?php $__errorArgs = ['tipe'];
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
                <label for="nopol" class="form-label">Nomor Polisi:</label>
                <input type="text" class="form-control" id="nopol" name="nopol" value="<?php echo e($mobil->nopol); ?>" required>
                <?php $__errorArgs = ['nopol'];
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
                <label for="harga_sewa" class="form-label">Harga Sewa per Hari:</label>
                <input type="text" class="form-control" id="harga_sewa" name="harga_sewa" value="<?php echo e($mobil->harga_sewa); ?>" required pattern="[0-9]*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                <?php $__errorArgs = ['harga_sewa'];
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
                <label for="denda_per_hari" class="form-label">Denda per Hari:</label>
                <input type="text" class="form-control" id="denda_per_hari" name="denda_per_hari" value="<?php echo e($mobil->denda_per_hari); ?>" required pattern="[0-9]*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                <?php $__errorArgs = ['denda_per_hari'];
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
                    <option value="tersedia" <?php echo e($mobil->status == 'tersedia' ? 'selected' : ''); ?>>Tersedia</option>
                    <option value="disewa" <?php echo e($mobil->status == 'disewa' ? 'selected' : ''); ?>>Disewa</option>
                    <option value="perawatan" <?php echo e($mobil->status == 'perawatan' ? 'selected' : ''); ?>>Perawatan</option>
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
            <div class="mb-3">
                <label for="jadwal_perawatan_berikutnya" class="form-label">Jadwal Perawatan Berikutnya:</label>
                <input type="text" class="form-control flatpickr" id="jadwal_perawatan_berikutnya" name="jadwal_perawatan_berikutnya" value="<?php echo e(old('jadwal_perawatan_berikutnya', $mobil->jadwal_perawatan_berikutnya)); ?>">
                <?php $__errorArgs = ['jadwal_perawatan_berikutnya'];
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
                <label for="periode_perawatan_hari" class="form-label">Periode Perawatan (hari):</label>
                <input type="number" class="form-control" id="periode_perawatan_hari" name="periode_perawatan_hari" value="<?php echo e(old('periode_perawatan_hari', $mobil->periode_perawatan_hari)); ?>" min="0">
                <?php $__errorArgs = ['periode_perawatan_hari'];
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
            <a href="<?php echo e(route('admin.mobils.index')); ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/mobils/edit.blade.php ENDPATH**/ ?>