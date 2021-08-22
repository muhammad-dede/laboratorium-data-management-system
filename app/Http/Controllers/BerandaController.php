<?php

namespace App\Http\Controllers;

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
        ];
        return view('app/beranda/index', $data);
    }
}
