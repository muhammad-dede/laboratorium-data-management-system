<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Alat;
use App\Models\JadwalPraktek;
use App\Models\Notifikasi;
use App\Models\Peminjaman;
use App\Models\Peminjaman_Detail;
use App\Models\Siswa;
use Livewire\Component;

class PeminjamanCreate extends Component
{
    public $data_jadwal_praktek, $data_alat, $data_siswa;
    public $id_jadwal_praktek;

    public $id_alat, $qty;
    public $peminjaman_detail;

    public function mount()
    {
        $this->data_jadwal_praktek = JadwalPraktek::where('id_kelas', auth()->user()->siswa->id_kelas)->get();
        $this->data_siswa = null;

        $this->data_alat = Alat::all();
        $this->peminjaman_detail = [];
    }

    public function render()
    {
        return view('livewire.siswa.peminjaman-create');
    }

    public function tambah()
    {
        $this->validate([
            'id_alat' => 'required',
            'qty' => 'required|numeric',
        ]);

        foreach ($this->peminjaman_detail as $detail) {
            if ($detail['id_alat'] == $this->id_alat) {
                return session()->flash('error_alat', 'Alat sudah ada di list.');
            }
        }

        $alat = Alat::where('id_alat', $this->id_alat)->first();

        if ($this->qty > $alat->stok) {
            return session()->flash('error_alat', 'Stok alat tidak cukup');
        }

        $this->peminjaman_detail[] = [
            'id_alat' => $alat->id_alat,
            'alat' => $alat->alat,
            'qty' => $this->qty,
        ];

        $this->id_alat = null;
        $this->qty = null;
    }

    public function hapus($index)
    {
        unset($this->peminjaman_detail[$index]);
        $this->peminjaman_detail = array_values($this->peminjaman_detail);
    }

    public function simpan()
    {
        $this->validate([
            'id_jadwal_praktek' => 'required',
        ]);

        if ($this->peminjaman_detail == []) {
            return session()->flash('error_peminjaman', 'Pilih Alat Yang Ingin Dipinjam.');
        }

        $jadwal_praktek = JadwalPraktek::where('id_jadwal_praktek', $this->id_jadwal_praktek)->first();

        // No Peminjaman
        $no_peminjaman = time();

        Peminjaman::create([
            'no_peminjaman' => $no_peminjaman,
            'id_jadwal_praktek' => $jadwal_praktek->id_jadwal_praktek,
            'id_siswa' => auth()->user()->siswa->id_siswa,
            'id_guru' => $jadwal_praktek->id_guru,
            'kode_status' => "0",
        ]);

        foreach ($this->peminjaman_detail as $detail) {
            Peminjaman_Detail::create([
                'no_peminjaman' => $no_peminjaman,
                'id_alat' => $detail['id_alat'],
                'qty' => $detail['qty'],
            ]);
        }

        session()->flash('toast_success', 'Berhasil Menambahkan Peminjaman');
        return redirect()->route('siswa.peminjaman.index');
    }
}
