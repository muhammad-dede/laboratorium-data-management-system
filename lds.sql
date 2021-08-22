-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Agu 2021 pada 15.16
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lds`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat`
--

CREATE TABLE `alat` (
  `id_alat` bigint(20) UNSIGNED NOT NULL,
  `kode` char(20) DEFAULT NULL,
  `alat` varchar(255) DEFAULT NULL,
  `satuan` char(20) DEFAULT NULL,
  `stok` double DEFAULT 0,
  `hilang` double DEFAULT 0,
  `rusak` double DEFAULT 0,
  `id_rak` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alat`
--

INSERT INTO `alat` (`id_alat`, `kode`, `alat`, `satuan`, `stok`, `hilang`, `rusak`, `id_rak`) VALUES
(1, 'GT-001', 'AVO Meter', 'PCS', 29, 1, 0, 5),
(2, 'TO-001', 'Timing Light', 'PCS', 30, 0, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nip` char(30) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `tempat_lahir` char(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` char(20) DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nama`, `nip`, `jk`, `tempat_lahir`, `tgl_lahir`, `agama`, `id_user`) VALUES
(1, 'Eddy Rosyad', '27638627312123', 'L', 'Serang', '1977-08-03', 'Islam', 4),
(2, 'Dede Rian Aldiansyah', '3092372370', 'L', 'Serang', '1999-10-24', 'Islam', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_praktek`
--

CREATE TABLE `jadwal_praktek` (
  `id_jadwal_praktek` bigint(20) UNSIGNED NOT NULL,
  `id_mapel` bigint(20) UNSIGNED DEFAULT NULL,
  `id_guru` bigint(20) UNSIGNED DEFAULT NULL,
  `id_kelas` bigint(20) UNSIGNED DEFAULT NULL,
  `hari` char(10) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal_praktek`
--

INSERT INTO `jadwal_praktek` (`id_jadwal_praktek`, `id_mapel`, `id_guru`, `id_kelas`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(1, 5, 1, 8, 'Senin', '09:00:00', '10:00:00'),
(2, 5, 1, 7, 'Senin', '08:00:00', '09:00:00'),
(3, 5, 1, 9, 'Senin', '10:30:00', '11:30:00'),
(4, 4, 1, 1, 'Selasa', '08:00:00', '09:00:00'),
(5, 4, 1, 2, 'Selasa', '09:00:00', '10:00:00'),
(6, 4, 1, 3, 'Selasa', '10:30:00', '11:30:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `kode_jurusan` char(10) DEFAULT NULL,
  `romawi` char(5) DEFAULT NULL,
  `grade` char(5) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kode_jurusan`, `romawi`, `grade`, `kelas`) VALUES
(1, 'TO', 'X', '1', 'X TO 1'),
(2, 'TO', 'X', '2', 'X TO 2'),
(3, 'TO', 'X', '3', 'X TO 3'),
(4, 'TO', 'XI', '1', 'XI TO 1'),
(5, 'TO', 'XI', '2', 'XI TO 2'),
(6, 'TO', 'XI', '3', 'XI TO 3'),
(7, 'TO', 'XII', '1', 'XII TO 1'),
(8, 'TO', 'XII', '2', 'XII TO 2'),
(9, 'TO', 'XII', '3', 'XII TO 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` bigint(20) UNSIGNED NOT NULL,
  `singkatan` char(30) DEFAULT NULL,
  `mata_pelajaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `singkatan`, `mata_pelajaran`) VALUES
(1, 'GT', 'Gambar Teknik'),
(2, 'KMKE', 'Kelistrikan Mesin Dan Konversi Energi'),
(3, 'TPMMI', 'Teknik Pemeliharaan Mekanik Mesin Industri'),
(4, 'TPL', 'Teknik Pengerjaan Logam'),
(5, 'TPSPH', 'Teknik Pemeliharaan Sistem Pnematik Dan Hidrolik'),
(6, 'TPSKMP', 'Teknik Pemeliharaan Sistem Kelistrikan Mesin Perkakas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `no_peminjaman` char(20) NOT NULL,
  `id_jadwal_praktek` bigint(20) UNSIGNED DEFAULT NULL,
  `id_siswa` bigint(20) UNSIGNED DEFAULT NULL,
  `id_guru` bigint(20) UNSIGNED DEFAULT NULL,
  `id_petugas` bigint(20) UNSIGNED DEFAULT NULL,
  `tgl_peminjaman` date DEFAULT current_timestamp(),
  `waktu_peminjaman` time DEFAULT current_timestamp(),
  `kode_status` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`no_peminjaman`, `id_jadwal_praktek`, `id_siswa`, `id_guru`, `id_petugas`, `tgl_peminjaman`, `waktu_peminjaman`, `kode_status`) VALUES
('1629512179', 1, 1, 1, 1, '2021-08-21', '09:16:19', '4'),
('1629607515', 1, 1, 1, 1, '2021-08-22', '11:45:15', '4'),
('1629636363', 1, 1, 1, 1, '2021-08-22', '19:46:03', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_detail`
--

CREATE TABLE `peminjaman_detail` (
  `id_peminjaman_detail` bigint(20) UNSIGNED NOT NULL,
  `no_peminjaman` char(20) DEFAULT NULL,
  `id_alat` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman_detail`
--

INSERT INTO `peminjaman_detail` (`id_peminjaman_detail`, `no_peminjaman`, `id_alat`, `qty`) VALUES
(1, '1629512179', 1, 1),
(2, '1629512179', 2, 1),
(7, '1629607515', 1, 1),
(8, '1629607515', 2, 1),
(9, '1629636363', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` bigint(20) UNSIGNED NOT NULL,
  `no_peminjaman` char(20) DEFAULT NULL,
  `tgl_pengembalian` date DEFAULT current_timestamp(),
  `waktu_pengembalian` time DEFAULT current_timestamp(),
  `id_petugas` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `no_peminjaman`, `tgl_pengembalian`, `waktu_pengembalian`, `id_petugas`) VALUES
(2, '1629512179', '2021-08-21', '19:51:25', 1),
(4, '1629607515', '2021-08-22', '19:35:45', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian_detail`
--

CREATE TABLE `pengembalian_detail` (
  `id_pengembalian_detail` bigint(20) UNSIGNED NOT NULL,
  `id_pengembalian` bigint(20) UNSIGNED DEFAULT NULL,
  `id_alat` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` double DEFAULT 0,
  `kode_kondisi` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengembalian_detail`
--

INSERT INTO `pengembalian_detail` (`id_pengembalian_detail`, `id_pengembalian`, `id_alat`, `qty`, `kode_kondisi`) VALUES
(3, 2, 1, 0, '3'),
(4, 2, 2, 1, '1'),
(7, 4, 1, 1, '1'),
(8, 4, 2, 1, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nip` char(20) DEFAULT NULL,
  `telp` char(20) DEFAULT NULL,
  `jabatan` enum('Staff','Kepala Laboratorium') DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama`, `nip`, `telp`, `jabatan`, `id_user`) VALUES
(1, 'Administrator', '0000000000', '081295705672', 'Staff', 1),
(2, 'Staff', '111111111', '081295705672', 'Staff', 2),
(3, 'Kepala Laboratorium', '222222222', '081295705672', 'Kepala Laboratorium', 3),
(4, 'Dede Rian Aldiansyah', '273281392', '081234567891', 'Staff', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rak`
--

CREATE TABLE `rak` (
  `id_rak` bigint(20) UNSIGNED NOT NULL,
  `rak` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rak`
--

INSERT INTO `rak` (`id_rak`, `rak`, `lokasi`) VALUES
(1, 'TO', 'A1'),
(2, 'TKJ', 'A1'),
(3, 'TM', 'A1'),
(4, 'AKUNTANSI', 'A3'),
(5, 'TO', 'A2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_jurusan`
--

CREATE TABLE `ref_jurusan` (
  `kode_jurusan` char(10) NOT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `kompetensi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ref_jurusan`
--

INSERT INTO `ref_jurusan` (`kode_jurusan`, `jurusan`, `kompetensi`) VALUES
('AK', 'AKUNTANSI', 'AKUNTANSI DAN KEUANGAN LEMBAGA'),
('TKJ', 'TKJ', 'TEKNIK KOMPUTER DAN JARINGAN'),
('TM', 'TPMI', 'TEKNIK MEKANIK INDUSTRI'),
('TO', 'TKR', 'TEKNIK KENDARAAN RINGAN OTOMOTIF'),
('UM', 'UMUM', 'UMUM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_kondisi`
--

CREATE TABLE `ref_kondisi` (
  `kode_kondisi` char(5) NOT NULL,
  `kondisi` char(30) DEFAULT NULL,
  `aktif` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ref_kondisi`
--

INSERT INTO `ref_kondisi` (`kode_kondisi`, `kondisi`, `aktif`) VALUES
('1', 'Baik', 1),
('2', 'Rusak', 1),
('3', 'Hilang', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_status`
--

CREATE TABLE `ref_status` (
  `kode_status` char(5) NOT NULL,
  `status` char(30) DEFAULT NULL,
  `aktif` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ref_status`
--

INSERT INTO `ref_status` (`kode_status`, `status`, `aktif`) VALUES
('0', 'Peminjaman Baru', 1),
('1', 'Sudah Dikonfirmasi', 1),
('2', 'Sudah Di-ACC', 1),
('3', 'Diterima', 1),
('4', 'Dikembalikan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `nis` char(20) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `tempat_lahir` char(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` char(20) DEFAULT NULL,
  `kode_jurusan` char(10) DEFAULT NULL,
  `id_kelas` bigint(20) UNSIGNED DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama`, `jk`, `tempat_lahir`, `tgl_lahir`, `agama`, `kode_jurusan`, `id_kelas`, `id_user`) VALUES
(1, '1819073', 'AANG SIDKI', 'L', 'Serang', '2007-10-24', 'Islam', 'TO', 8, 6),
(2, '1819046', 'EZA PRAYOGA', 'L', 'Serang', '2007-04-12', 'Islam', 'TO', 1, 7),
(3, '1920167', 'DIKI PERMANA', 'L', 'Serang', '2007-09-12', 'Islam', 'TO', 5, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.svg',
  `role` enum('admin','staff','kepala','siswa','guru') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `email`, `email_verified_at`, `password`, `image`, `role`, `aktif`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@email.com', NULL, '$2y$10$gl2nnngNk1FfJIjYrcoLduGqC0U5LS4FDb/vGELoDOMpMJ1BZ9kaO', 'default.svg', 'admin', 1, NULL, '2021-08-21 00:29:39', '2021-08-21 00:29:39'),
(2, 'staff@email.com', NULL, '$2y$10$r3219t4awSPepmUyCSGomOZtSyV0Sj6nkm9iiS7Vrq6558dLbGSEq', 'default.svg', 'staff', 1, NULL, '2021-08-21 00:29:39', '2021-08-21 00:29:39'),
(3, 'kepala_lab@email.com', NULL, '$2y$10$BeFVWhet3EyZeDyvnLn0oeH1cWOte4dT2J3EO0FhQA4BU8z8.0Myu', 'default.svg', 'kepala', 1, NULL, '2021-08-21 00:29:39', '2021-08-21 00:29:39'),
(4, 'eddy@gmail.com', NULL, '$2y$10$GAwV6gmrQf8jNbTsu/DPVex4oNAIpa8YQy6VKlzun9raHriqytzge', 'default.svg', 'guru', 1, NULL, '2021-08-21 00:29:53', '2021-08-21 01:27:54'),
(5, 'dedepratama177@gmail.com', NULL, '$2y$10$U8rErH9zvghEGDAdm9knVuHi8fzRMVau71ORzaeTVtTMkwtPPG5Rm', 'default.svg', 'staff', 1, NULL, '2021-08-21 00:57:27', '2021-08-21 00:57:42'),
(6, 'aang@gmail.com', NULL, '$2y$10$gl2nnngNk1FfJIjYrcoLduGqC0U5LS4FDb/vGELoDOMpMJ1BZ9kaO', 'default.svg', 'siswa', 1, NULL, '2021-08-21 01:32:38', '2021-08-21 01:32:38'),
(7, 'eza@gmail.com', NULL, '$2y$10$CxzISpVAMm28vJxQu4KNXefLEH19A96Gkb9ip3BGFw0jACDCsKhcS', 'default.svg', 'siswa', 1, NULL, '2021-08-21 01:57:33', '2021-08-21 01:57:46'),
(8, 'diki@gmail.com', NULL, '$2y$10$vB3.MF.tm8/ShsWXpWDNF.Szz7WtIzlfGHgooq7u8SPG9MrRfRQGC', 'default.svg', 'siswa', 1, NULL, '2021-08-21 01:59:42', '2021-08-21 01:59:42'),
(9, 'dede@gmail.com', NULL, '$2y$10$AIX931iI/TluoNBco2q3NOTY4R7YiXrQan0.As8pFk69guvPWdzk6', 'default.svg', 'guru', 1, NULL, '2021-08-22 11:32:19', '2021-08-22 11:32:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`),
  ADD KEY `id_rak` (`id_rak`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `jadwal_praktek`
--
ALTER TABLE `jadwal_praktek`
  ADD PRIMARY KEY (`id_jadwal_praktek`),
  ADD KEY `kode_mapel` (`id_mapel`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `kode_jurusan` (`kode_jurusan`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`no_peminjaman`),
  ADD KEY `id_jadwal_praktek` (`id_jadwal_praktek`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_status` (`kode_status`);

--
-- Indeks untuk tabel `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  ADD PRIMARY KEY (`id_peminjaman_detail`),
  ADD KEY `id_peminjaman` (`no_peminjaman`),
  ADD KEY `id_alat` (`id_alat`),
  ADD KEY `no_peminjaman` (`no_peminjaman`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `no_peminjaman` (`no_peminjaman`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indeks untuk tabel `pengembalian_detail`
--
ALTER TABLE `pengembalian_detail`
  ADD PRIMARY KEY (`id_pengembalian_detail`),
  ADD KEY `id_pengembalian` (`id_pengembalian`),
  ADD KEY `id_alat` (`id_alat`),
  ADD KEY `kode_kondisi` (`kode_kondisi`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indeks untuk tabel `ref_jurusan`
--
ALTER TABLE `ref_jurusan`
  ADD PRIMARY KEY (`kode_jurusan`);

--
-- Indeks untuk tabel `ref_kondisi`
--
ALTER TABLE `ref_kondisi`
  ADD PRIMARY KEY (`kode_kondisi`);

--
-- Indeks untuk tabel `ref_status`
--
ALTER TABLE `ref_status`
  ADD PRIMARY KEY (`kode_status`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_jurusan` (`kode_jurusan`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alat`
--
ALTER TABLE `alat`
  MODIFY `id_alat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jadwal_praktek`
--
ALTER TABLE `jadwal_praktek`
  MODIFY `id_jadwal_praktek` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  MODIFY `id_peminjaman_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pengembalian_detail`
--
ALTER TABLE `pengembalian_detail`
  MODIFY `id_pengembalian_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `alat_rak` FOREIGN KEY (`id_rak`) REFERENCES `rak` (`id_rak`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `user_guru` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal_praktek`
--
ALTER TABLE `jadwal_praktek`
  ADD CONSTRAINT `jadwal_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `jadwal_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `jadwal_mapel` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_jurusan` FOREIGN KEY (`kode_jurusan`) REFERENCES `ref_jurusan` (`kode_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `peminjaman_jadwal` FOREIGN KEY (`id_jadwal_praktek`) REFERENCES `jadwal_praktek` (`id_jadwal_praktek`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_petugas` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `peminjaman_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `peminjaman_status` FOREIGN KEY (`kode_status`) REFERENCES `ref_status` (`kode_status`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  ADD CONSTRAINT `detail_alat` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detail_peminjaman` FOREIGN KEY (`no_peminjaman`) REFERENCES `peminjaman` (`no_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_peminjaman` FOREIGN KEY (`no_peminjaman`) REFERENCES `peminjaman` (`no_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengembalian_petugas` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `pengembalian_detail`
--
ALTER TABLE `pengembalian_detail`
  ADD CONSTRAINT `pengembalian_detail` FOREIGN KEY (`id_pengembalian`) REFERENCES `pengembalian` (`id_pengembalian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengembalian_detail_alat` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pengembalian_kondisi` FOREIGN KEY (`kode_kondisi`) REFERENCES `ref_kondisi` (`kode_kondisi`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_jurusan` FOREIGN KEY (`kode_jurusan`) REFERENCES `ref_jurusan` (`kode_jurusan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `siswa_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `siswa_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
