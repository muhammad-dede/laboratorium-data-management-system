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
                        <a href="{{ route('mapel.index') }}" class="btn btn-danger float-sm-right">Kembali</a>
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
                                <h3 class="card-title">Form Mata Pelajaran</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('mapel.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="singkatan"><code>Singakatan</code></label>
                                        <input name="singkatan" type="text"
                                            class="form-control rounded-0 @error('singkatan') is-invalid @enderror"
                                            id="singkatan" value="{{ old('singkatan') }}">
                                        @error('singkatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="mata_pelajaran"><code>Mata Pelajaran</code></label>
                                        <input name="mata_pelajaran" type="text"
                                            class="form-control rounded-0 @error('mata_pelajaran') is-invalid @enderror"
                                            id="mata_pelajaran" value="{{ old('mata_pelajaran') }}">
                                        @error('mata_pelajaran')
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
