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
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card fade-in-up">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3">
                    <i class="fas fa-car"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Total Cars</h6>
                    <h2 class="stat-number">156</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card success fade-in-up">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Active Bookings</h6>
                    <h2 class="stat-number">89</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card warning fade-in-up">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Monthly Revenue</h6>
                    <h2 class="stat-number">$45K</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card danger fade-in-up">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Total Customers</h6>
                    <h2 class="stat-number">1,234</h2>
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
                Car Status
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
    document.addEventListener('DOMContentLoaded', function () {
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Revenue',
                    data: [12000, 19000, 3000, 5000, 2000, 30000, 45000],
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
                labels: ['Available', 'Rented', 'Maintenance'],
                datasets: [{
                    label: 'Car Status',
                    data: [100, 40, 16],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(255, 99, 132, 0.8)'
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