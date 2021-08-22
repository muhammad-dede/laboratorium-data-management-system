<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Ref_Jurusan;
use App\Models\Ref_Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Siswa',
            'menu' => 'siswa',
            'sub_menu' => 'siswa',
            'data_siswa' => Siswa::all(),
        ];

        return view('app.siswa.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Siswa',
            'menu' => 'siswa',
            'sub_menu' => 'siswa',
            'data_jurusan' => Ref_Jurusan::all(),
            'data_kelas' => Kelas::all(),
        ];

        return view('app.siswa.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric',
            'nama' => 'required',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'kode_jurusan' => 'required',
            'id_kelas' => 'required',
            'email' => 'required|email|unique:user,email',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->nip),
            'image' => 'default.svg',
            'role' => 'siswa',
            'aktif' => true,
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nama' => ucwords($request->nama),
            'jk' => $request->jk,
            'tempat_lahir' => ucwords($request->tempat_lahir),
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'kode_jurusan' => $request->kode_jurusan,
            'id_kelas' => $request->id_kelas,
            'id_user' => $user->id,
        ]);

        return redirect()->route('siswa.index')->with('toast_success', 'Berhasil Menambahkan Data Siswa');
    }

    public function show($id)
    {
        //
    }

    public function edit($id_siswa)
    {
        $siswa = Siswa::where('id_siswa', $id_siswa)->first();
        $data = [
            'title' => 'Ubah Siswa',
            'menu' => 'siswa',
            'sub_menu' => 'siswa',
            'data_jurusan' => Ref_Jurusan::all(),
            'data_kelas' => Kelas::all(),
            'siswa' => $siswa,
        ];

        return view('app.siswa.edit', $data);
    }

    public function update(Request $request, $id_siswa)
    {
        $siswa = Siswa::where('id_siswa', $id_siswa)->first();
        $request->validate([
            'nis' => 'required|numeric',
            'nama' => 'required',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'kode_jurusan' => 'required',
            'id_kelas' => 'required',
            'email' => 'required|email|unique:user,email,' . $siswa->id_user . ',id',
        ]);

        if ($request->password !== null) {
            $request->validate([
                'password' => 'required|min:8',
            ]);

            User::where('id', $siswa->id_user)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        User::where('id', $siswa->id_user)->update([
            'email' => $request->email,
            'image' => 'default.svg',
            'role' => 'siswa',
            'aktif' => true,
        ]);

        Siswa::where('id_siswa', $id_siswa)->update([
            'nis' => $request->nis,
            'nama' => ucwords($request->nama),
            'jk' => $request->jk,
            'tempat_lahir' => ucwords($request->tempat_lahir),
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'kode_jurusan' => $request->kode_jurusan,
            'id_kelas' => $request->id_kelas,
            'id_user' => $siswa->id_user,
        ]);

        return redirect()->route('siswa.index')->with('toast_success', 'Berhasil Mengubah Data Siswa');
    }

    public function destroy($id)
    {
        //
    }
}
