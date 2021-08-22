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
                        <a href="{{ route('guru.create') }}" class="btn btn-primary float-sm-right rounded-0">Tambah</a>
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
                                            <th>Guru</th>
                                            <th>NIP</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <th>Agama</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_guru as $guru)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ ucwords(trans(strtolower($guru->nama))) }}</strong><br>
                                                    <small>Email:
                                                        {{ !empty($guru->user->email) ? $guru->user->email : '' }}&nbsp;|&nbsp;Role:
                                                        {{ !empty($guru->user->role) ? $guru->user->role : '' }}</small>
                                                </td>
                                                <td class="text-center">{{ $guru->nip }}</td>
                                                <td class="text-center">{{ $guru->jk }}</td>
                                                <td class="text-center">
                                                    {{ $guru->tempat_lahir }},&nbsp;{{ $guru->tgl_lahir }}</td>
                                                <td class="text-center">{{ $guru->agama }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('guru.edit', $guru) }}"
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
