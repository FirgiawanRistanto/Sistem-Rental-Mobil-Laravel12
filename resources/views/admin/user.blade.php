@extends('layouts.app')

@section('title', 'Users')

@section('content')

<!-- Header Section -->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0 font-weight-bold">User Management</h3>
        <p class="text-muted">Manage users of the application.</p>
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
                <a href="{{ route('admin.users.create') }}" class="btn btn-info btn-sm text-white btn-icon-text border">+ Add User
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Users Table Row -->
<div class="row mt-4">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Foto</th>
                                <th>Joined On</th>
                                <th>Dibuat Oleh</th>
                                <th class="text-center actions-cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td><span class="truncate-text" title="{{ $user->name }}">{{ $user->name }}</span></td>
                                <td title="{{ $user->email }}"><span class="truncate-text" title="{{ $user->email }}">{{ $user->email }}</span></td>
                                <td>{{ $user->jenis_kelamin }}</td>
                                <td><span class="truncate-text" title="{{ $user->alamat }}">{{ $user->alamat }}</span></td>
                                <td>
                                    @if($user->foto)
                                    <img src="{{ asset('images/' . $user->foto) }}" alt="Foto" width="50">
                                    @else
                                    No Photo
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td>{{ $user->creator->name ?? 'N/A' }}</td>
                                <td class="text-center actions-cell">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-success btn-sm mr-2"><i class="typcn typcn-edit btn-icon-append"></i>Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure?')"><i class="typcn typcn-delete btn-icon-append"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    No users found.
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