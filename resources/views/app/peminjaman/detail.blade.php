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
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-danger float-sm-right">Kembali</a>
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
                                <span class="badge badge-danger">{{ $peminjaman->ref_status->status }}</span>
                            @elseif ($peminjaman->kode_status == 1)
                                <span class="badge badge-warning">{{ $peminjaman->ref_status->status }}</span>
                            @elseif ($peminjaman->kode_status == 2)
                                <span class="text-info">{{ $peminjaman->ref_status->status }}</span>
                            @elseif ($peminjaman->kode_status == 3)
                                <span class="text-success">{{ $peminjaman->ref_status->status }}</span>
                            @elseif ($peminjaman->kode_status == 4)
                                <span class="badge badge-success">{{ $peminjaman->ref_status->status }}</span>
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
                            <form
                                action="{{ route('peminjaman.update_status', [$peminjaman->kode_status, $peminjaman->no_peminjaman]) }}"
                                method="POST" role="alert"
                                alert-title="{{ $peminjaman->kode_status == 0 ? 'Konfirmasi Peminjaman' : ($peminjaman->kode_status == 1 ? 'ACC Peminjaman' : ($peminjaman->kode_status == 2 ? 'Terima Alat' : ($peminjaman->kode_status == 3 ? 'Pengembalian' : ''))) }}"
                                alert-text="{{ $peminjaman->kode_status == 0 ? 'Konfirmasi Peminjaman Alat?' : ($peminjaman->kode_status == 1 ? 'ACC Peminjaman Alat?' : ($peminjaman->kode_status == 2 ? 'Sudah Menerima Alat?' : ($peminjaman->kode_status == 3 ? 'Kembalikan Alat Yang Dipinjam?' : ''))) }}">
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
                                                    @if ($peminjaman->kode_status == 3 || $peminjaman->kode_status == 4)
                                                        <th>Kondisi</th>
                                                        <th>Kembali</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($peminjaman_detail as $index => $detail)
                                                    <tr class="text-center">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $detail['kode'] }}</td>
                                                        <td>{{ $detail['alat'] }}</td>
                                                        <td>{{ $detail['qty'] }}</td>
                                                        @if ($peminjaman->kode_status == 3)
                                                            <td style="width: 125px;">
                                                                <select
                                                                    name="peminjaman_detail[{{ $index }}][kode_kondisi]"
                                                                    class="form-control" required>
                                                                    @foreach ($data_kondisi as $kondisi)
                                                                        <option value="{{ $kondisi->kode_kondisi }}">
                                                                            {{ $kondisi->kondisi }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td style="width: 125px;">
                                                                <input
                                                                    name="peminjaman_detail[{{ $index }}][id_alat]"
                                                                    type="hidden" class="form-control" required
                                                                    value="{{ $detail['id_alat'] }}">
                                                                <input name="peminjaman_detail[{{ $index }}][qty]"
                                                                    type="hidden" class="form-control" required
                                                                    value="{{ $detail['qty'] }}">
                                                                <input
                                                                    name="peminjaman_detail[{{ $index }}][qty_kembali]"
                                                                    type="number" class="form-control" required
                                                                    value="{{ $detail['qty_kembali'] }}">
                                                            </td>
                                                        @elseif ($peminjaman->kode_status == 4)
                                                            <td>{{ $detail['kode_kondisi'] }}</td>
                                                            <td>{{ $detail['qty_kembali'] }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row no-print mt-3">
                                    <div class="col-12">
                                        @if ($peminjaman->kode_status == 0)
                                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'staff')
                                                <button type="submit"
                                                    class="btn btn-danger float-right rounded-0">Konfirmasi
                                                    Peminjaman</button>
                                            @endif
                                        @elseif ($peminjaman->kode_status == 1)
                                            @if (auth()->user()->role == 'admin')
                                                <button type="submit" class="btn btn-warning float-right rounded-0">ACC
                                                    Peminjaman</button>
                                            @endif
                                        @elseif ($peminjaman->kode_status == 2)
                                            @if (auth()->user()->role == 'admin')
                                                <button type="submit" class="btn btn-info float-right rounded-0">Terima
                                                    Alat</button>
                                            @endif
                                        @elseif ($peminjaman->kode_status == 3)
                                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'staff')
                                                <button type="submit"
                                                    class="btn btn-success float-right rounded-0">Kembalikan
                                                    Alat</button>
                                            @endif
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
