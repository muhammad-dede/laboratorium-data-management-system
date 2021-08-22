@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
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
                                            <th>Mata Pelajaran</th>
                                            <th>Kelas</th>
                                            <th>Hari</th>
                                            <th>Jam</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_jadwal as $jadwal_praktek)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ Str::upper($jadwal_praktek->mapel->mata_pelajaran) }}</strong><br>
                                                </td>
                                                <td class="text-center">{{ $jadwal_praktek->kelas->kelas }}</td>
                                                <td class="text-center">{{ $jadwal_praktek->hari }}</td>
                                                <td class="text-center">
                                                    {{ $jadwal_praktek->jam_mulai }} -
                                                    {{ $jadwal_praktek->jam_selesai }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('guru.jadwal.show', $jadwal_praktek) }}"
                                                        class="btn btn-warning btn-sm rounded-0">Detail</a>
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
@endpush
