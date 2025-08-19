<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">Manajemen Perawatan Mobil</div>
    <div class="card-body">
        <a href="<?php echo e(route('admin.perawatans.create')); ?>" class="btn btn-primary mb-3">Tambah Catatan Perawatan</a>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mobil</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Deskripsi</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $perawatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perawatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($perawatan->mobil->merk); ?> <?php echo e($perawatan->mobil->tipe); ?> (<?php echo e($perawatan->mobil->nopol); ?>)</td>
                        <td><?php echo e($perawatan->tanggal_mulai); ?></td>
                        <td><?php echo e($perawatan->tanggal_selesai ?? '-'); ?></td>
                        <td><?php echo e($perawatan->deskripsi); ?></td>
                        <td>Rp <?php echo e(number_format($perawatan->biaya, 0, ',', '.')); ?></td>
                        <td>
                            <?php if($perawatan->status == 'selesai'): ?>
                                <span class="badge bg-success">Selesai</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Dalam Pengerjaan</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.perawatans.edit', $perawatan->id)); ?>" class="btn btn-info btn-sm">Edit</a>
                            <?php if($perawatan->status == 'dalam pengerjaan'): ?>
                                <a href="<?php echo e(route('admin.perawatans.completeForm', $perawatan->id)); ?>" class="btn btn-warning btn-sm">Selesaikan</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/perawatans/index.blade.php ENDPATH**/ ?>