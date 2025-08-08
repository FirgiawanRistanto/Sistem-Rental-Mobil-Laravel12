@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Manajemen Penyewaan</div>
    <div class="card-body">
        <a href="{{ route('admin.penyewaans.create') }}" class="btn btn-primary mb-3">Tambah Penyewaan Baru</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered" id="penyewaanTable">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Mobil</th>
                    <th>Pelanggan</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Data akan diisi oleh DataTables --}}
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#penyewaanTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.penyewaans.data") }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'mobil.merk', name: 'mobil.merk' },
                { data: 'pelanggan.nama', name: 'pelanggan.nama' },
                { data: 'tanggal_sewa', name: 'tanggal_sewa' },
                { data: 'tanggal_kembali', name: 'tanggal_kembali' },
                { data: 'total_biaya', name: 'total_biaya' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            order: [[ 3, 'desc' ]], // Default order by tanggal_sewa
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                processing: 'Memuat data...'
            }
        });
    });
</script>
@endpush