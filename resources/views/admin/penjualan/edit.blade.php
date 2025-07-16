@extends('layouts.app')

@section('title', 'Edit Data Penjualan')

@section('content')
<div class="row">
    <div class="col-12">
        <h3 class="mb-0 font-weight-bold">Edit Data Penjualan</h3>
        <p class="text-muted">Perbarui data penjualan di bawah ini.</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.penjualan.update', $penjualan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $penjualan->nama_produk }}" required>
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="{{ $penjualan->harga }}" required>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $penjualan->jumlah }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Simpan Perubahan</button>
                    <a href="{{ route('admin.penjualan') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
