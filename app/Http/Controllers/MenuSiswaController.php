<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\JadwalPraktek;
use App\Models\Kelas;
use App\Models\Peminjaman;
use App\Models\Peminjaman_Detail;
use App\Models\Ref_Jurusan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class MenuSiswaController extends Controller
{
    public function beranda()
    {
        $data = [
            'title' => 'Beranda',
            'menu' => 'beranda',
            'sub_menu' => 'beranda',
            'total_jadwal' => JadwalPraktek::where('id_kelas', auth()->user()->siswa->id_kelas)->count(),
            'total_peminjaman' => Peminjaman::where('id_siswa', auth()->user()->siswa->id_siswa)->where('kode_status', '!=', 4)->count(),
            'total_riwayat' => Peminjaman::where('id_siswa', auth()->user()->siswa->id_siswa)->where('kode_status', '=', 4)->count(),
        ];
        return view('app/menu-siswa/beranda', $data);
    }

    public function profil_create()
    {
        $data = [
            'title' => 'Profil Siswa',
            'menu' => 'profil',
            'sub_menu' => 'profil',
            'data_jurusan' => Ref_Jurusan::all(),
            'data_kelas' => Kelas::all(),
        ];

        return view('app.menu-siswa.profil-create', $data);
    }

    public function profil_store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis',
            'nama' => 'required',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'kode_jurusan' => 'required',
            'id_kelas' => 'required',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nama' => ucwords($request->nama),
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'kode_jurusan' => $request->kode_jurusan,
            'id_kelas' => $request->id_kelas,
            'id_user' => auth()->id(),
        ]);

        return redirect()->route('siswa.beranda')->with('toast_success', 'Berhasil Mendaftar');
    }

    public function jadwal()
    {
        $data = [
            'title' => 'Jadwal Praktek Siswa',
            'menu' => 'jadwal',
            'sub_menu' => 'jadwal',
            'data_jadwal' => JadwalPraktek::where('id_kelas', auth()->user()->siswa->id_kelas)->get(),
        ];

        return view('app.menu-siswa.jadwal-index', $data);
    }

    public function peminjaman()
    {
        $data = [
            'title' => 'Peminjaman',
            'menu' => 'peminjaman',
            'sub_menu' => 'peminjaman',
            'data_peminjaman' => Peminjaman::where('id_siswa', auth()->user()->siswa->id_siswa)->where('kode_status', '!=', 4)->get(),
        ];

        return view('app.menu-siswa.peminjaman-index', $data);
    }

    public function peminjaman_show(Peminjaman $peminjaman)
    {
        $data = [
            'title' => 'Detail Peminjaman',
            'menu' => 'peminjaman',
            'sub_menu' => 'peminjaman',
            'peminjaman' => $peminjaman,
        ];

        return view('app.menu-siswa.peminjaman-show', $data);
    }

    public function peminjaman_terima(Peminjaman $peminjaman)
    {
        Peminjaman::where('no_peminjaman', $peminjaman->no_peminjaman)->update([
            'kode_status' => 3,
        ]);

        $peminjaman_detail = Peminjaman_Detail::where('no_peminjaman', $peminjaman->no_peminjaman)->get();

        foreach ($peminjaman_detail as $detail) {
            $alat = Alat::where('id_alat', $detail->id_alat)->first();
            $alat->update([
                'stok' => $alat->stok - $detail->qty,
            ]);
        }
        return redirect()->route('siswa.peminjaman.index')->with('toast_success', 'Alat Telah Diterima');
    }

    public function peminjaman_create()
    {
        $data = [
            'title' => 'Pinjam Alat',
            'menu' => 'peminjaman',
            'sub_menu' => 'peminjaman',
        ];

        return view('app.menu-siswa.peminjaman-create', $data);
    }

    public function riwayat()
    {
        $data = [
            'title' => 'Riwayat Peminjaman',
            'menu' => 'riwayat',
            'sub_menu' => 'riwayat',
            'data_peminjaman' => Peminjaman::where('id_siswa', auth()->user()->siswa->id_siswa)->where('kode_status', 4)->get(),
        ];

        return view('app.menu-siswa.riwayat-index', $data);
    }

    public function riwayat_show(Peminjaman $peminjaman)
    {
        $data = [
            'title' => 'Detail Riwayat Peminjaman',
            'menu' => 'riwayat',
            'sub_menu' => 'riwayat',
            'peminjaman' => $peminjaman,
        ];

        return view('app.menu-siswa.riwayat-show', $data);
    }
}
