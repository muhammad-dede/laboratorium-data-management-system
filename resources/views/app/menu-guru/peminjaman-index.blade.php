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
                                            <th>No Peminjaman</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Waktu Peminjaman</th>
                                            <th>Status</th>
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
                                                    @if ($peminjaman->kode_status == 0)
                                                        <span class="text-danger">Menunggu Konfirmasi Petugas</span>
                                                    @elseif ($peminjaman->kode_status == 1)
                                                        <span class="text-warning">Menunggu Persetujuan Guru</span>
                                                    @elseif ($peminjaman->kode_status == 2)
                                                        <span class="text-info">Peminjaman Di-ACC</span>
                                                    @elseif ($peminjaman->kode_status == 3)
                                                        <span class="text-success">Alat Diterima</span>
                                                    @elseif ($peminjaman->kode_status == 4)
                                                        <span class="badge badge-success">Alat Dikembalikan</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('guru.peminjaman.show', $peminjaman) }}"
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
