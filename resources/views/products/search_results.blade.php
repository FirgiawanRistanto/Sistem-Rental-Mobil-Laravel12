@extends('layouts.store')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-lg-12">
                <h3 style="color: white; font-weight: 600;">Search Results for "{{ request('search') }}"</h3>
                <hr>
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
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                <h4>No products found</h4>
                                <p>We couldn't find any products matching your search.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
