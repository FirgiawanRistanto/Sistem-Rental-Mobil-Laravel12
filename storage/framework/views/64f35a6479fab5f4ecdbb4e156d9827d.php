<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">Detail Pelanggan</div>
    <div class="card-body">
        <p><strong>Nama:</strong> <?php echo e($pelanggan->nama); ?></p>
        <p><strong>No. KTP/SIM:</strong> <?php echo e($pelanggan->no_ktp); ?></p>
        <p><strong>No. HP:</strong> <?php echo e($pelanggan->no_hp); ?></p>
        <p><strong>Alamat:</strong> <?php echo e($pelanggan->alamat); ?></p>
        <a href="<?php echo e(route('admin.pelanggans.edit', $pelanggan->id)); ?>" class="btn btn-warning">Edit Pelanggan</a>
        <a href="<?php echo e(route('admin.pelanggans.index')); ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">Riwayat Penyewaan Mobil</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Mobil</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $pelanggan->penyewaans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penyewaan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($penyewaan->mobil->merk); ?> <?php echo e($penyewaan->mobil->tipe); ?></td>
                        <td><?php echo e($penyewaan->tanggal_sewa->format('d-m-Y')); ?></td>
                        <td><?php echo e($penyewaan->tanggal_kembali->format('d-m-Y')); ?></td>
                        <td>Rp <?php echo e(number_format($penyewaan->total_biaya, 0, ',', '.')); ?></td>
                        <td><?php echo e($penyewaan->status); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada riwayat penyewaan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/pelanggans/show.blade.php ENDPATH**/ ?>