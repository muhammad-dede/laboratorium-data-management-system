@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    {{-- <div class="col-sm-6">
                        <a href="{{ route('peminjaman.create') }}"
                            class="btn btn-primary float-sm-right rounded-0">Tambah</a>
                    </div> --}}
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
                                            <th>Tanggal Peminjaman</th>
                                            <th>Waktu Peminjaman</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_peminjaman as $peminjaman)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $peminjaman->no_peminjaman }}</td>
                                                <td>
                                                    <strong>{{ $peminjaman->jadwal_praktek->mapel->mata_pelajaran }}</strong><br>
                                                    <small>{{ $peminjaman->guru->nama }}</small>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_peminjaman)->translatedFormat('d F Y') }}
                                                </td>
                                                <td>{{ $peminjaman->waktu_peminjaman }}</td>
                                                <td>
                                                    <a href="{{ route('siswa.riwayat.show', $peminjaman) }}"
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
            });
        });
    </script>
@endpush
