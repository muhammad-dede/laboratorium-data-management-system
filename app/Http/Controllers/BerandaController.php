<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\JadwalPraktek;
use App\Models\Peminjaman;
use App\Models\Siswa;
use Illuminate\Http\Request;

class BerandaController extends Controller
{

    public function index()
    {
        // Jika yang login bukan admin / petugas
        if (auth()->user()->role == 'siswa') {
            return redirect()->route('siswa.beranda');
        } elseif (auth()->user()->role == 'guru') {
            return redirect()->route('guru.beranda');
        }

        $data = [
            'title' => 'Beranda',
            'menu' => 'beranda',
            'sub_menu' => 'beranda',
            'total_proses_peminjaman' => Peminjaman::where('kode_status', '!=', 4)->count(),
            'total_peminjaman' => Peminjaman::where('kode_status', '=', 4)->count(),
            'total_siswa' => Siswa::count(),
            'total_guru' => Guru::count(),
        ];
        return view('app/beranda/index', $data);
    }
}
