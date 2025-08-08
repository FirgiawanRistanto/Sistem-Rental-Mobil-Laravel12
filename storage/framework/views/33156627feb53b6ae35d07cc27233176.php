<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penyewaan</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Ensures consistent column widths */
            font-size: 10px; /* Slightly smaller font for more content */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 5px; /* Reduced padding */
            text-align: left;
            word-wrap: break-word; /* Allows long words to break */
        }
        th {
            background-color: #f2f2f2;
        }
        /* Column widths */
        th:nth-child(1) { width: 5%; } /* No */
        th:nth-child(2) { width: 15%; } /* Pelanggan */
        th:nth-child(3) { width: 15%; } /* Mobil */
        th:nth-child(4) { width: 15%; } /* Tanggal Sewa */
        th:nth-child(5) { width: 15%; } /* Tanggal Kembali */
        th:nth-child(6) { width: 12%; } /* Total Biaya */
        th:nth-child(7) { width: 12%; } /* Denda */
        th:nth-child(8) { width: 8%; } /* Status */
    </style>
</head>
<body>
    <h2>Laporan Penyewaan - <?php echo e(date('F', mktime(0, 0, 0, $month, 10))); ?> <?php echo e($year); ?></h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Mobil</th>
                <th>Tanggal Sewa</th>
                <th>Tanggal Kembali</th>
                <th>Total Biaya</th>
                <th>Denda</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $penyewaans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penyewaan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($penyewaan->pelanggan->nama); ?></td>
                    <td><?php echo e($penyewaan->mobil->merk); ?> <?php echo e($penyewaan->mobil->tipe); ?></td>
                    <td><?php echo e($penyewaan->tanggal_sewa->translatedFormat('d F Y')); ?></td>
                    <td><?php echo e($penyewaan->tanggal_kembali->translatedFormat('d F Y')); ?></td>
                    <td>Rp <?php echo e(number_format($penyewaan->total_biaya, 0, ',', '.')); ?></td>
                    <td>Rp <?php echo e(number_format($penyewaan->denda ?? 0, 0, ',', '.')); ?></td>
                    <td><?php echo e($penyewaan->status); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data untuk periode ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" style="text-align: right; font-weight: bold;">Total Pendapatan:</td>
                <td colspan="2" style="font-weight: bold;">Rp <?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: right; font-weight: bold;">Total Biaya Perawatan:</td>
                <td colspan="2" style="font-weight: bold;">Rp <?php echo e(number_format($totalBiayaPerawatan, 0, ',', '.')); ?></td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: right; font-weight: bold;">Pendapatan Bersih:</td>
                <td colspan="2" style="font-weight: bold;">Rp <?php echo e(number_format($pendapatanBersih, 0, ',', '.')); ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
<?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/reports/export.blade.php ENDPATH**/ ?>