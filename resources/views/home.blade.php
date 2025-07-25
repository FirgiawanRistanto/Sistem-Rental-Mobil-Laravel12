@extends('layouts.store')

@section('content')
    <!-- Carousel -->
    <div class="container-fluid" style="margin-top: 100px;">
        <div class="container">
            <div id="heroCarousel" class="carousel slide carousel-custom" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1200&h=400&fit=crop" class="d-block w-100" alt="Shopping">
                        <div class="carousel-overlay">
                            <div class="carousel-content">
                                <h2>Summer Sale 50% OFF!</h2>
                                <p>Dapatkan diskon fantastis untuk koleksi musim panas terbaik</p>
                                <button class="btn btn-shop-now" onclick="scrollToProducts()">Shop Now <i class="fas fa-arrow-right ms-2"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=1200&h=400&fit=crop" class="d-block w-100" alt="Fashion">
                        <div class="carousel-overlay">
                            <div class="carousel-content">
                                <h2>New Fashion Collection</h2>
                                <p>Trend terbaru fashion 2025 sudah tiba! Jadilah yang pertama</p>
                                <button class="btn btn-shop-now">Explore Collection <i class="fas fa-sparkles ms-2"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1200&h=400&fit=crop" class="d-block w-100" alt="Electronics">
                        <div class="carousel-overlay">
                            <div class="carousel-content">
                                <h2>Tech Revolution</h2>
                                <p>Gadget terbaru dengan teknologi canggih menanti Anda</p>
                                <button class="btn btn-shop-now">Discover Tech <i class="fas fa-rocket ms-2"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </div>
    

    <!-- Categories Section -->
    <div class="category-section" id="categories" style="padding-left: 15px; padding-right: 15px;">
        <h2 class="section-title">Shop by Category</h2>
        <div class="row justify-content-center">
            @foreach($categories as $category)
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('products.byCategory', $category) }}" class="category-card-link">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-tshirt"></i> {{-- Placeholder icon, consider dynamic icons later --}}
                        </div>
                        <h5>{{ $category->name }}</h5>
                        <p>Explore Now</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Main Content -->
    <div class="container" id="products">
        <div class="row">
            <!-- Filter Sidebar -->
            <div class="col-lg-3">
                <div class="filter-sidebar">
                    <h5 class="filter-title"><i class="fas fa-filter me-2"></i>Filter Produk</h5>
                    
                    <div class="filter-group">
                        <label class="filter-label">Kategori</label>
                        @foreach($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="category-{{ $category->id }}" value="{{ $category->id }}" onchange="applyFilters()">
                            <label class="form-check-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Harga</label>
                        <select class="form-select" id="priceFilter" onchange="applyFilters()">
                            <option value="">Semua Harga</option>
                            <option value="0-100">Rp 0 - 100k</option>
                            <option value="100-500">Rp 100k - 500k</option>
                            <option value="500-1000">Rp 500k - 1jt</option>
                            <option value="1000+">Rp 1jt+</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Rating</label>
                        <select class="form-select" id="ratingFilter" onchange="applyFilters()">
                            <option value="">Semua Rating</option>
                            <option value="5">5 Bintang</option>
                            <option value="4">4+ Bintang</option>
                            <option value="3">3+ Bintang</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Brand</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="nike" onchange="applyFilters()">
                            <label class="form-check-label" for="nike">Nike</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="adidas" onchange="applyFilters()">
                            <label class="form-check-label" for="adidas">Adidas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="samsung" onchange="applyFilters()">
                            <label class="form-check-label" for="samsung">Samsung</label>
                        </div>
                    </div>
                    
                    <button class="btn btn-outline-danger w-100 mt-3" onclick="clearFilters()">
                        <i class="fas fa-times me-2"></i>Clear All
                    </button>
                </div>
            </div>
            
            <!-- Products Grid -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 style="color: white; font-weight: 600;">Featured Products</h3>
                    <select class="form-select w-auto" id="sortFilter" onchange="sortProducts()">
                        <option value="">Sort by</option>
                        <option value="price-low">Harga: Rendah ke Tinggi</option>
                        <option value="price-high">Harga: Tinggi ke Rendah</option>
                        <option value="rating">Rating Tertinggi</option>
                        <option value="newest">Terbaru</option>
                    </select>
                </div>
                
                <div class="row" id="productsContainer">
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="{{ route('products.show', $product->slug) }}" class="product-card-link">
                                <div class="product-card">
                                    <img src="{{ asset('images/' . $product->image) }}" class="product-image" alt="{{ $product->name }}">
                                    <div class="product-info">
                                        <h6 class="product-title">{{ $product->name }}</h6>
                                        <div class="product-rating mb-2">
                                            <span style="color: #ffc107;">{{ str_repeat('★', floor($product->rating)) }}{{ str_repeat('☆', 5 - floor($product->rating)) }}</span>
                                            <small class="text-muted ms-1">({{ number_format($product->rating, 1) }})</small>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            <small class="badge bg-secondary">{{ $product->category->name ?? 'Uncategorized' }}</small>
                                        </div>
                                        <button class="btn-add-cart" onclick="event.preventDefault(); addToCart({{ $product->id }})">
                                            <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function addToCart(productId) {
            $.ajax({
                url: '{{ route('cart.add') }}',
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: productId
                },
                success: function (response) {
                    // Since products data is no longer globally available in JS, 
                    // we'll just show a generic success message or fetch product name via AJAX if needed.
                    const productName = "Produk"; // Placeholder, ideally fetch from response or pass from blade
                    
                    // Create floating notification
                    const notification = document.createElement('div');
                    notification.className = 'alert alert-success position-fixed';
                    notification.style.cssText = `
                        top: 120px;
                        right: 20px;
                        z-index: 9999;
                        min-width: 300px;
                        animation: slideInRight 0.5s ease-out;
                    `;
                    notification.innerHTML = `
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>${productName}</strong> ditambahkan ke keranjang!
                    `;
                    
                    document.body.appendChild(notification);
                    
                    // Remove notification after 3 seconds
                    setTimeout(() => {
                        notification.style.animation = 'slideOutRight 0.5s ease-out';
                        setTimeout(() => {
                            document.body.removeChild(notification);
                        }, 500);
                    }, 3000);
                    
                    // Update cart badge
                    const cartBadge = document.querySelector('.fa-shopping-cart').nextElementSibling;
                    if (cartBadge) {
                        // This will require a full page reload or another AJAX call to update accurately
                        // For now, we'll just increment it, but it might be inaccurate on page refresh
                        const currentCount = parseInt(cartBadge.textContent);
                        cartBadge.textContent = currentCount + 1;
                    }
                },
                error: function(xhr) {
                    console.error("Error adding to cart:", xhr.responseText);
                    alert("Gagal menambahkan produk ke keranjang.");
                }
            });
        }

        function scrollToProducts() {
            document.getElementById('products').scrollIntoView({
                behavior: 'smooth'
            });
        }

        function applyFilters() {
            const selectedCategories = [];
            document.querySelectorAll('input[id^="category-"]:checked').forEach(checkbox => {
                selectedCategories.push(checkbox.value);
            });

            const priceFilter = document.getElementById('priceFilter').value;
            const ratingFilter = document.getElementById('ratingFilter').value;
            const sortFilter = document.getElementById('sortFilter').value;
            const searchInput = document.getElementById('searchInput').value; // Get search input value

            $.ajax({
                url: '{{ route('home') }}', // Assuming this is the route for the home page with products
                method: 'GET',
                data: {
                    categories: selectedCategories,
                    price: priceFilter,
                    rating: ratingFilter,
                    sort: sortFilter,
                    search: searchInput // Add search input to data
                },
                success: function(response) {
                    $('#productsContainer').html($(response).find('#productsContainer').html());
                    $('.pagination').html($(response).find('.pagination').html());
                },
                error: function(xhr) {
                    console.error("Error applying filters:", xhr.responseText);
                }
            });
        }

        function clearFilters() {
            document.querySelectorAll('input[id^="category-"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            document.getElementById('priceFilter').value = "";
            document.getElementById('ratingFilter').value = "";
            document.getElementById('sortFilter').value = "";
            document.getElementById('searchInput').value = ""; // Clear search input
            applyFilters();
        }

        function sortProducts() {
            applyFilters();
        }

        

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 8px 32px rgba(0, 0, 0, 0.15)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = '0 8px 32px rgba(0, 0, 0, 0.1)';
            }
        });

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(100%);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
            
            @keyframes slideOutRight {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(100%);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
    @endpush
