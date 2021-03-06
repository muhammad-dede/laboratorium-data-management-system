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
                        <a href="{{ route('alat.create') }}" class="btn btn-primary float-sm-right rounded-0">Tambah</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Alat</th>
                                            <th>Stok</th>
                                            <th class="bg-danger">Hilang</th>
                                            <th class="bg-warning">Rusak</th>
                                            <th>Lokasi</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_alat as $alat)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    {{ $alat->kode }} - {{ $alat->alat }}
                                                </td>
                                                <td class="text-center">{{ $alat->stok }} {{ $alat->satuan }}</td>
                                                <td class="text-center text-danger">{{ $alat->hilang }}</td>
                                                <td class="text-center text-warning">{{ $alat->rusak }}</td>
                                                <td class="text-center">
                                                    @if ($alat->id_rak !== null)
                                                        {{ $alat->rak->rak }} - {{ $alat->rak->lokasi }}
                                                    @else
                                                        Belum Dialokasi
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('alat.edit', $alat) }}"
                                                        class="btn btn-warning btn-sm rounded-0">Edit</a>
                                                    <a href="{{ route('alat.show', $alat) }}"
                                                        class="btn btn-info btn-sm rounded-0" target="_blank">Barcode</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
