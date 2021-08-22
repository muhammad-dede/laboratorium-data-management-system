<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\JadwalPraktek;
use App\Models\Kelas;
use App\Models\Peminjaman;
use App\Models\Ref_Jurusan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class MenuGuruController extends Controller
{
    public function beranda()
    {
        $data = [
            'title' => 'Beranda',
            'menu' => 'beranda',
            'sub_menu' => 'beranda',
            'total_jadwal' => JadwalPraktek::where('id_guru', auth()->user()->guru->id_guru)->count(),
            'total_peminjaman' => Peminjaman::where('id_guru', auth()->user()->guru->id_guru)->where('kode_status', '!=', 4)->count(),
            'total_riwayat' => Peminjaman::where('id_guru', auth()->user()->guru->id_guru)->where('kode_status', '=', 4)->count(),
        ];
        return view('app.menu-guru.beranda', $data);
    }

    public function profil_create()
    {
        $data = [
            'title' => 'Profil Guru',
            'menu' => 'profil',
        ];

        return view('app.menu-guru.profil-create', $data);
    }

    public function profil_store(Request $request)
    {
        $request->validate([
            'nip' => 'required|numeric|unique:guru,nip',
            'nama' => 'required',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
        ]);

        Guru::create([
            'nip' => $request->nip,
            'nama' => ucwords($request->nama),
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'id_user' => auth()->id(),
        ]);

        return redirect()->route('guru.beranda')->with('toast_success', 'Berhasil Mendaftar');
    }

    public function jadwal()
    {
        $data = [
            'title' => 'Jadwal Praktek Guru',
            'menu' => 'jadwal',
            'sub_menu' => 'jadwal',
            'data_jadwal' => JadwalPraktek::where('id_guru', auth()->user()->guru->id_guru)->get(),
        ];

        return view('app.menu-guru.jadwal-index', $data);
    }

    public function jadwal_show(JadwalPraktek $jadwal_praktek)
    {
        $data = [
            'title' => 'Detail Jadwal Praktek Guru',
            'menu' => 'jadwal',
            'sub_menu' => 'jadwal',
            'jadwal' => $jadwal_praktek,
            'data_siswa' => Siswa::where('id_kelas', $jadwal_praktek->id_kelas)->get(),
        ];

        return view('app.menu-guru.jadwal-show', $data);
    }

    public function peminjaman()
    {
        $data = [
            'title' => 'Peminjaman Belum Di-ACC',
            'menu' => 'peminjaman',
            'sub_menu' => 'peminjaman',
            'data_peminjaman' => Peminjaman::where('id_guru', auth()->user()->guru->id_guru)->where('kode_status', '!=', 4)->get(),
        ];

        return view('app.menu-guru.peminjaman-index', $data);
    }

    public function peminjaman_show(Peminjaman $peminjaman)
    {
        $data = [
            'title' => 'Detail Peminjaman',
            'menu' => 'peminjaman',
            'sub_menu' => 'peminjaman',
            'peminjaman' => $peminjaman,
        ];

        return view('app.menu-guru.peminjaman-show', $data);
    }

    public function peminjaman_acc(Peminjaman $peminjaman)
    {
        Peminjaman::where('no_peminjaman', $peminjaman->no_peminjaman)->update([
            'kode_status' => 2,
        ]);

        return redirect()->route('guru.peminjaman.index')->with('toast_success', 'Peminjaman Telah Di-ACC');
    }

    public function riwayat()
    {
        $data = [
            'title' => 'Riwayat Peminjaman Alat Oleh Siswa',
            'menu' => 'riwayat',
            'sub_menu' => 'riwayat',
            'data_peminjaman' => Peminjaman::where('id_guru', auth()->user()->guru->id_guru)->where('kode_status', '=', 4)->get(),
        ];

        return view('app.menu-guru.riwayat-index', $data);
    }

    public function riwayat_show(Peminjaman $peminjaman)
    {
        $data = [
            'title' => 'Detail Riwayat Peminjaman',
            'menu' => 'riwayat',
            'sub_menu' => 'riwayat',
            'peminjaman' => $peminjaman,
        ];

        return view('app.menu-guru.riwayat-show', $data);
    }
}
