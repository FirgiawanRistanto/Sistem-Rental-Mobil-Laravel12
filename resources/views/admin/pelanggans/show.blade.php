@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Detail Pelanggan</div>
    <div class="card-body">
        <p><strong>Nama:</strong> {{ $pelanggan->nama }}</p>
        <p><strong>No. KTP/SIM:</strong> {{ $pelanggan->no_ktp }}</p>
        <p><strong>No. HP:</strong> {{ $pelanggan->no_hp }}</p>
        <p><strong>Alamat:</strong> {{ $pelanggan->alamat }}</p>
        <a href="{{ route('admin.pelanggans.edit', $pelanggan->id) }}" class="btn btn-warning">Edit Pelanggan</a>
        <a href="{{ route('admin.pelanggans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">Riwayat Penyewaan Mobil</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Mobil</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggan->penyewaans as $penyewaan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $penyewaan->mobil->merk }} {{ $penyewaan->mobil->tipe }}</td>
                        <td>{{ $penyewaan->tanggal_sewa->format('d-m-Y') }}</td>
                        <td>{{ $penyewaan->tanggal_kembali->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($penyewaan->total_biaya, 0, ',', '.') }}</td>
                        <td>{{ $penyewaan->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada riwayat penyewaan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection