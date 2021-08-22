<?php

namespace App\Http\Livewire\Admin;

use App\Exports\PeminjamanExport;
use App\Models\JadwalPraktek;
use App\Models\Peminjaman;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Laporan extends Component
{
    public $data_peminjaman;
    public $from_date, $to_date;

    public function mount()
    {
        $this->id_jadwal_praktek = null;
        $this->from_date = date('Y-m-d');
        $this->to_date = date('Y-m-d');
        $this->data_peminjaman = Peminjaman::where('kode_status', 4)->whereBetween('tgl_peminjaman', [$this->from_date, $this->to_date])->get();
    }

    public function render()
    {
        return view('livewire.admin.laporan');
    }

    public function updatedFromDate()
    {
        $this->data_peminjaman = Peminjaman::where('kode_status', 4)->whereBetween('tgl_peminjaman', [$this->from_date, $this->to_date])->get();
    }

    public function updatedToDate()
    {
        $this->data_peminjaman = Peminjaman::where('kode_status', 4)->whereBetween('tgl_peminjaman', [$this->from_date, $this->to_date])->get();
    }

    public function export_excel()
    {

        return Excel::download(new PeminjamanExport($this->from_date, $this->to_date), 'Laporan-Peminjaman.xlsx');
    }
}
