@extends('layouts.store')

@section('content')
<div class="container content-container">
    <h2 class="text-center mb-4">Checkout</h2>

    @if(empty($cart))
        <div class="alert alert-info text-center">
            Keranjang Anda kosong. Silakan tambahkan produk terlebih dahulu.
        </div>
        <div class="text-center">
            <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Lanjutkan Belanja</a>
        </div>
    @else
        <form action="{{ route('cart.placeOrder') }}" method="POST">
            @csrf
            <div class="card mb-4">
                <div class="card-header">
                    Detail Pesanan
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($cart as $id => $details)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <img src="{{ asset('images/' . $details['image']) }}" width="50" height="50" class="img-thumbnail me-3" alt="{{ $details['name'] }}">
                                    {{ $details['name'] }} ({{ $details['quantity'] }} x Rp {{ number_format($details['price'], 0, ',', '.') }})
                                </div>
                                <span>Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                            </li>
                            <input type="hidden" name="selected_products[]" value="{{ $id }}">
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-end">
                    <h4><strong>Total: Rp {{ number_format($total, 0, ',', '.') }}</strong></h4>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Informasi Pengiriman
                </div>
                <div class="card-body">
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Pengiriman</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap Anda" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan nomor telepon Anda" required>
                        </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Metode Pembayaran
                </div>
                <div class="card-body">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                        <label class="form-check-label" for="cod">
                            Cash On Delivery (COD)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="bankTransfer" value="bank_transfer">
                        <label class="form-check-label" for="bankTransfer">
                            Transfer Bank
                        </label>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('cart.index') }}" class="btn btn-secondary me-2">Kembali ke Keranjang</a>
                <button type="submit" class="btn btn-success">Lanjutkan Pembayaran</button>
            </div>
        </form>
    @endif
</div>
@endsection