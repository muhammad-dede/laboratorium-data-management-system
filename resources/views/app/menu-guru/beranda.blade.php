@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }} | Selamat Datang {{ auth()->user()->guru->nama }}</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1">
                                <i class="fas fas fa-clock"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Jadwal Praktek</span>
                                <span class="info-box-number">{{ $total_jadwal }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1">
                                <i class="fas fa-people-carry"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Peminjaman</span>
                                <span class="info-box-number">{{ $total_peminjaman }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1">
                                <i class="fas fa-history"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Riwayat</span>
                                <span class="info-box-number">{{ $total_riwayat }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
