<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Guru',
            'menu' => 'guru',
            'sub_menu' => 'guru',
            'data_guru' => Guru::orderBy('id_guru', 'desc')->get(),
        ];

        return view('app.guru.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Guru',
            'menu' => 'guru',
            'sub_menu' => 'guru',
        ];

        return view('app.guru.create', $data);
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
            'nama' => 'required|string',
            'nip' => 'required|numeric',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'agama' => 'required',
            'email' => 'required|email|unique:user,email',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->nip),
            'image' => 'default.svg',
            'role' => 'guru',
            'aktif' => true,
        ]);

        Guru::create([
            'nama' => ucwords($request->nama),
            'nip' => $request->nip,
            'jk' => $request->jk,
            'tempat_lahir' => ucfirst($request->tempat_lahir),
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'id_user' => $user->id,
        ]);

        return redirect()->route('guru.index')->with('toast_success', 'Berhasil Menambahkan Data Guru');
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
    public function edit($id_guru)
    {
        $guru = Guru::where('id_guru', $id_guru)->first();
        $data = [
            'title' => 'Ubah Guru',
            'menu' => 'guru',
            'sub_menu' => 'guru',
            'guru' => $guru,
        ];

        return view('app.guru.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_guru)
    {
        $guru = Guru::where('id_guru', $id_guru)->first();
        $request->validate([
            'nama' => 'required|string',
            'nip' => 'required|numeric',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'agama' => 'required',
            'email' => 'required|email|unique:user,email,' . $guru->id_user . ',id',
        ]);

        if ($request->password !== null) {
            $request->validate([
                'password' => 'required|min:8',
            ]);

            User::where('id', $guru->id_user)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        User::where('id', $guru->id_user)->update([
            'email' => $request->email,
            'image' => 'default.svg',
            'role' => 'guru',
            'aktif' => true,
        ]);

        Guru::where('id_guru', $id_guru)->update([
            'nama' => ucfirst($request->nama),
            'nip' => $request->nip,
            'jk' => $request->jk,
            'tempat_lahir' => ucfirst($request->tempat_lahir),
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'id_user' => $guru->id_user,
        ]);

        return redirect()->route('guru.index')->with('toast_success', 'Berhasil Mengubah Data Guru');
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
