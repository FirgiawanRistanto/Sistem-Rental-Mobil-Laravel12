@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Manajemen Pelanggan</div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered" id="pelangganTable">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No. KTP/SIM</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
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
        $('#pelangganTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.pelanggans.data") }}',
            columns: [
                { data: 'nama', name: 'nama' },
                { data: 'no_ktp', name: 'no_ktp' },
                { data: 'no_hp', name: 'no_hp' },
                { data: 'alamat', name: 'alamat' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                processing: 'Memuat data...'
            }
        });
    });
</script>
@endpush