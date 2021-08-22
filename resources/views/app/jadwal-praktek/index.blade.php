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
                        <a href="{{ route('jadwal-praktek.create') }}"
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
                                            <th>Mata Pelajaran</th>
                                            <th>Kelas</th>
                                            <th>Hari</th>
                                            <th>Jam</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_jadwal_praktek as $jadwal_praktek)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ Str::upper($jadwal_praktek->mapel->mata_pelajaran) }}</strong><br>
                                                    <small>Guru:
                                                        {{ !empty($jadwal_praktek->guru->nama) ? $jadwal_praktek->guru->nama : '' }}</small>
                                                </td>
                                                <td class="text-center">{{ $jadwal_praktek->kelas->kelas }}</td>
                                                <td class="text-center">{{ $jadwal_praktek->hari }}</td>
                                                <td class="text-center">
                                                    {{ $jadwal_praktek->jam_mulai }} -
                                                    {{ $jadwal_praktek->jam_selesai }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('jadwal-praktek.edit', $jadwal_praktek) }}"
                                                        class="btn btn-warning btn-sm rounded-0">Edit</a>
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
