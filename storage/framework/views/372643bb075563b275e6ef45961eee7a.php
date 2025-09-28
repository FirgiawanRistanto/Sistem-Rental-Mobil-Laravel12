<?php $__env->startPush('styles'); ?>
<style>
    .card .table th,
    .card .table td {
        font-size: 0.8rem !important; /* Perkecil ukuran font */
        vertical-align: middle; /* Pusatkan teks secara vertikal */
        text-align: center; /* Pusatkan teks secara horizontal */
    }

    .card .table .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
    }

    .flatpickr-input[readonly] {
        background-color: #fff; /* Pastikan input tidak terlihat disabled */
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">Daftar Pengembalian Mobil</div>
    <div class="card-body">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mobil</th>
                    <th>Pelanggan</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Tanggal Kembali Aktual</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $penyewaans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penyewaan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr data-tanggal-kembali-seharusnya="<?php echo e($penyewaan->tanggal_kembali); ?>" data-denda-per-hari="<?php echo e($penyewaan->mobil->denda_per_hari); ?>">
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($penyewaan->mobil->merk); ?> (<?php echo e($penyewaan->mobil->nopol); ?>)</td>
                        <td><?php echo e($penyewaan->pelanggan->nama); ?></td>
                        <td><?php echo e($penyewaan->tanggal_sewa->translatedFormat('d F Y')); ?></td>
                        <td><?php echo e($penyewaan->tanggal_kembali->translatedFormat('d F Y')); ?></td>
                        <td>
                            <div class="input-group flatpickr" data-wrap="true">
                                <input type="text" class="form-control" placeholder="Pilih tanggal..." readonly="readonly" data-input>
                                <span class="input-group-text" data-toggle><i class="fa fa-calendar"></i></span>
                            </div>
                        </td>
                        <td><span id="denda-<?php echo e($penyewaan->id); ?>">Rp. <?php echo e(number_format($penyewaan->denda ?? 0, 0, ',', '.')); ?></span></td>
                        <td>
                            <form action="<?php echo e(route('admin.pengembalian.store', $penyewaan)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="tanggal_kembali_aktual" class="tanggal-kembali-aktual" data-penyewaan-id="<?php echo e($penyewaan->id); ?>" required>
                                <input type="hidden" name="denda" class="denda-hidden" value="<?php echo e($penyewaan->denda ?? 0); ?>">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada mobil yang sedang disewa.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log("Flatpickr script is running!"); // Added for debugging
        // Initialize Flatpickr on all elements with the class 'flatpickr'
        flatpickr(".flatpickr", {
            wrap: true, // This is crucial for the input group setup
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            altInput: true,
            altFormat: "d F Y H:i",
            locale: "id",
            disableMobile: true,
            onChange: function(selectedDates, dateStr, instance) {
                console.log("Flatpickr onChange triggered. Selected dateStr:", dateStr);
                // Find the hidden input within the same row and update its value
                const row = instance.element.closest('tr');
                const hiddenInput = row.querySelector('.tanggal-kembali-aktual');
                hiddenInput.value = dateStr;
                console.log("Hidden input value set to:", hiddenInput.value);

                // Manually trigger the change event on the hidden input to run the fine calculation logic
                const event = new Event('change', { bubbles: true });
                hiddenInput.dispatchEvent(event);
                console.log("Change event dispatched on hidden input.");
            }
        });

        // Handle date change on the hidden date input for fine calculation
        document.querySelectorAll('.tanggal-kembali-aktual').forEach(hiddenInput => {
            hiddenInput.addEventListener('change', function() {
                console.log("Hidden input change event triggered. Current value:", this.value);
                const row = this.closest('tr');
                const tanggalKembaliSeharusnya = new Date(row.dataset.tanggalKembaliSeharusnya);
                tanggalKembaliSeharusnya.setHours(0, 0, 0, 0); // Normalize to start of the day
                console.log("Tanggal Kembali Seharusnya (normalized):", tanggalKembaliSeharusnya);

                const tanggalKembaliAktual = new Date(this.value);
                tanggalKembaliAktual.setHours(0, 0, 0, 0); // Normalize to start of the day
                console.log("Tanggal Kembali Aktual (normalized):", tanggalKembaliAktual);

                const dendaPerHari = parseInt(row.dataset.dendaPerHari);
                const dendaSpan = row.querySelector('span[id^="denda-"]');
                const dendaHiddenInput = row.querySelector('.denda-hidden');

                // Calculate fine
                if (this.value && tanggalKembaliAktual > tanggalKembaliSeharusnya) {
                    const diffTime = Math.abs(tanggalKembaliAktual - tanggalKembaliSeharusnya);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    console.log("Diff Days:", diffDays);
                    const totalDenda = diffDays * dendaPerHari;
                    console.log("Total Denda:", totalDenda);
                    dendaSpan.textContent = "Rp " + totalDenda.toLocaleString('id-ID');
                    dendaHiddenInput.value = totalDenda; // Update hidden input
                } else {
                    console.log("No fine (on time or early).");
                    dendaSpan.textContent = "Rp 0";
                    dendaHiddenInput.value = 0; // Update hidden input
                }
            });
        });

        // Add validation for the form submission
        const forms = document.querySelectorAll('form[action*="pengembalian"]');
        forms.forEach(form => {
            form.addEventListener('submit', function(event) {
                const hiddenInput = form.querySelector('.tanggal-kembali-aktual');
                if (!hiddenInput.value) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Tanggal kembali aktual tidak boleh kosong!',
                    });
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/pengembalian/index.blade.php ENDPATH**/ ?>