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
                        <a href="{{ route('petugas.index') }}" class="btn btn-danger float-sm-right">Kembali</a>
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
                                <h3 class="card-title">Form Petugas</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('petugas.update', $petugas) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="nama"><code>Nama</code></label>
                                        <input name="nama" type="text"
                                            class="form-control rounded-0 @error('nama') is-invalid @enderror" id="nama"
                                            value="{{ $petugas->nama ?? old('nama') }}">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nip"><code>NIP</code></label>
                                        <input name="nip" type="text"
                                            class="form-control rounded-0 @error('nip') is-invalid @enderror" id="nip"
                                            value="{{ $petugas->nip ?? old('nip') }}">
                                        @error('nip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="telp"><code>Telepon</code></label>
                                        <input name="telp" type="text"
                                            class="form-control rounded-0 @error('telp') is-invalid @enderror" id="telp"
                                            value="{{ $petugas->telp ?? old('telp') }}">
                                        @error('telp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan"><code>Jabatan</code></label>
                                        <select name="jabatan" id="jabatan"
                                            class="form-control rounded-0 @error('jabatan') is-invalid @enderror">
                                            <option value="" selected></option>
                                            <option value="Staff" {{ $petugas->jabatan == 'Staff' ? 'selected' : '' }}>
                                                Staff</option>
                                            <option value="Kepala Laboratorium"
                                                {{ $petugas->jabatan == 'Kepala Laboratorium' ? 'selected' : '' }}>
                                                Kepala Laboratorium</option>
                                        </select>
                                        @error('jabatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email"><code>Email</code></label>
                                        <input name="email" type="email"
                                            class="form-control rounded-0 @error('email') is-invalid @enderror" id="email"
                                            value="{{ $petugas->user->email ?? old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="role"><code>Role</code></label>
                                        <select name="role" id="role"
                                            class="form-control rounded-0 @error('role') is-invalid @enderror">
                                            <option value="" selected></option>
                                            <option value="admin"
                                                {{ $petugas->user->role == 'admin' ? 'selected' : '' }}>
                                                Admin</option>
                                            <option value="staff"
                                                {{ $petugas->user->role == 'staff' ? 'selected' : '' }}>
                                                Staff</option>
                                            <option value="kepala"
                                                {{ $petugas->user->role == 'kepala' ? 'selected' : '' }}>
                                                Kepala</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password"><code>Password</code>&nbsp;<small class="text-muted">(Isi jika
                                                ingin mengubah password)</small></label>
                                        <input name="password" type="password"
                                            class="form-control rounded-0 @error('password') is-invalid @enderror"
                                            id="password">
                                        @error('password')
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
