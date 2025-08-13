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

<div class="card mt-4">
    <div class="card-header">Galeri Gambar</div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="imageTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="exterior-tab" data-bs-toggle="tab" data-bs-target="#exterior" type="button" role="tab" aria-controls="exterior" aria-selected="true">Eksterior</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="interior-tab" data-bs-toggle="tab" data-bs-target="#interior" type="button" role="tab" aria-controls="interior" aria-selected="false">Interior</button>
            </li>
        </ul>
        <div class="tab-content" id="imageTabsContent">
            <div class="tab-pane fade show active" id="exterior" role="tabpanel" aria-labelledby="exterior-tab">
                <div class="row mt-3">
                    <?php if(isset($gambars['exterior'])): ?>
                        <?php $__currentLoopData = $gambars['exterior']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gambar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="<?php echo e(asset('storage/' . $gambar->path)); ?>" class="card-img-top" alt="<?php echo e($gambar->label); ?>">
                                    <div class="card-body">
                                        <p class="card-text"><?php echo e($gambar->label); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p>Tidak ada gambar eksterior.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="tab-pane fade" id="interior" role="tabpanel" aria-labelledby="interior-tab">
                <div class="row mt-3">
                    <?php if(isset($gambars['interior'])): ?>
                        <?php $__currentLoopData = $gambars['interior']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gambar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="<?php echo e(asset('storage/' . $gambar->path)); ?>" class="card-img-top" alt="<?php echo e($gambar->label); ?>">
                                    <div class="card-body">
                                        <p class="card-text"><?php echo e($gambar->label); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p>Tidak ada gambar interior.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/mobils/show.blade.php ENDPATH**/ ?>