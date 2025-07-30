    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h5 class="text-white mb-0">
                <i class="fas fa-tachometer-alt me-2"></i>
                Dashboard
            </h5>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i>Dashboard</a></li>
            <li><a href="{{ route('admin.mobils.index') }}" class="{{ request()->routeIs('admin.mobils.*') ? 'active' : '' }}"><i class="fas fa-car"></i>Manajemen Mobil</a></li>
            <li><a href="{{ route('admin.penyewaans.index') }}" class="{{ request()->routeIs('admin.penyewaans.*') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i>Penyewaan</a></li>
            <li><a href="{{ route('admin.pengembalian.index') }}" class="{{ request()->routeIs('admin.pengembalian.index') ? 'active' : '' }}"><i class="fas fa-undo"></i>Pengembalian</a></li>
            <li><a href="{{ route('admin.pelanggans.index') }}" class="{{ request()->routeIs('admin.pelanggans.*') ? 'active' : '' }}"><i class="fas fa-users"></i>Pelanggan</a></li>
            <li><a href="#"><i class="fas fa-credit-card"></i>Pembayaran</a></li>
            <li><a href="{{ route('admin.dashboard.report') }}" class="{{ request()->routeIs('admin.dashboard.report') ? 'active' : '' }}"><i class="fas fa-chart-bar"></i>Laporan</a></li>
            <li><a href="#"><i class="fas fa-tools"></i>Perawatan</a></li>
            <li><a href="#"><i class="fas fa-cog"></i>Pengaturan</a></li>
        </ul>
    </div>