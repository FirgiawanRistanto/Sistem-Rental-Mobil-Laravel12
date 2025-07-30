<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Rental Car</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/css/flatpickr.min.css') }}">
</head>

<body>
    <!-- Navbar -->
    @include('layouts._partials.navbar')

    <!-- Sidebar -->
    @include('layouts._partials.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            @yield('content')

        </div>
    </div>

    <!-- Footer -->
    @include('layouts._partials.footer')    

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="{{ url('assets/js/flatpickr.min.js') }}"></script>
    <script src="{{ url('assets/js/flatpickr.id.js') }}"></script>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart');
        if (revenueCtx) {
            const revenueChart = new Chart(revenueCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Revenue ($)',
                        data: [30000, 35000, 42000, 38000, 45000, 52000, 48000],
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Status Chart
        const statusCtx = document.getElementById('statusChart');
        if (statusCtx) {
            const statusChart = new Chart(statusCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Available', 'Rented', 'Maintenance'],
                    datasets: [{
                        data: [89, 45, 22],
                        backgroundColor: ['#38ef7d', '#667eea', '#fc466b'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Add fade-in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });
    </script>
    @stack('scripts')
</body>

</html>