<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Peminjaman_Detail;
use App\Models\Pengembalian;
use App\Models\Pengembalian_Detail;
use App\Models\Ref_Kondisi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Peminjaman',
            'menu' => 'peminjaman',
            'sub_menu' => 'peminjaman',
            'data_peminjaman' => Peminjaman::orderBy('no_peminjaman', 'desc')->get(),
        ];

        return view('app.peminjaman.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Peminjaman',
            'menu' => 'peminjaman',
            'sub_menu' => 'peminjaman',
        ];

        return view('app.peminjaman.create', $data);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($no_peminjaman)
    {
        $cek_pengembalian = Pengembalian::where('no_peminjaman', $no_peminjaman);
        if ($cek_pengembalian->count() > 0) {
            foreach ($cek_pengembalian->first()->pengembalian_detail as $detail) {
                $qty = Peminjaman_Detail::where('no_peminjaman', $no_peminjaman)->where('id_alat', $detail->id_alat)->first()->qty;
                $peminjaman_detail[] = [
                    'id_alat' => $detail->id_alat,
                    'kode' => $detail->alat->kode,
                    'alat' => $detail->alat->alat,
                    'qty' => $qty,
                    'qty_kembali' => $detail->qty,
                    'kode_kondisi' => $detail->ref_kondisi->kondisi,
                ];
            }
        } else {
            foreach (Peminjaman_Detail::where('no_peminjaman', $no_peminjaman)->get() as $detail) {
                $peminjaman_detail[] = [
                    'id_alat' => $detail->id_alat,
                    'kode' => $detail->alat->kode,
                    'alat' => $detail->alat->alat,
                    'qty' => $detail->qty,
                    'qty_kembali' => $detail->qty,
                    'kode_kondisi' => null,
                ];
            }
        }

        $data = [
            'title' => 'Detail Peminjaman',
            'menu' => 'peminjaman',
            'sub_menu' => 'peminjaman',
            'peminjaman' => Peminjaman::where('no_peminjaman', $no_peminjaman)->first(),
            'peminjaman_detail' => $peminjaman_detail,
            'data_kondisi' => Ref_Kondisi::all(),
        ];

        return view('app.peminjaman.detail', $data);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $no_peminjaman)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function update_status(Request $request, $status, $no_peminjaman)
    {
        if ($status == 0) {
            Peminjaman::where('no_peminjaman', $no_peminjaman)->update([
                'kode_status' => 1,
                'id_petugas' => auth()->user()->petugas->id_petugas,
            ]);
            return redirect()->route('peminjaman.index')->with('toast_success', 'Berhasil Dikonfirmasi');
        } elseif ($status == 1) {
            Peminjaman::where('no_peminjaman', $no_peminjaman)->update([
                'kode_status' => 2,
                'id_petugas' => auth()->user()->petugas->id_petugas,
            ]);
            return redirect()->route('peminjaman.index')->with('toast_success', 'Berhasil Di-ACC');
        } elseif ($status == 2) {
            Peminjaman::where('no_peminjaman', $no_peminjaman)->update([
                'kode_status' => 3,
                'id_petugas' => auth()->user()->petugas->id_petugas,
            ]);

            $peminjaman_detail = Peminjaman_Detail::where('no_peminjaman', $no_peminjaman)->get();

            foreach ($peminjaman_detail as $detail) {
                $alat = Alat::where('id_alat', $detail->id_alat)->first();
                $alat->update([
                    'stok' => $alat->stok - $detail->qty,
                ]);
            }
            return redirect()->route('peminjaman.index')->with('toast_success', 'Alat Telah Diterima');
        } elseif ($status == 3) {
            // create Pengembalian
            $pengembalian = Pengembalian::create([
                'no_peminjaman' => $no_peminjaman,
                'id_petugas' => auth()->user()->petugas->id_petugas,
            ]);

            foreach ($request->peminjaman_detail as $detail) {
                Pengembalian_Detail::create([
                    'id_pengembalian' => $pengembalian->id_pengembalian,
                    'id_alat' => $detail['id_alat'],
                    'qty' => $detail['qty_kembali'],
                    'kode_kondisi' => $detail['kode_kondisi'],
                ]);
            }

            // update peminjaman
            Peminjaman::where('no_peminjaman', $no_peminjaman)->update([
                'kode_status' => 4,
                'id_petugas' => auth()->user()->petugas->id_petugas,
            ]);

            foreach ($request->peminjaman_detail as $detail) {

                if ($detail['kode_kondisi'] == 1) {
                    $hilang = 0;
                    $rusak = 0;
                } elseif ($detail['kode_kondisi'] == 2) {
                    $hilang = 0;
                    $rusak = $detail['qty'] - $detail['qty_kembali'];
                } elseif ($detail['kode_kondisi'] == 3) {
                    $hilang = $detail['qty'] - $detail['qty_kembali'];
                    $rusak = 0;
                }

                $alat = Alat::where(
                    'id_alat',
                    $detail['id_alat']
                )->first();
                $alat->update([
                    'stok' => $alat->stok + $detail['qty_kembali'],
                    'hilang' => $alat->hilang + $hilang,
                    'rusak' => $alat->rusak + $rusak,
                ]);
            }

            return redirect()->route('peminjaman.index')->with('toast_success', 'Berhasil Mengembalikan Alat');
        }
    }
}
