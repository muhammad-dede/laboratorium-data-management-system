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
                        <a href="{{ route('kelas.index') }}" class="btn btn-danger float-sm-right">Kembali</a>
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
                                <h3 class="card-title">Form Kelas</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('kelas.update', $kelas) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="kode_jurusan"><code>Jurusan</code></label>
                                        <select name="kode_jurusan" id="kode_jurusan"
                                            class="form-control rounded-0 @error('kode_jurusan') is-invalid @enderror">
                                            <option value="" selected></option>
                                            @foreach ($data_jurusan as $jurusan)
                                                <option value="{{ $jurusan->kode_jurusan }}"
                                                    {{ $jurusan->kode_jurusan == $kelas->kode_jurusan ? 'selected' : '' }}>
                                                    {{ $jurusan->kompetensi }} - {{ $jurusan->kode_jurusan }}</option>
                                            @endforeach
                                        </select>
                                        @error('kode_jurusan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="romawi"><code>Kelas</code></label>
                                        <select name="romawi" id="romawi"
                                            class="form-control rounded-0 @error('romawi') is-invalid @enderror">
                                            <option value="" selected></option>
                                            <option value="X" {{ $kelas->romawi == 'X' ? 'selected' : '' }}>X - (10)
                                            </option>
                                            <option value="XI" {{ $kelas->romawi == 'XI' ? 'selected' : '' }}>XI - (11)
                                            </option>
                                            <option value="XII" {{ $kelas->romawi == 'XII' ? 'selected' : '' }}>XII -
                                                (12)
                                            </option>
                                        </select>
                                        @error('romawi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="grade"><code>Grade Kelas</code></label>
                                        <select name="grade" id="grade"
                                            class="form-control rounded-0 @error('grade') is-invalid @enderror">
                                            <option value="" selected></option>
                                            <option value="1" {{ $kelas->grade == '1' ? 'selected' : '' }}>1
                                            </option>
                                            <option value="2" {{ $kelas->grade == '2' ? 'selected' : '' }}>2
                                            </option>
                                            <option value="3" {{ $kelas->grade == '3' ? 'selected' : '' }}>3
                                            </option>
                                        </select>
                                        @error('grade')
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
