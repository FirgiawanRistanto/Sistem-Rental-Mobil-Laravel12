<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">Manajemen Pelanggan</div>
    <div class="card-body">
        <a href="<?php echo e(route('admin.pelanggans.create')); ?>" class="btn btn-primary mb-3">Tambah Pelanggan</a>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <table class="table table-bordered" id="pelangganTable">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No. KTP/SIM</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
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
        var table = $('#pelangganTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?php echo e(route("admin.pelanggans.data")); ?>',
            columns: [
                { data: 'nama', name: 'nama' },
                { data: 'no_ktp', name: 'no_ktp' },
                { data: 'no_hp', name: 'no_hp' },
                { data: 'alamat', name: 'alamat' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                processing: 'Memuat data...'
            }
        });

        $('#pelangganTable').on('click', '.delete-form button[type="submit"]', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/pelanggans/index.blade.php ENDPATH**/ ?>