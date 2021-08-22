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
                        <a href="{{ route('jadwal-praktek.index') }}" class="btn btn-danger float-sm-right">Kembali</a>
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
                                <h3 class="card-title">Form Jadwal Praktek</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('jadwal-praktek.update', $jadwal_praktek) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="id_mapel"><code>Mata Pelajaran</code></label>
                                        <select name="id_mapel" id="id_mapel"
                                            class="form-control rounded-0 @error('id_mapel') is-invalid @enderror">
                                            <option value="" selected></option>
                                            @foreach ($data_mapel as $mapel)
                                                <option value="{{ $mapel->id_mapel }}"
                                                    {{ $jadwal_praktek->id_mapel == $mapel->id_mapel ? 'selected' : '' }}>
                                                    {{ $mapel->mata_pelajaran }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_mapel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="id_guru"><code>Guru</code></label>
                                        <select name="id_guru" id="id_guru"
                                            class="form-control rounded-0 @error('id_guru') is-invalid @enderror">
                                            <option value="" selected></option>
                                            @foreach ($data_guru as $guru)
                                                <option value="{{ $guru->id_guru }}"
                                                    {{ $jadwal_praktek->id_guru == $guru->id_guru ? 'selected' : '' }}>
                                                    {{ $guru->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_guru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="id_kelas"><code>Kelas</code></label>
                                        <select name="id_kelas" id="id_kelas"
                                            class="form-control rounded-0 @error('id_kelas') is-invalid @enderror">
                                            <option value="" selected></option>
                                            @foreach ($data_kelas as $kelas)
                                                <option value="{{ $kelas->id_kelas }}"
                                                    {{ $jadwal_praktek->id_kelas == $kelas->id_kelas ? 'selected' : '' }}>
                                                    {{ $kelas->kelas }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_kelas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="hari"><code>Hari</code></label>
                                        <select name="hari" id="hari"
                                            class="form-control rounded-0 @error('hari') is-invalid @enderror">
                                            <option value="" selected></option>
                                            <option value="Minggu"
                                                {{ $jadwal_praktek->hari == 'Minggu' ? 'selected' : '' }}>Minggu
                                            </option>
                                            <option value="Senin"
                                                {{ $jadwal_praktek->hari == 'Senin' ? 'selected' : '' }}>Senin
                                            </option>
                                            <option value="Selasa"
                                                {{ $jadwal_praktek->hari == 'Selasa' ? 'selected' : '' }}>Selasa
                                            </option>
                                            <option value="Rabu" {{ $jadwal_praktek->hari == 'Rabu' ? 'selected' : '' }}>
                                                Rabu
                                            </option>
                                            <option value="Kamis"
                                                {{ $jadwal_praktek->hari == 'Kamis' ? 'selected' : '' }}>Kamis
                                            </option>
                                            <option value="Jumat"
                                                {{ $jadwal_praktek->hari == 'Jumat' ? 'selected' : '' }}>Jumat
                                            </option>
                                            <option value="Sabtu"
                                                {{ $jadwal_praktek->hari == 'Sabtu' ? 'selected' : '' }}>Sabtu
                                            </option>
                                        </select>
                                        @error('hari')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_mulai"><code>Jam Mulai</code></label>
                                        <input name="jam_mulai" type="time"
                                            class="form-control rounded-0 @error('jam_mulai') is-invalid @enderror"
                                            id="jam_mulai" value="{{ $jadwal_praktek->jam_mulai }}">
                                        @error('jam_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_selesai"><code>Jam Selesai</code></label>
                                        <input name="jam_selesai" type="time"
                                            class="form-control rounded-0 @error('jam_selesai') is-invalid @enderror"
                                            id="jam_selesai" value="{{ $jadwal_praktek->jam_selesai }}">
                                        @error('jam_selesai')
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
