<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Rak',
            'menu' => 'rak',
            'sub_menu' => 'rak',
            'data_rak' => Rak::orderBy('id_rak', 'desc')->get(),
        ];

        return view('app.rak.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Rak',
            'menu' => 'rak',
            'sub_menu' => 'rak',
        ];

        return view('app.rak.create', $data);
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
            'rak' => 'required',
            'lokasi' => 'required',
        ]);

        Rak::create([
            'rak' => $request->rak,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('rak.index')->with('toast_success', 'Berhasil Menambahkan Rak');
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
    public function edit($id_rak)
    {
        $data = [
            'title' => 'Ubah Rak',
            'menu' => 'rak',
            'sub_menu' => 'rak',
            'rak' => Rak::where('id_rak', $id_rak)->first(),
        ];

        return view('app.rak.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_rak)
    {
        $request->validate([
            'rak' => 'required',
            'lokasi' => 'required',
        ]);

        Rak::where('id_rak', $id_rak)->update([
            'rak' => $request->rak,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('rak.index')->with('toast_success', 'Berhasil Mengubah Rak');
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
