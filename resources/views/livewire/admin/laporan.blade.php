<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-info">
                    Filter Data Sesuai Tanggal Peminjaman
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <input wire:model="from_date" type="date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input wire:model="to_date" type="date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button wire:click.prevent="export_excel" class="btn btn-success btn-block"><i
                                class="fas fa-file-excel"></i> EXCEL</button>
                    </div>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>No Peminjaman</th>
                            <th>Mata Pelajaran</th>
                            <th>Siswa</th>
                            <th>Guru</th>
                            <th>Petugas</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Waktu Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Waktu Pengembalian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_peminjaman as $peminjaman)
                            <tr class="text-center">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $peminjaman->no_peminjaman }}</td>
                                <td>{{ $peminjaman->jadwal_praktek->mapel->mata_pelajaran }}</td>
                                <td>{{ $peminjaman->siswa->nama }}</td>
                                <td>{{ $peminjaman->guru->nama }}</td>
                                <td>{{ $peminjaman->petugas->nama }}</td>
                                <td>{{ $peminjaman->tgl_peminjaman }}</td>
                                <td>{{ $peminjaman->waktu_peminjaman }}</td>
                                <td>{{ $peminjaman->pengembalian->tgl_pengembalian }}</td>
                                <td>{{ $peminjaman->pengembalian->waktu_pengembalian }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="11">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
