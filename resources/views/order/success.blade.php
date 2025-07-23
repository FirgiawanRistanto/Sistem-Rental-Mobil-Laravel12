@extends('layouts.store')

@section('content')
<div class="container content-container text-center">
    <div class="card p-5 shadow-sm">
        <i class="fas fa-check-circle text-success mb-4" style="font-size: 5rem;"></i>
        <h2>Pesanan Berhasil Ditempatkan!</h2>
        <p class="lead">Terima kasih atas pesanan Anda. Kami akan segera memprosesnya.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Lanjutkan Belanja</a>
    </div>
</div>
@endsection