@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<!-- Header Section -->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0 font-weight-bold">Kenneth Osborne</h3>
        <p class="text-muted">Your last login: 21h ago from newzealand.</p>
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

<!-- Stats Cards Row -->
<div class="row mt-4">
    <!-- Sales Analytics Card -->
    <div class="col-xl-8 col-lg-8 col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Sales Analytics</h4>
                    <button type="button" class="btn btn-sm btn-light">Month</button>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="typcn typcn-globe-outline text-primary mr-2"></i>
                            <div>
                                <h6 class="mb-0">Online</h6>
                                <h3 class="text-primary font-weight-bold mb-0">23,342</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="typcn typcn-archive text-secondary mr-2"></i>
                            <div>
                                <h6 class="mb-0">Offline</h6>
                                <h3 class="text-secondary font-weight-bold mb-0">13,221</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="typcn typcn-tags text-warning mr-2"></i>
                            <div>
                                <h6 class="mb-0">Marketing</h6>
                                <h3 class="text-warning font-weight-bold mb-0">1,542</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="chart-container">
                    <canvas id="salesanalyticChart" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings Card -->
    <div class="col-xl-4 col-lg-4 col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Earnings Overview</h4>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-info">Total Earning</span>
                        <span class="text-success font-weight-bold">+1.4%</span>
                    </div>
                    <h3 class="font-weight-bold text-dark mb-0">$287,493</h3>
                    <small class="text-muted">Since Last Month</small>
                </div>

                <hr class="my-4">

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-info">Total Orders</span>
                        <span class="text-success font-weight-bold">+5.43%</span>
                    </div>
                    <h3 class="font-weight-bold text-dark mb-0">87,493</h3>
                    <small class="text-muted">Since Last Month</small>
                </div>

                <div class="chart-container">
                    <canvas id="barChartStacked" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- E-Commerce Analytics Row -->
<div class="row">
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">E-Commerce Analytics</h4>

                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div class="dropdown">
                        <button class="btn bg-white btn-sm dropdown-toggle btn-icon-text border" type="button" id="dropdownMenuSizeButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mon, 1 Oct 2019 - Tue, 2 Oct 2019
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton4">
                            <h6 class="dropdown-header">Mon, 17 Oct 2019 - Tue, 25 Oct 2019</h6>
                            <a class="dropdown-item" href="#">Tue, 18 Oct 2019 - Wed, 26 Oct 2019</a>
                            <a class="dropdown-item" href="#">Wed, 19 Oct 2019 - Thu, 26 Oct 2019</a>
                        </div>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-light">Day</button>
                        <button type="button" class="btn btn-sm btn-light">Week</button>
                        <button type="button" class="btn btn-sm btn-light">Month</button>
                    </div>
                </div>

                <div class="chart-container">
                    <canvas id="ecommerceAnalytic" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Stats -->
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Analytics Stats</h4>

                <div class="mb-4">
                    <h6 class="text-success font-weight-bold mb-3">Inbound Traffic</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Current</span>
                        <span class="text-muted">38.34M</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Average</span>
                        <span class="text-muted">38.34M</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Maximum</span>
                        <span class="text-muted">68.14M</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>60th %</span>
                        <span class="text-muted">168.3GB</span>
                    </div>
                </div>

                <hr>

                <div class="mt-4">
                    <h6 class="text-success font-weight-bold mb-3">Outbound Traffic</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Current</span>
                        <span class="text-muted">458.77M</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Average</span>
                        <span class="text-muted">1.45K</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Maximum</span>
                        <span class="text-muted">15.50K</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>60th %</span>
                        <span class="text-muted">45.5</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sale Analysis Trend -->
<div class="row">
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Sale Analysis Trend</h4>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Order Value</span>
                        <span class="text-primary font-weight-bold">155.5%</span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Total Products</span>
                        <span class="text-success font-weight-bold">238.2%</span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Quantity</span>
                        <span class="text-warning font-weight-bold">23.30%</span>
                    </div>
                    <div class="progress mb-4" style="height: 8px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="chart-container">
                    <canvas id="salesTopChart" height="120"></canvas>
                </div>
            </div>
        </div>
       
    </div>
</div> @include('layouts._partials.footer')
<!-- content-wrapper ends -->
</div>
@endsection

@push('scripts')
<script src="{{ url('assets/js/dashboard.js') }}"></script>
@endpush