<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan',
            'menu' => 'laporan',
            'sub_menu' => 'laporan',
        ];

        return view('app.laporan.index', $data);
    }
}
