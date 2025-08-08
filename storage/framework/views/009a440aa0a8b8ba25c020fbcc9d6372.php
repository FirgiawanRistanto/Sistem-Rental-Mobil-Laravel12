<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">Detail Mobil</div>
    <div class="card-body">
        <p><strong>Merk:</strong> <?php echo e($mobil->merk); ?></p>
        <p><strong>Tipe:</strong> <?php echo e($mobil->tipe); ?></p>
        <p><strong>Nomor Polisi:</strong> <?php echo e($mobil->nopol); ?></p>
        <p><strong>Harga Sewa per Hari:</strong> <?php echo e($mobil->harga_sewa); ?></p>
        <p><strong>Denda per Hari:</strong> <?php echo e($mobil->denda_per_hari); ?></p>
        <p><strong>Status:</strong> <?php echo e($mobil->status); ?></p>
        <p><strong>Jadwal Perawatan Berikutnya:</strong> <?php echo e($mobil->jadwal_perawatan_berikutnya ? \Carbon\Carbon::parse($mobil->jadwal_perawatan_berikutnya)->format('d F Y') : '-'); ?></p>
        <p><strong>Periode Perawatan:</strong> <?php echo e($mobil->periode_perawatan_hari ? $mobil->periode_perawatan_hari . ' hari' : '-'); ?></p>
        <a href="<?php echo e(route('admin.mobils.edit', $mobil->id)); ?>" class="btn btn-warning">Edit Mobil</a>
        <a href="<?php echo e(route('admin.mobils.index')); ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/mobils/show.blade.php ENDPATH**/ ?>