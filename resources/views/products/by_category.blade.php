@extends('layouts.store')

@section('content')
<div class="container-fluid" style="margin-top: 100px;">
    <div class="container">
        <h2 class="section-title">Produk dalam Kategori: {{ $category->name }}</h2>

        <div class="row">
            <!-- Filter Sidebar -->
            <div class="col-lg-3">
                <div class="filter-sidebar">
                    <h5 class="filter-title"><i class="fas fa-filter me-2"></i>Filter Produk</h5>
                    
                    <div class="filter-group">
                        <label class="filter-label">Kategori</label>
                        @foreach($categories as $cat)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="category-{{ $cat->id }}" value="{{ $cat->id }}" onchange="applyFilters()" {{ $cat->id == $category->id ? 'checked' : '' }}>
                            <label class="form-check-label" for="category-{{ $cat->id }}">{{ $cat->name }}</label>
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
                    <h3 style="color: white; font-weight: 600;">Produk</h3>
                    <select class="form-select w-auto" id="sortFilter" onchange="sortProducts()">
                        <option value="">Sort by</option>
                        <option value="price-low">Harga: Rendah ke Tinggi</option>
                        <option value="price-high">Harga: Tinggi ke Rendah</option>
                        <option value="rating">Rating Tertinggi</option>
                        <option value="newest">Terbaru</option>
                    </select>
                </div>
                
                <div class="row" id="productsContainer">
                    @forelse($products as $product)
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
                    @empty
                        <div class="col-12 text-center text-white">
                            <p>Tidak ada produk dalam kategori ini.</p>
                        </div>
                    @endforelse
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
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
                const productName = "Produk"; 
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
                
                setTimeout(() => {
                    notification.style.animation = 'slideOutRight 0.5s ease-out';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 500);
                }, 3000);
                
                const cartBadge = document.querySelector('.fa-shopping-cart').nextElementSibling;
                if (cartBadge) {
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

    function applyFilters() {
        const selectedCategories = [];
        document.querySelectorAll('input[id^="category-"]:checked').forEach(checkbox => {
            selectedCategories.push(checkbox.value);
        });

        const priceFilter = document.getElementById('priceFilter').value;
        const ratingFilter = document.getElementById('ratingFilter').value;
        const sortFilter = document.getElementById('sortFilter').value;
        const searchInput = document.getElementById('searchInput') ? document.getElementById('searchInput').value : '';

        const currentCategoryId = {{ $category->id ?? 'null' }};

        $.ajax({
            url: '{{ route('products.byCategory', $category->id) }}', // Use the category-specific route
            method: 'GET',
            data: {
                categories: selectedCategories,
                price: priceFilter,
                rating: ratingFilter,
                sort: sortFilter,
                search: searchInput
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
        if (document.getElementById('searchInput')) {
            document.getElementById('searchInput').value = "";
        }
        // Re-check the current category checkbox after clearing filters
        const currentCategoryCheckbox = document.getElementById('category-{{ $category->id ?? '' }}');
        if (currentCategoryCheckbox) {
            currentCategoryCheckbox.checked = true;
        }
        applyFilters();
    }

    function sortProducts() {
        applyFilters();
    }

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
@endsection