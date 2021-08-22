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
                                <form action="{{ route('petugas.store') }}" method="POST">
                                    @csrf
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
                                        <label for="nip"><code>NIP</code></label>
                                        <input name="nip" type="text"
                                            class="form-control rounded-0 @error('nip') is-invalid @enderror" id="nip"
                                            value="{{ old('nip') }}">
                                        @error('nip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="telp"><code>Telepon</code></label>
                                        <input name="telp" type="text"
                                            class="form-control rounded-0 @error('telp') is-invalid @enderror" id="telp"
                                            value="{{ old('telp') }}">
                                        @error('telp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan"><code>Jabatan</code></label>
                                        <select name="jabatan" id="jabatan"
                                            class="form-control rounded-0 @error('jabatan') is-invalid @enderror">
                                            <option value="" selected></option>
                                            <option value="Staff" {{ old('jabatan') == 'Staff' ? 'selected' : '' }}>
                                                Staff</option>
                                            <option value="Kepala Laboratorium"
                                                {{ old('jabatan') == 'Kepala Laboratorium' ? 'selected' : '' }}>
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
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="role"><code>Role</code></label>
                                        <select name="role" id="role"
                                            class="form-control rounded-0 @error('role') is-invalid @enderror">
                                            <option value="" selected></option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                                Admin</option>
                                            <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>
                                                Staff</option>
                                            <option value="kepala" {{ old('role') == 'kepala' ? 'selected' : '' }}>
                                                Kepala</option>
                                        </select>
                                        @error('role')
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
