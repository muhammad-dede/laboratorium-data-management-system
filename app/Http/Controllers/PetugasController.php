<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Petugas',
            'menu' => 'petugas',
            'sub_menu' => 'petugas',
            'data_petugas' => Petugas::where('id_petugas', '!=', 1)->orderBy('id_petugas', 'desc')->get(),
        ];

        return view('app.petugas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Petugas',
            'menu' => 'petugas',
            'sub_menu' => 'petugas',
        ];

        return view('app.petugas.create', $data);
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
            'telp' => 'required',
            'jabatan' => 'required',
            'email' => 'required|email|unique:user,email',
            'role' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->nip),
            'image' => 'default.svg',
            'role' => $request->role,
            'aktif' => true,
        ]);

        Petugas::create([
            'nama' => ucfirst($request->nama),
            'nip' => $request->nip,
            'telp' => $request->telp,
            'jabatan' => $request->jabatan,
            'id_user' => $user->id,
        ]);

        return redirect()->route('petugas.index')->with('toast_success', 'Berhasil Menambahkan Petugas');
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
    public function edit($id)
    {
        $data = [
            'title' => 'Ubah Petugas',
            'menu' => 'petugas',
            'sub_menu' => 'petugas',
            'petugas' => Petugas::where('id_petugas', $id)->first(),
        ];

        return view('app.petugas.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $petugas = Petugas::where('id_petugas', $id)->first();

        $request->validate([
            'nama' => 'required|string',
            'nip' => 'required|numeric',
            'telp' => 'required',
            'jabatan' => 'required',
            'email' => 'required|email|unique:user,email,' . $petugas->id_user . ',id',
            'role' => 'required',
        ]);

        if ($request->password !== null) {
            $request->validate([
                'password' => 'required|min:8',
            ]);
            User::where('id', $petugas->id_user)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        User::where('id', $petugas->id_user)->update([
            'email' => $request->email,
            'image' => 'default.svg',
            'role' => $request->role,
            'aktif' => true,
        ]);

        Petugas::where('id_petugas', $id)->update([
            'nama' => ucfirst($request->nama),
            'nip' => $request->nip,
            'telp' => $request->telp,
            'jabatan' => $request->jabatan,
            'id_user' => $petugas->id_user,
        ]);

        return redirect()->route('petugas.index')->with('toast_success', 'Berhasil Mengubah Petugas');
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
