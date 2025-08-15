@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Detail Mobil</div>
    <div class="card-body">
        <p><strong>Merk:</strong> {{ $mobil->merk }}</p>
        <p><strong>Tipe:</strong> {{ $mobil->tipe }}</p>
        <p><strong>Nomor Polisi:</strong> {{ $mobil->nopol }}</p>
        <p><strong>Harga Sewa per Hari:</strong> {{ $mobil->harga_sewa }}</p>
        <p><strong>Denda per Hari:</strong> {{ $mobil->denda_per_hari }}</p>
        <p><strong>Status:</strong> {{ $mobil->status }}</p>
        <p><strong>Disewa Berapa Kali:</strong> {{ $mobil->disewa }}</p>
        <p><strong>Jadwal Perawatan Berikutnya:</strong> {{ $mobil->jadwal_perawatan_berikutnya ? \Carbon\Carbon::parse($mobil->jadwal_perawatan_berikutnya)->format('d F Y') : '-' }}</p>
        <p><strong>Periode Perawatan:</strong> {{ $mobil->periode_perawatan_hari ? $mobil->periode_perawatan_hari . ' hari' : '-' }}</p>
        <a href="{{ route('admin.mobils.edit', $mobil->id) }}" class="btn btn-warning">Edit Mobil</a>
        <a href="{{ route('admin.mobils.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">Galeri Gambar</div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="imageTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="exterior-tab" data-bs-toggle="tab" data-bs-target="#exterior" type="button" role="tab" aria-controls="exterior" aria-selected="true">Eksterior</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="interior-tab" data-bs-toggle="tab" data-bs-target="#interior" type="button" role="tab" aria-controls="interior" aria-selected="false">Interior</button>
            </li>
        </ul>
        <div class="tab-content" id="imageTabsContent">
            <div class="tab-pane fade show active" id="exterior" role="tabpanel" aria-labelledby="exterior-tab">
                <div class="row mt-3">
                    @if(isset($gambars['exterior']))
                        @foreach($gambars['exterior'] as $gambar)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $gambar->path) }}" class="card-img-top" alt="{{ $gambar->label }}">
                                    <div class="card-body">
                                        <p class="card-text">{{ $gambar->label }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Tidak ada gambar eksterior.</p>
                    @endif
                </div>
            </div>
            <div class="tab-pane fade" id="interior" role="tabpanel" aria-labelledby="interior-tab">
                <div class="row mt-3">
                    @if(isset($gambars['interior']))
                        @foreach($gambars['interior'] as $gambar)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $gambar->path) }}" class="card-img-top" alt="{{ $gambar->label }}">
                                    <div class="card-body">
                                        <p class="card-text">{{ $gambar->label }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Tidak ada gambar interior.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection