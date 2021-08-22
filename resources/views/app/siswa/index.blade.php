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
                        <a href="{{ route('siswa.create') }}" class="btn btn-primary float-sm-right rounded-0">Tambah</a>
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
                                            <th>Siswa</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <th>Agama</th>
                                            <th>Jurusan</th>
                                            <th>Kelas</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_siswa as $siswa)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ ucwords(trans(strtolower($siswa->nama))) }}</strong><br>
                                                    <small>NIS: {{ $siswa->nis }}</small><br>
                                                    <small>Email:
                                                        {{ !empty($siswa->user->email) ? $siswa->user->email : '' }}&nbsp;|&nbsp;Role:
                                                        {{ !empty($siswa->user->role) ? $siswa->user->role : '' }}</small>
                                                </td>
                                                <td class="text-center">{{ $siswa->jk }}</td>
                                                <td class="text-center">
                                                    {{ $siswa->tempat_lahir }},&nbsp;{{ $siswa->tgl_lahir }}</td>
                                                <td class="text-center">{{ $siswa->agama }}</td>
                                                <td class="text-center">{{ $siswa->ref_jurusan->kompetensi }}</td>
                                                <td class="text-center">{{ $siswa->kelas->kelas }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('siswa.edit', $siswa) }}"
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
