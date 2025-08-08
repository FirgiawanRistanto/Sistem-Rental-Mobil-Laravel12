<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<div class="row mb-4 fade-in-up">
    <div class="col-12">
        <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
        <p class="mb-0 text-muted">Selamat datang di halaman dashboard admin</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="stat-card fade-in-up">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3">
                    <i class="fas fa-car"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Total Mobil</h6>
                    <h2 class="stat-number"><?php echo e($totalMobil); ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-4 mb-4">
        <div class="stat-card warning fade-in-up">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3">
                    <i class="fas fa-tools"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Mobil Dalam Perawatan</h6>
                    <h2 class="stat-number"><?php echo e($mobilPerawatan); ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="stat-card primary fade-in-up">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Penyewaan Aktif</h6>
                    <h2 class="stat-number"><?php echo e($penyewaanAktif); ?></h2>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Charts Row -->
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="chart-card fade-in-up">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-line me-2"></i>
                    Revenue Overview
                </h5>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="revenuePeriodDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        12 Bulan Terakhir
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="revenuePeriodDropdown">
                        <li><a class="dropdown-item" href="#" data-period="12_months">12 Bulan Terakhir</a></li>
                        <li><a class="dropdown-item" href="#" data-period="year_to_date">Tahun Ini</a></li>
                        <li><a class="dropdown-item" href="#" data-period="30_days">30 Hari Terakhir</a></li>
                        <li><a class="dropdown-item" href="#" data-period="last_month">Bulan Lalu</a></li>
                    </ul>
                </div>
            </div>
            <div class="chart-container-fixed-height">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5">
        <div class="chart-card fade-in-up">
            <h5 class="card-title mb-4">
                <i class="fas fa-chart-pie me-2"></i>
                Status Mobil
            </h5>
            <div class="chart-container-fixed-height">
                <canvas id="statusChart" data-labels='<?php echo json_encode($labels, 15, 512) ?>' data-data='<?php echo json_encode($data, 15, 512) ?>'></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings Table -->
<div class="table-card fade-in-up">
    <h5 class="card-title mb-4">
        <i class="fas fa-calendar-alt me-2"></i>
        Penyewaan Terbaru
    </h5>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID Sewa</th>
                    <th>Pelanggan</th>
                    <th>Mobil</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>BOOK-<?php echo e(str_pad($booking->id, 5, '0', STR_PAD_LEFT)); ?></td>
                        <td><?php echo e($booking->pelanggan->nama); ?></td>
                        <td><?php echo e($booking->mobil->merk); ?> <?php echo e($booking->mobil->tipe); ?></td>
                        <td><?php echo e($booking->tanggal_sewa); ?></td>
                        <td>
                            <span class="badge <?php echo e($booking->status == 'Disewa' ? 'bg-success' : 'bg-secondary'); ?>">
                                <?php echo e($booking->status); ?>

                            </span>
                        </td>
                        <td>Rp <?php echo e(number_format($booking->total_biaya, 0, ',', '.')); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.penyewaans.show', $booking->id)); ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                            <a href="<?php echo e(route('admin.penyewaans.edit', $booking->id)); ?>" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data penyewaan terbaru.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        let revenueChart;

        const updateRevenueChart = (period = '12_months') => {
            fetch(`<?php echo e(route('admin.dashboard.revenue_chart')); ?>?period=${period}`)
                .then(response => response.json())
                .then(data => {
                    if (revenueChart) {
                        revenueChart.destroy();
                    }
                    revenueChart = new Chart(revenueCtx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Revenue',
                                data: data.data,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                fill: true,
                                tension: 0.1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        };

        // Initial chart load
        updateRevenueChart();

        // Dropdown event listener
        document.querySelectorAll('#revenuePeriodDropdown + .dropdown-menu a').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const period = this.dataset.period;
                document.getElementById('revenuePeriodDropdown').textContent = this.textContent;
                updateRevenueChart(period);
            });
        });

        // Car Status Chart
        const statusCanvas = document.getElementById('statusChart');
        const statusLabels = JSON.parse(statusCanvas.dataset.labels);
        const statusData = JSON.parse(statusCanvas.dataset.data);

        new Chart(statusCanvas.getContext('2d'), {
            type: 'pie',
            data: {
                labels: statusLabels,
                datasets: [{
                    label: 'Status Mobil',
                    data: statusData,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)', // Tersedia
                        'rgba(255, 159, 64, 0.8)', // Disewa
                        'rgba(255, 99, 132, 0.8)',  // Perawatan
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>