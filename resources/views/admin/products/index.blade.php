@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')

<!-- Header Section -->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0 font-weight-bold">Data Produk</h3>
        <p class="text-muted">Daftar produk yang tersedia.</p>
    </div>
    <div class="col-sm-6">
        <div class="d-flex align-items-center justify-content-md-end">
            <div class="pr-1 mb-3 mb-xl-0">
                <a href="{{ route('admin.products.create') }}" class="btn btn-info btn-sm text-white btn-icon-text border">
                    + Tambah Produk
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Products Table Row -->
<div class="row mt-4">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped product-table">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Brand</th>
                                <th>Kategori ID</th>
                                <th>Rating</th>
                                <th>Dibuat Oleh</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center actions-cell">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td><img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" width="100"></td>
                                <td><span class="truncate-text" title="{{ $product->name }}">{{ $product->name }}</span></td>
                                <td><span class="truncate-text" title="{{ $product->description }}">{{ $product->description }}</span></td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ $product->brand }}</td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>{{ number_format($product->rating, 2) }}</td>
                                <td>{{ $product->creator->name ?? 'N/A' }}</td>
                                <td class="text-center">{{ $product->stock }}</td>
                                <td class="text-center actions-cell">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-success mr-3"><i class="typcn typcn-edit btn-icon-append"></i>Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="typcn typcn-delete btn-icon-append"></i>Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    Tidak ada data produk ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>@include('layouts._partials.footer')

@endsection

@push('scripts')
<script src="{{ url('assets/js/dashboard.js') }}"></script>
@endpush