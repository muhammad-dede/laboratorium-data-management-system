@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('petugas.create') }}"
                            class="btn btn-primary float-sm-right rounded-0">Tambah</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Petugas</th>
                                            <th>NIP</th>
                                            <th>Telp</th>
                                            <th>Jabatan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_petugas as $petugas)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ $petugas->nama }}</strong><br>
                                                    <small>Email:
                                                        {{ !empty($petugas->user->email) ? $petugas->user->email : '' }}&nbsp;|&nbsp;Role:
                                                        {{ !empty($petugas->user->role) ? $petugas->user->role : '' }}</small>
                                                </td>
                                                <td class="text-center">{{ $petugas->nip }}</td>
                                                <td class="text-center">{{ $petugas->telp }}</td>
                                                <td class="text-center">{{ $petugas->jabatan }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('petugas.edit', $petugas) }}"
                                                        class="btn btn-warning btn-sm rounded-0">Edit</a>
                                                    {{-- <form action="{{ route('petugas.destroy', $petugas) }}"
                                                        class="form-inline d-inline" method="POST" role="alert"
                                                        alert-title="Hapus" alert-text="Yakin ingin menghapus?">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm rounded-0">Hapus</button>
                                                    </form> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: $(this).attr('alert-title'),
                    text: $(this).attr('alert-text'),
                    icon: "warning",
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: "Batal",
                    reverseButtons: true,
                    confirmButtonText: "Ya",
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                });
            });
        });
    </script> --}}
@endpush
