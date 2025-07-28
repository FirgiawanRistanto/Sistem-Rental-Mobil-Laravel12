    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="btn sidebar-toggle me-3" type="button" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-car me-2"></i>
                Admin Rental Mobil
            </a>
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn dropdown-toggle me-3" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-bell me-1"></i>
                        <span class="badge bg-danger"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-info-circle me-2"></i>Pemesanan baru diterima</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-exclamation-triangle me-2"></i>Pembayaran tertunda</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-car me-2"></i>Jadwal perawatan mobil</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>
                        {{ Auth::user()->name ?? 'Admin' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>