    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-shopping-bag me-2"></i>ShopVibe</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav me-auto">
                    <a class="nav-link" href="#home">Home</a>
                    <a class="nav-link" href="#categories">Categories</a>
                    <a class="nav-link" href="#deals">Deals</a>
                    <a class="nav-link" href="#about">About</a>
                </div>
                
                <div class="search-container mx-3 flex-grow-1">
                    <input type="text" class="form-control search-input" placeholder="Cari produk impianmu..." id="searchInput" onkeyup="performSearch()">
                    <button class="search-btn" onclick="performSearch()">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
                <div class="navbar-nav">
                    <a class="nav-link position-relative" href="#wishlist">
                        <i class="fas fa-heart"></i>
                        <span class="badge badge-notification rounded-pill">3</span>
                    </a>
                    <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-notification rounded-pill">{{ count((array) session('cart')) }}</span>
                    </a>
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-user"></i> Login
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
