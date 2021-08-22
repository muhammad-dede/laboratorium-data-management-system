<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\JadwalPraktek;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Ref_Hari;
use App\Models\Ref_Jurusan;
use Illuminate\Http\Request;

class JadwalPraktekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Jadwal Praktek',
            'menu' => 'jadwal-praktek',
            'sub_menu' => 'jadwal-praktek',
            'data_jadwal_praktek' => JadwalPraktek::orderBy('id_kelas')->get(),
        ];

        return view('app.jadwal-praktek.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Jadwal Praktek',
            'menu' => 'jadwal-praktek',
            'sub_menu' => 'jadwal-praktek',
            'data_mapel' => Mapel::all(),
            'data_guru' => Guru::all(),
            'data_kelas' => Kelas::all(),
        ];

        return view('app.jadwal-praktek.create', $data);
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
            'id_mapel' => 'required|unique:jadwal_praktek,id_mapel,NULL,id_jadwal_praktek,id_guru,' . $request->id_guru . ',id_kelas,' . $request->id_kelas . ',hari,' . $request->hari,
            'id_guru' => 'required',
            'id_kelas' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalPraktek::create([
            'id_mapel' => $request->id_mapel,
            'id_guru' => $request->id_guru,
            'id_kelas' => $request->id_kelas,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwal-praktek.index')->with('toast_success', 'Berhasil Menambahkan Jadwal Praktek');
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
    public function edit($id_jadwal_praktek)
    {
        $jadwal_praktek = JadwalPraktek::where('id_jadwal_praktek', $id_jadwal_praktek)->first();
        $data = [
            'title' => 'Ubah Jadwal Praktek',
            'menu' => 'jadwal-praktek',
            'sub_menu' => 'jadwal-praktek',
            'data_mapel' => Mapel::all(),
            'data_guru' => Guru::all(),
            'data_jurusan' => Ref_Jurusan::all(),
            'data_kelas' => Kelas::all(),
            'jadwal_praktek' => $jadwal_praktek,
        ];

        return view('app.jadwal-praktek.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_jadwal_praktek)
    {
        $request->validate([
            'id_mapel' => 'required|unique:jadwal_praktek,id_mapel,' . $id_jadwal_praktek . ',id_jadwal_praktek,id_guru,' . $request->kode_jurusan . ',id_kelas,' . $request->id_kelas . ',hari,' . $request->hari,
            'id_guru' => 'required',
            'id_kelas' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalPraktek::where('id_jadwal_praktek', $id_jadwal_praktek)->update([
            'id_mapel' => $request->id_mapel,
            'id_guru' => $request->id_guru,
            'id_kelas' => $request->id_kelas,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwal-praktek.index')->with('toast_success', 'Berhasil Mengubah Jadwal Praktek');
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
