@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    {{-- <div class="col-sm-6">
                        <a href="{{ route('siswa.create') }}" class="btn btn-primary float-sm-right rounded-0">Tambah</a>
                    </div> --}}
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <livewire:admin.laporan />
            </div>
        </section>
    </div>
@endsection
