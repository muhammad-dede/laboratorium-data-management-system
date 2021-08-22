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
                        <a href="{{ route('peminjaman.create') }}"
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
                                            <th>No Peminjaman</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Siswa</th>
                                            <th>Guru</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_peminjaman as $peminjaman)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $peminjaman->no_peminjaman }}</td>
                                                <td>{{ $peminjaman->jadwal_praktek->mapel->mata_pelajaran }}</td>
                                                <td>{{ $peminjaman->siswa->nama }}</td>
                                                <td>{{ $peminjaman->guru->nama }}</td>
                                                <td>
                                                    @if ($peminjaman->kode_status == 0)
                                                        <span
                                                            class="text-danger">{{ $peminjaman->ref_status->status }}</span>
                                                    @elseif ($peminjaman->kode_status == 1)
                                                        <span
                                                            class="text-warning">{{ $peminjaman->ref_status->status }}</span>
                                                    @elseif ($peminjaman->kode_status == 2)
                                                        <span
                                                            class="text-info">{{ $peminjaman->ref_status->status }}</span>
                                                    @elseif ($peminjaman->kode_status == 3)
                                                        <span
                                                            class="text-success">{{ $peminjaman->ref_status->status }}</span>
                                                    @elseif ($peminjaman->kode_status == 4)
                                                        <span
                                                            class="badge badge-success">{{ $peminjaman->ref_status->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('peminjaman.show', $peminjaman) }}"
                                                        class="btn btn-info btn-sm px-3" title="Detail"><i
                                                            class="fas fa-info"></i></a>
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
    <script>
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
    </script>
@endpush
