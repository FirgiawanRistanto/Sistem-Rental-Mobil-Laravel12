@extends('layouts.app')

@section('title', 'Data Penjualan')

@section('content')

<!-- Header Section -->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0 font-weight-bold">Data Penjualan</h3>
        <p class="text-muted">Data penjualan untuk bisnis.</p>
    </div>
    <div class="col-sm-6">
        <div class="d-flex align-items-center justify-content-md-end">
            <div class="mb-3 mb-xl-0 pr-1">
                <div class="dropdown">
                    <button class="btn bg-white btn-sm dropdown-toggle btn-icon-text border mr-2" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="typcn typcn-calendar-outline mr-2"></i>7 hari terakhir
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
                        <h6 class="dropdown-header">14 hari terakhir</h6>
                        <a class="dropdown-item" href="#">21 hari terakhir</a>
                        <a class="dropdown-item" href="#">28 hari terakhir</a>
                    </div>
                </div>
            </div>
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
                <button type="button" class="btn btn-sm bg-white btn-icon-text border">
                    <i class="typcn typcn-arrow-forward-outline mr-2"></i>Ekspor
                </button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <a href="{{ route('admin.penjualan.create') }}" class="btn btn-info btn-sm text-white btn-icon-text border">
                    + Tambah Data Penjualan
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Sales Table Row -->
<div class="row mt-4">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th>Total Harga</th>
                                <th>Tanggal</th>
                                <th class="text-center actions-cell">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penjualan as $item_penjualan)
                            <tr>
                                <td><span class="truncate-text" title="{{ $item_penjualan->nama_produk }}">{{ $item_penjualan->nama_produk }}</span></td>
                                <td>Rp {{ number_format($item_penjualan->harga, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $item_penjualan->jumlah }}</td>
                                <td>Rp {{ number_format($item_penjualan->harga * $item_penjualan->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $item_penjualan->created_at->format('d M Y') }}</td>
                                <td class="text-center actions-cell">
                                    <a href="{{ route('admin.penjualan.edit', $item_penjualan->id) }}" class="btn btn-sm btn-success mr-3"><i class="typcn typcn-edit btn-icon-append"></i>Edit</a>
                                    <form action="{{ route('admin.penjualan.destroy', $item_penjualan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="typcn typcn-delete btn-icon-append"></i>Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    Tidak ada data penjualan ditemukan.
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