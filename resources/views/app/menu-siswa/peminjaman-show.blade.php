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
                        <a href="{{ route('siswa.peminjaman.index') }}" class="btn btn-danger float-sm-right">Kembali</a>
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
                            @if ($peminjaman->kode_status == 0)
                                <span class="badge badge-danger">Menunggu Konfirmasi Petugas</span>
                            @elseif ($peminjaman->kode_status == 1)
                                <span class="badge badge-warning">Menunggu Persetujuan Guru</span>
                            @elseif ($peminjaman->kode_status == 2)
                                <span class="text-info">Peminjaman Di-ACC</span>
                            @elseif ($peminjaman->kode_status == 3)
                                <span class="text-success">Alat Diterima (Belum Dikembalikan)</span>
                            @elseif ($peminjaman->kode_status == 4)
                                <span class="badge badge-success">Alat Dikembalikan</span>
                            @endif
                        </div>
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> No Peminjaman: {{ $peminjaman->no_peminjaman }}
                                        <small class="float-right">Tanggal:
                                            {{ \Carbon\Carbon::parse(now())->translatedFormat('d F Y') }}</small>
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
                            <form action="{{ route('siswa.peminjaman.terima', $peminjaman) }}" method="POST" role="alert"
                                alert-title="Terima Alat" alert-text="Sudah menerima alat?">
                                @csrf
                                @method('put')
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
                                <div class="row no-print">
                                    <div class="col-12">
                                        @if ($peminjaman->kode_status == 2)
                                            <button type="submit" class="btn btn-info float-right rounded-0">Terima
                                                Alat</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@push('scripts')
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
