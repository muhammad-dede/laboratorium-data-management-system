<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PeminjamanExport implements FromView
{
    protected $from_date, $to_date;

    function __construct($from_date, $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function view(): View
    {
        return view('app.laporan.excel', [
            'data_peminjaman' => Peminjaman::whereBetween('tgl_peminjaman', [$this->from_date, $this->to_date])->get(),
        ]);
    }
}
