@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Manajemen Pelanggan</div>
    <div class="card-body">
        <a href="{{ route('admin.pelanggans.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
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
        var table = $('#pelangganTable').DataTable({
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

        $('#pelangganTable').on('click', '.delete-form button[type="submit"]', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush