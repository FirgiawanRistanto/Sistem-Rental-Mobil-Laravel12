    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h5 class="text-white mb-0">
                <i class="fas fa-tachometer-alt me-2"></i>
                Dashboard
            </h5>
        </div>
        <ul class="sidebar-menu">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>"><i class="fas fa-home"></i>Dashboard</a></li>
            <li><a href="<?php echo e(route('admin.mobils.index')); ?>" class="<?php echo e(request()->routeIs('admin.mobils.*') ? 'active' : ''); ?>"><i class="fas fa-car"></i>Manajemen Mobil</a></li>
            <li><a href="<?php echo e(route('admin.penyewaans.index')); ?>" class="<?php echo e(request()->routeIs('admin.penyewaans.*') ? 'active' : ''); ?>"><i class="fas fa-calendar-alt"></i>Penyewaan</a></li>
            <li><a href="<?php echo e(route('admin.pengembalian.index')); ?>" class="<?php echo e(request()->routeIs('admin.pengembalian.index') ? 'active' : ''); ?>"><i class="fas fa-undo"></i>Pengembalian</a></li>
            <li><a href="<?php echo e(route('admin.pelanggans.index')); ?>" class="<?php echo e(request()->routeIs('admin.pelanggans.*') ? 'active' : ''); ?>"><i class="fas fa-users"></i>Pelanggan</a></li>
            
            <li><a href="<?php echo e(route('admin.dashboard.report')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard.report') ? 'active' : ''); ?>"><i class="fas fa-chart-bar"></i>Laporan</a></li>
            <li><a href="<?php echo e(route('admin.perawatans.index')); ?>" class="<?php echo e(request()->routeIs('admin.perawatans.*') ? 'active' : ''); ?>"><i class="fas fa-tools"></i>Perawatan</a></li>
            
        </ul>
    </div><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/layouts/_partials/sidebar.blade.php ENDPATH**/ ?>