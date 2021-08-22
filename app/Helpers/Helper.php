<?php

use App\Models\Peminjaman;

if (!function_exists('peminjaman_baru')) {
    function peminjaman_baru()
    {
        $peminjaman_baru = Peminjaman::where('kode_status', 0)->count();
        return $peminjaman_baru;
    }
}

if (!function_exists('sudah_konfirmasi')) {
    function sudah_konfirmasi()
    {
        $sudah_konfirmasi = Peminjaman::where('kode_status', 1)->count();
        return $sudah_konfirmasi;
    }
}

if (!function_exists('sudah_acc')) {
    function sudah_acc()
    {
        $sudah_acc = Peminjaman::where('kode_status', 2)->count();
        return $sudah_acc;
    }
}

if (!function_exists('diterima')) {
    function diterima()
    {
        $diterima = Peminjaman::where('kode_status', 3)->count();
        return $diterima;
    }
}

// Siswa
if (!function_exists('terima_alat')) {
    function terima_alat()
    {
        $terima_alat = Peminjaman::where('kode_status', 2)->where('id_siswa', auth()->user()->siswa->id_siswa)->count();
        return $terima_alat;
    }
}

// Guru
if (!function_exists('acc_peminjaman')) {
    function acc_peminjaman()
    {
        $acc_peminjaman = Peminjaman::where('kode_status', 1)->where('id_guru', auth()->user()->guru->id_guru)->count();
        return $acc_peminjaman;
    }
}
