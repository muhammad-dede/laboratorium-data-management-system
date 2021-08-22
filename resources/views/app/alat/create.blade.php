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
                        <a href="{{ route('alat.index') }}" class="btn btn-danger float-sm-right">Kembali</a>
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
                                <h3 class="card-title">Form Alat</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('alat.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="kode"><code>Kode</code></label>
                                        <input name="kode" type="text"
                                            class="form-control rounded-0 @error('kode') is-invalid @enderror" id="kode"
                                            value="{{ old('kode') }}">
                                        @error('kode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="alat"><code>Nama Alat</code></label>
                                        <input name="alat" type="text"
                                            class="form-control rounded-0 @error('alat') is-invalid @enderror" id="alat"
                                            value="{{ old('alat') }}">
                                        @error('alat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="satuan"><code>Satuan</code></label>
                                        <select name="satuan" id="satuan"
                                            class="form-control rounded-0 @error('satuan') is-invalid @enderror">
                                            <option value="" selected></option>
                                            <option value="PCS" {{ old('satuan') == 'PCS' ? 'selected' : '' }}>
                                                PCS</option>
                                            <option value="SET" {{ old('satuan') == 'SET' ? 'selected' : '' }}>
                                                SET</option>
                                            <option value="UNIT" {{ old('satuan') == 'UNIT' ? 'selected' : '' }}>
                                                UNIT</option>
                                        </select>
                                        @error('satuan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="stok"><code>Stok</code></label>
                                        <input name="stok" type="number"
                                            class="form-control rounded-0 @error('stok') is-invalid @enderror" id="stok"
                                            value="{{ old('stok') }}">
                                        @error('stok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="id_rak"><code>Rak</code></label>
                                        <select name="id_rak" id="id_rak"
                                            class="form-control rounded-0 @error('id_rak') is-invalid @enderror">
                                            <option value="" selected></option>
                                            @foreach ($data_rak as $rak)
                                                <option value="{{ $rak->id_rak }}"
                                                    {{ old('id_rak') == $rak->id_rak ? 'selected' : '' }}>
                                                    {{ $rak->rak }} - {{ $rak->lokasi }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_rak')
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
