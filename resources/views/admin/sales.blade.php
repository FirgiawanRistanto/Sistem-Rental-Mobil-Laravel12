@extends('layouts.app')

@section('title', 'Sales Data')

@section('content')

<!-- Header Section -->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0 font-weight-bold">Sales Data</h3>
        <p class="text-muted">Sales data for the business.</p>
    </div>
    <div class="col-sm-6">
        <div class="d-flex align-items-center justify-content-md-end">
            <div class="mb-3 mb-xl-0 pr-1">
                <div class="dropdown">
                    <button class="btn bg-white btn-sm dropdown-toggle btn-icon-text border mr-2" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="typcn typcn-calendar-outline mr-2"></i>Last 7 days
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
                        <h6 class="dropdown-header">Last 14 days</h6>
                        <a class="dropdown-item" href="#">Last 21 days</a>
                        <a class="dropdown-item" href="#">Last 28 days</a>
                    </div>
                </div>
            </div>
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
                <button type="button" class="btn btn-sm bg-white btn-icon-text border">
                    <i class="typcn typcn-arrow-forward-outline mr-2"></i>Export
                </button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-sm bg-white btn-icon-text border">
                    <i class="typcn typcn-info-large-outline mr-2"></i>Info
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Sales Table Row -->
<div class="row mt-4">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Sales Management</h4>
                    <a href="#" class="btn btn-success btn-sm text-white">
                        + Add Sale
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th class="text-center">Quantity</th>
                                <th>Total Price</th>
                                <th>Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sales as $sale)
                                <tr>
                                    <td title="{{ $sale->product_name }}">{{ $sale->product_name }}</td>
                                    <td>Rp {{ number_format($sale->price, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $sale->quantity }}</td>
                                    <td>Rp {{ number_format($sale->price * $sale->quantity, 0, ',', '.') }}</td>
                                    <td>{{ $sale->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <a href="#" class="text-primary mr-3">Edit</a>
                                        <a href="#" class="text-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        No sales data found.
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
@include('layouts._partials.footer')

</div>
@endsection

@push('scripts')
<script src="{{ url('assets/js/dashboard.js') }}"></script>
@endpush