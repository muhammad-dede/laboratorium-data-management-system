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
                        <a href="{{ route('guru.riwayat.index') }}" class="btn btn-danger float-sm-right">Kembali</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> Status Peminjaman:</h5>
                            @if ($peminjaman->kode_status == 4)
                                <span class="badge badge-success">Alat Dikembalikan</span>
                            @endif
                        </div>
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> No Peminjaman: {{ $peminjaman->no_peminjaman }}
                                        <small class="float-right">Tanggal:
                                            {{ \Carbon\Carbon::parse($peminjaman->tgl_peminjaman)->translatedFormat('d F Y') }}</small>
                                    </h4>
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <span class="border-bottom">Siswa</span>
                                    <address>
                                        <strong>{{ $peminjaman->siswa->nama }}</strong><br>
                                        NIS: {{ $peminjaman->siswa->nis }}<br>
                                        Email: {{ $peminjaman->siswa->user->email }}<br>
                                        Kelas: {{ $peminjaman->siswa->kelas->kelas }} -
                                        {{ $peminjaman->siswa->ref_jurusan->jurusan }}<br>
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <span class="border-bottom">Guru</span>
                                    <address>
                                        <strong>{{ $peminjaman->guru->nama }}</strong><br>
                                        NIP: {{ $peminjaman->guru->nip }}<br>
                                        Email: {{ $peminjaman->guru->user->email }}<br>
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <span class="border-bottom">Jadwal Praktek</span>
                                    <address>
                                        <strong>{{ $peminjaman->jadwal_praktek->mapel->mata_pelajaran }}</strong><br>
                                        Hari: {{ $peminjaman->jadwal_praktek->hari }}<br>
                                        Jam Mulai: {{ $peminjaman->jadwal_praktek->jam_mulai }}<br>
                                        Jam Selesai: {{ $peminjaman->jadwal_praktek->jam_selesai }}<br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Kode</th>
                                                <th>Nama Alat</th>
                                                <th>Qty</th>
                                                @if ($peminjaman->kode_status == 4)
                                                    <th>Kondisi</th>
                                                    <th>Kembali</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($peminjaman->peminjaman_detail as $detail)
                                                @php
                                                    $pengembalian = App\Models\Pengembalian::where('no_peminjaman', $detail->no_peminjaman);
                                                    if ($pengembalian->count() > 0) {
                                                        $pengembalian_detail = App\Models\Pengembalian_Detail::where('id_pengembalian', $pengembalian->first()->id_pengembalian)
                                                            ->where('id_alat', $detail['id_alat'])
                                                            ->first();
                                                        $qty_kembali = $pengembalian_detail->qty;
                                                        $kondisi = $pengembalian_detail->ref_kondisi->kondisi;
                                                    } else {
                                                        $qty_kembali = null;
                                                        $kondisi = null;
                                                    }
                                                @endphp
                                                <tr class="text-center">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $detail->alat->kode }}</td>
                                                    <td>{{ $detail->alat->alat }}</td>
                                                    <td>{{ $detail->qty }}</td>
                                                    @if ($peminjaman->kode_status == 4)
                                                        <td>{{ $kondisi }}</td>
                                                        <td>{{ $qty_kembali }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
