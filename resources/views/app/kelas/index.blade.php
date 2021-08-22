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
                        <a href="{{ route('kelas.create') }}" class="btn btn-primary float-sm-right rounded-0">Tambah</a>
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
                                            <th>Jurusan</th>
                                            <th>Kelas</th>
                                            <th>Romawi</th>
                                            <th>Grade</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_kelas as $kelas)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $kelas->ref_jurusan->jurusan }} <br>
                                                    <small>({{ $kelas->ref_jurusan->kompetensi }})</small>
                                                </td>
                                                <td><strong>{{ $kelas->kelas }}</strong></td>
                                                <td>{{ $kelas->romawi }}</td>
                                                <td>{{ $kelas->grade }}</td>
                                                <td>
                                                    <a href="{{ route('kelas.edit', $kelas) }}"
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
