@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="row mb-4 fade-in-up">
    <div class="col-12">
        <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
        <p class="mb-0 text-muted">Welcome to the rental car administration panel</p>
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
                    <h2 class="stat-number">{{ $totalMobil }}</h2>
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
                    <h2 class="stat-number">{{ $mobilPerawatan }}</h2>
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
                    <h2 class="stat-number">{{ $penyewaanAktif }}</h2>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Charts Row -->
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="chart-card fade-in-up">
            <h5 class="card-title mb-4">
                <i class="fas fa-chart-line me-2"></i>
                Revenue Overview
            </h5>
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
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings Table -->
<div class="table-card fade-in-up">
    <h5 class="card-title mb-4">
        <i class="fas fa-calendar-alt me-2"></i>
        Recent Bookings
    </h5>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Customer</th>
                    <th>Car</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#BK001</td>
                    <td>John Doe</td>
                    <td>Toyota Camry</td>
                    <td>2025-07-28</td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td>$350</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>#BK002</td>
                    <td>Jane Smith</td>
                    <td>Honda Civic</td>
                    <td>2025-07-27</td>
                    <td><span class="badge bg-warning">Pending</span></td>
                    <td>$280</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>#BK003</td>
                    <td>Mike Johnson</td>
                    <td>BMW X5</td>
                    <td>2025-07-26</td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td>$750</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>#BK004</td>
                    <td>Sarah Wilson</td>
                    <td>Audi A4</td>
                    <td>2025-07-25</td>
                    <td><span class="badge bg-danger">Cancelled</span></td>
                    <td>$420</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: @json($revenueLabels),
                datasets: [{
                    label: 'Revenue',
                    data: @json($revenueData),
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

        // Car Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'pie',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Status Mobil',
                    data: @json($data),
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)', // Example color for 'Tersedia'
                        'rgba(255, 159, 64, 0.8)', // Example color for 'Disewa'
                        'rgba(255, 99, 132, 0.8)', // Example color for 'Perawatan'
                        // Add more colors if there are more statuses
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
@endpush