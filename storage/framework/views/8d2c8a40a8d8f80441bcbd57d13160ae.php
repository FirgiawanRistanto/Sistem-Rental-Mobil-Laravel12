<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">Detail Penyewaan</div>
    <div class="card-body">
        <p><strong>Booking ID:</strong> BOOK-<?php echo e(str_pad($penyewaan->id, 5, '0', STR_PAD_LEFT)); ?></p>
        <p><strong>Mobil:</strong> <?php echo e($penyewaan->mobil->merk); ?> (<?php echo e($penyewaan->mobil->nopol); ?>)</p>
        <p><strong>Pelanggan:</strong> <?php echo e($penyewaan->pelanggan->nama); ?></p>
        <p><strong>Tanggal Sewa:</strong> <?php echo e($penyewaan->tanggal_sewa->translatedFormat('d F Y H:i')); ?></p>
        <p><strong>Tanggal Kembali:</strong> <?php echo e($penyewaan->tanggal_kembali->translatedFormat('d F Y H:i')); ?></p>
        <p><strong>Tanggal Kembali Aktual:</strong> <?php echo e($penyewaan->tanggal_kembali_aktual ? $penyewaan->tanggal_kembali_aktual->translatedFormat('d F Y H:i') : '-'); ?></p>
        <p><strong>Total Biaya:</strong> <?php echo e($penyewaan->total_biaya); ?></p>
        <p><strong>Denda:</strong> <?php echo e($penyewaan->denda); ?></p>
        <p><strong>Status:</strong> <?php echo e($penyewaan->status); ?></p>
        <a href="<?php echo e(route('admin.penyewaans.edit', $penyewaan->id)); ?>" class="btn btn-warning">Edit Penyewaan</a>
        <a href="<?php echo e(route('admin.penyewaans.index')); ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/penyewaans/show.blade.php ENDPATH**/ ?>