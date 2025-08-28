<?php $__env->startPush('styles'); ?>
<style>
    .detail-perawatan-card .card-body h5 {
        font-size: 1.1rem;
    }
    .detail-perawatan-card .card-body p {
        font-size: 0.9rem;
    }
    .detail-perawatan-card .card-header h3 {
        font-size: 1.25rem;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="card detail-perawatan-card">
    <div class="card-header">
        <h3>Detail Perawatan</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Informasi Mobil</h5>
                <p><strong>Merk/Tipe:</strong> <?php echo e($perawatan->mobil->merk); ?> <?php echo e($perawatan->mobil->tipe); ?></p>
                <p><strong>No. Polisi:</strong> <?php echo e($perawatan->mobil->nopol); ?></p>
            </div>
            <div class="col-md-6">
                <h5>Detail Perawatan</h5>
                <p><strong>Tanggal Mulai:</strong> <?php echo e(\Carbon\Carbon::parse($perawatan->tanggal_mulai)->translatedFormat('d F Y')); ?></p>
                <p><strong>Tanggal Selesai:</strong> <?php echo e($perawatan->tanggal_selesai ? \Carbon\Carbon::parse($perawatan->tanggal_selesai)->translatedFormat('d F Y') : '-'); ?></p>
                <p><strong>Biaya:</strong> Rp <?php echo e(number_format($perawatan->biaya, 0, ',', '.')); ?></p>
                <p><strong>Status:</strong> 
                    <?php if($perawatan->status == 'selesai'): ?>
                        <span class="badge bg-success">Selesai</span>
                    <?php else: ?>
                        <span class="badge bg-warning">Dalam Pengerjaan</span>
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <hr>
        <h5>Deskripsi Perawatan</h5>
        <p><?php echo e($perawatan->deskripsi); ?></p>
    </div>
    <div class="card-footer">
        <a href="<?php echo e(route('admin.perawatans.index')); ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/perawatans/show.blade.php ENDPATH**/ ?>