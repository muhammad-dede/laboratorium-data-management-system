<table>
    <thead>
        <tr>
            <th>Mata Pelajaran</th>
            <th>Guru</th>
            <th>Siswa</th>
            <th>Petugas</th>
            <th>Tanggal Peminjaman</th>
            <th>Waktu Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Waktu Pengembalian</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_peminjaman as $peminjaman)
            <tr>
                <td>{{ $peminjaman->jadwal_praktek->mapel->mata_pelajaran }}</td>
                <td>{{ $peminjaman->guru->nama }}</td>
                <td>{{ $peminjaman->siswa->nama }}</td>
                <td>{{ $peminjaman->petugas->nama }}</td>
                <td>{{ $peminjaman->tgl_peminjaman }}</td>
                <td>{{ $peminjaman->waktu_peminjaman }}</td>
                <td>{{ $peminjaman->pengembalian->tgl_pengembalian }}</td>
                <td>{{ $peminjaman->pengembalian->waktu_pengembalian }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
