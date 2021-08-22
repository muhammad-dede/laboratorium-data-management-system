@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('siswa.index') }}" class="btn btn-danger float-sm-right">Kembali</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Form Siswa</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('siswa.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nis"><code>NIS</code></label>
                                        <input name="nis" type="text"
                                            class="form-control rounded-0 @error('nis') is-invalid @enderror" id="nis"
                                            value="{{ old('nis') }}">
                                        @error('nis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nama"><code>Nama</code></label>
                                        <input name="nama" type="text"
                                            class="form-control rounded-0 @error('nama') is-invalid @enderror" id="nama"
                                            value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="jk"><code>Jenis Kelamin</code></label>
                                        <select name="jk" id="jk"
                                            class="form-control rounded-0 @error('jk') is-invalid @enderror">
                                            <option value="" selected></option>
                                            <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_lahir"><code>Tempat Lahir</code></label>
                                        <input name="tempat_lahir" type="text"
                                            class="form-control rounded-0 @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" value="{{ old('tempat_lahir') }}">
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_lahir"><code>Tanggal Lahir</code></label>
                                        <input name="tgl_lahir" type="date"
                                            class="form-control rounded-0 @error('tgl_lahir') is-invalid @enderror"
                                            id="tgl_lahir" value="{{ old('tgl_lahir') }}">
                                        @error('tgl_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="agama"><code>Agama</code></label>
                                        <select name="agama" id="agama"
                                            class="form-control rounded-0 @error('agama') is-invalid @enderror">
                                            <option value="" selected></option>
                                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>
                                                Islam</option>
                                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>
                                                Kristen</option>
                                            <option value="Katholik" {{ old('agama') == 'Katholik' ? 'selected' : '' }}>
                                                Katholik</option>
                                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>
                                                Hindu</option>
                                            <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>
                                                Budha</option>
                                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>
                                                Konghucu</option>
                                            <option value="Lainnya" {{ old('agama') == 'Lainnya' ? 'selected' : '' }}>
                                                Lainnya</option>
                                        </select>
                                        @error('agama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_jurusan"><code>Jurusan</code></label>
                                        <select name="kode_jurusan" id="kode_jurusan"
                                            class="form-control rounded-0 @error('kode_jurusan') is-invalid @enderror">
                                            <option value="" selected></option>
                                            @forelse ($data_jurusan as $jurusan)
                                                <option value="{{ $jurusan->kode_jurusan }}"
                                                    {{ old('kode_jurusan') == $jurusan->kode_jurusan ? 'selected' : '' }}>
                                                    {{ $jurusan->jurusan }} - {{ $jurusan->kompetensi }}</option>
                                            @empty
                                                <option value=""></option>
                                            @endforelse
                                        </select>
                                        @error('kode_jurusan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="id_kelas"><code>Kelas</code></label>
                                        <select name="id_kelas" id="id_kelas"
                                            class="form-control rounded-0 @error('id_kelas') is-invalid @enderror">
                                            <option value="" selected></option>
                                            @forelse ($data_kelas as $kelas)
                                                <option value="{{ $kelas->id_kelas }}"
                                                    {{ old('id_kelas') == $kelas->id_kelas ? 'selected' : '' }}>
                                                    {{ $kelas->kelas }}</option>
                                            @empty
                                                <option value=""></option>
                                            @endforelse
                                        </select>
                                        @error('id_kelas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email"><code>Email</code></label>
                                        <input name="email" type="email"
                                            class="form-control rounded-0 @error('email') is-invalid @enderror" id="email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary rounded-0">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
