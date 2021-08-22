<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Ref_Jurusan;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Kelas',
            'menu' => 'kelas',
            'sub_menu' => 'kelas',
            'data_kelas' => Kelas::all(),
        ];

        return view('app.kelas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Kelas',
            'menu' => 'kelas',
            'sub_menu' => 'kelas',
            'data_jurusan' => Ref_Jurusan::all(),
        ];

        return view('app.kelas.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_jurusan' => 'required',
            'romawi' => 'required',
            'grade' => 'required|unique:kelas,grade,NULL,id_kelas,kode_jurusan,' . $request->kode_jurusan . ',romawi,' . $request->romawi,
        ]);

        Kelas::create([
            'kode_jurusan' => $request->kode_jurusan,
            'romawi' => $request->romawi,
            'grade' => $request->grade,
            'kelas' => $request->romawi . ' ' . $request->kode_jurusan . ' ' . $request->grade,
        ]);

        return redirect()->route('kelas.index')->with('toast_success', 'Berhasil Menambahkan Data Kelas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kelas)
    {
        $kelas = Kelas::where('id_kelas', $id_kelas)->first();
        $data = [
            'title' => 'Ubah Kelas',
            'menu' => 'kelas',
            'sub_menu' => 'kelas',
            'data_jurusan' => Ref_Jurusan::all(),
            'kelas' => $kelas,
        ];

        return view('app.kelas.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kelas)
    {
        $request->validate([
            'kode_jurusan' => 'required',
            'romawi' => 'required',
            'grade' => 'required|unique:kelas,grade,' . $id_kelas . ',id_kelas,kode_jurusan,' . $request->kode_jurusan . ',romawi,' . $request->romawi,
        ]);

        Kelas::where('id_kelas', $id_kelas)->update([
            'kode_jurusan' => $request->kode_jurusan,
            'romawi' => $request->romawi,
            'grade' => $request->grade,
            'kelas' => $request->romawi . ' ' . $request->kode_jurusan . ' ' . $request->grade,
        ]);

        return redirect()->route('kelas.index')->with('toast_success', 'Berhasil Mengubah Data Kelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
