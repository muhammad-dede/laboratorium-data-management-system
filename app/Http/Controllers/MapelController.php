<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Ref_Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Mata Pelajaran',
            'menu' => 'mapel',
            'sub_menu' => 'mapel',
            'data_mapel' => Mapel::orderBy('id_mapel')->get(),
        ];

        return view('app.mapel.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Mata Pelajaran',
            'menu' => 'mapel',
            'sub_menu' => 'mapel',
        ];

        return view('app.mapel.create', $data);
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
            'singkatan' => 'required|unique:mapel,singkatan|max:20',
            'mata_pelajaran' => 'required',
        ]);

        Mapel::create([
            'singkatan' => $request->singkatan,
            'mata_pelajaran' => ucwords($request->mata_pelajaran),
        ]);

        return redirect()->route('mapel.index')->with('toast_success', 'Berhasil Menambahkan Mata Pelajaran');
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
    public function edit($id_mapel)
    {
        $mapel = Mapel::where('id_mapel', $id_mapel)->first();

        $data = [
            'title' => 'Edit Mata Pelajaran',
            'menu' => 'mapel',
            'sub_menu' => 'mapel',
            'mapel' => $mapel,
        ];

        return view('app.mapel.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_mapel)
    {
        $request->validate([
            'singkatan' => 'required|max:20|unique:mapel,singkatan,' . $id_mapel . ',id_mapel',
            'mata_pelajaran' => 'required',
        ]);

        Mapel::where('id_mapel', $id_mapel)->update([
            'singkatan' => $request->singkatan,
            'mata_pelajaran' => ucwords($request->mata_pelajaran),
        ]);

        return redirect()->route('mapel.index')->with('toast_success', 'Berhasil Mengubah Mata Pelajaran');
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
