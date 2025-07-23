@extends('layouts.store')

@section('content')
<div class="container content-container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $product->name }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('images/' . $product->image) }}" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $product->name }}</h3>
                            <p><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p><strong>Stok:</strong> {{ $product->stock }}</p>
                            <p><strong>Deskripsi:</strong></p>
                            <p>{{ $product->description }}</p>
                            <p><strong>Dilihat:</strong> {{ $productViewsCount }} kali</p>
                            <button class="btn btn-primary" onclick="addToCart({{ $product->id }})">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
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
            const productName = "{{ $product->name }}";

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
                const currentCount = parseInt(cartBadge.textContent);
                cartBadge.textContent = currentCount + 1;
            }
        }
    });
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
