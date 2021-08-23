<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Rak;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Alat Laboratorium',
            'menu' => 'alat',
            'sub_menu' => 'alat',
            'data_alat' => Alat::orderBy('id_alat', 'desc')->get(),
        ];

        return view('app.alat.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => ' Tambah Alat Laboratorium',
            'menu' => 'alat',
            'sub_menu' => 'alat',
            'data_rak' => Rak::all(),
        ];

        return view('app.alat.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:alat,kode',
            'alat' => 'required',
            'satuan' => 'required',
            'stok' => 'required|numeric',
            'id_rak' => 'required',
        ]);

        Alat::create([
            'kode' => $request->kode,
            'alat' => ucwords($request->alat),
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'hilang' => 0,
            'rusak' => 0,
            'id_rak' => $request->id_rak,
        ]);

        return redirect()->route('alat.index')->with('toast_success', 'Berhasil Menambahkan Alat Laboratorium');
    }

    public function show(Alat $alat)
    {
        return view('app.alat.show', [
            'alat' => $alat,
        ]);
    }

    public function edit($id_alat)
    {
        $data = [
            'title' => ' Ubah Alat Laboratorium',
            'menu' => 'alat',
            'sub_menu' => 'alat',
            'data_rak' => Rak::all(),
            'alat' => Alat::where('id_alat', $id_alat)->first(),
        ];

        return view('app.alat.edit', $data);
    }

    public function update(Request $request, $id_alat)
    {
        $request->validate([
            'kode' => 'required|unique:alat,kode, ' . $id_alat . ',id_alat',
            'alat' => 'required',
            'satuan' => 'required',
            'stok' => 'required|numeric',
            'id_rak' => 'required',
        ]);

        Alat::where('id_alat', $id_alat)->update([
            'kode' => $request->kode,
            'alat' => ucwords($request->alat),
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'id_rak' => $request->id_rak,
        ]);

        return redirect()->route('alat.index')->with('toast_success', 'Berhasil Mengubah Alat Laboratorium');
    }

    public function destroy($id)
    {
        //
    }
}
