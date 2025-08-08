<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">Manajemen Mobil</div>
    <div class="card-body">
        <a href="<?php echo e(route('admin.mobils.create')); ?>" class="btn btn-primary mb-3">Tambah Mobil Baru</a>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Nopol</th>
                    <th>Harga Sewa</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $mobils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mobil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($mobil->merk); ?></td>
                    <td><?php echo e($mobil->tipe); ?></td>
                    <td><?php echo e($mobil->nopol); ?></td>
                    <td>Rp <?php echo e(number_format($mobil->harga_sewa, 0, ',', '.')); ?></td>
                    <td>
                        <?php if($mobil->status == 'tersedia'): ?>
                            <span class="badge bg-success">Tersedia</span>
                        <?php elseif($mobil->status == 'disewa'): ?>
                            <span class="badge bg-primary">Disewa</span>
                        <?php elseif($mobil->status == 'perawatan'): ?>
                            <span class="badge bg-danger">Perawatan</span>
                        <?php else: ?>
                            <span class="badge bg-secondary"><?php echo e(ucfirst($mobil->status)); ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.mobils.show', $mobil->id)); ?>" class="btn btn-info btn-sm">Lihat</a>
                        <a href="<?php echo e(route('admin.mobils.edit', $mobil->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('admin.mobils.destroy', $mobil->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/mobils/index.blade.php ENDPATH**/ ?>