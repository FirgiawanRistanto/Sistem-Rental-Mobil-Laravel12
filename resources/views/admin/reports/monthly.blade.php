@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Laporan Bulanan Penyewaan Mobil</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.dashboard.report') }}" method="GET" class="mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="month" class="form-label">Bulan:</label>
                    <select name="month" id="month" class="form-select">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ sprintf('%02d', $i) }}" {{ $month == sprintf('%02d', $i) ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="year" class="form-label">Tahun:</label>
                    <input type="number" name="year" id="year" class="form-control" value="{{ $year }}">
                </div>
                <div class="col-md-4">
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary flex-fill me-1"><i class="fas fa-filter me-2"></i>Tampilkan Laporan</button>
                        <a href="{{ route('admin.reports.export', ['month' => $month, 'year' => $year]) }}" target="_blank" class="btn btn-success flex-fill ms-1"><i class="fas fa-file-export me-2"></i>Export</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title"><i class="fas fa-calendar-check me-2"></i>Total Penyewaan</h5>
                        <p class="card-text fs-2 fw-bold">{{ $totalPenyewaan }}</p>
                    </div>
                    <i class="fas fa-car-alt fa-3x"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title"><i class="fas fa-dollar-sign me-2"></i>Total Pendapatan</h5>
                        <p class="card-text fs-2 fw-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                    </div>
                    <i class="fas fa-money-bill-wave fa-3x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-car me-2"></i>Mobil Paling Sering Disewa</h5>
    </div>
    <div class="card-body">
        @if($mobilPalingSeringDisewa->isEmpty())
            <div class="alert alert-info" role="alert">
                Tidak ada data mobil paling sering disewa untuk bulan ini.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Merk</th>
                            <th>Tipe</th>
                            <th>Nomor Polisi</th>
                            <th>Jumlah Disewa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mobilPalingSeringDisewa as $item)
                            <tr>
                                <td>{{ $item->mobil->merk }}</td>
                                <td>{{ $item->mobil->tipe }}</td>
                                <td>{{ $item->mobil->nopol }}</td>
                                <td>{{ $item->total_sewa }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection