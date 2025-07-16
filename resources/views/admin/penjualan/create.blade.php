@extends('layouts.app')

@section('title', 'Tambah Data Penjualan')

@section('content')
<div class="row">
    <div class="col-12">
        <h3 class="mb-0 font-weight-bold">Tambah Data Penjualan</h3>
        <p class="text-muted">Isi formulir di bawah untuk menambahkan data penjualan baru.</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.penjualan.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                    <a href="{{ route('admin.penjualan') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
