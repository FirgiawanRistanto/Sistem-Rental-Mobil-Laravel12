<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">Manajemen Penyewaan</div>
    <div class="card-body">
        <a href="<?php echo e(route('admin.penyewaans.create')); ?>" class="btn btn-primary mb-3">Tambah Penyewaan Baru</a>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <table class="table table-bordered" id="penyewaanTable">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Mobil</th>
                    <th>Pelanggan</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#penyewaanTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?php echo e(route("admin.penyewaans.data")); ?>',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'mobil.merk', name: 'mobil.merk' },
                { data: 'pelanggan.nama', name: 'pelanggan.nama' },
                { data: 'tanggal_sewa', name: 'tanggal_sewa' },
                { data: 'tanggal_kembali', name: 'tanggal_kembali' },
                { data: 'total_biaya', name: 'total_biaya' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            order: [[ 3, 'desc' ]], // Default order by tanggal_sewa
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                processing: 'Memuat data...'
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/penyewaans/index.blade.php ENDPATH**/ ?>