<div>
    <form>
        <div class="form-group">
            <label for="id_jadwal_praktek"><code>Jadwal Praktek</code></label>
            <select wire:model="id_jadwal_praktek" name="id_jadwal_praktek" id="id_jadwal_praktek"
                class="form-control rounded-0 @error('id_jadwal_praktek') is-invalid @enderror" style="width: 100%;">
                <option value="" selected></option>
                @foreach ($data_jadwal_praktek as $jadwal)
                    <option value="{{ $jadwal->id_jadwal_praktek }}">{{ $jadwal->hari }} ({{ $jadwal->jam_mulai }}
                        - {{ $jadwal->jam_selesai }}) | {{ $jadwal->mapel->mata_pelajaran }} -
                        {{ $jadwal->guru->nama }} |
                        {{ $jadwal->kelas->kelas }}
                    </option>
                @endforeach
            </select>
            @error('id_jadwal_praktek')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-5">
            <span class="lead font-weight-bold">Alat yang dipinjam</span>
            <hr>
            <div class="add-alat">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="id_alat"><code>Pilih Alat Yang Ingin Dipinjam</code></label>
                            <select wire:model="id_alat" name="id_alat" id="id_alat"
                                class="form-control rounded-0 @error('id_alat') is-invalid @enderror"
                                style="width: 100%;">
                                <option value="" selected></option>
                                @foreach ($data_alat as $alat)
                                    <option value="{{ $alat->id_alat }}">{{ $alat->kode }} -
                                        {{ $alat->alat }}</option>
                                @endforeach
                            </select>
                            @error('id_alat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if (session('error_alat'))
                                <small class="text-danger">{{ session('error_alat') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="qty"><code>Qty Pinjam</code></label>
                            <input wire:model="qty" type="number"
                                class="form-control rounded-0 @error('qty') is-invalid @enderror">
                            </select>
                            @error('qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="qty_pinjam"><code>-</code></label>
                            <button wire:click.prevent="tambah"
                                class="form-control btn btn-sm btn-success rounded-0">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="w-50">Alat</th>
                            <th class="text-center">Jumlah Pinjam</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjaman_detail as $index => $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail['alat'] }}</td>
                                <td class="text-center">{{ $detail['qty'] }}</td>
                                <td class="text-center">
                                    <button wire:click.prevent="hapus({{ $index }})"
                                        class="btn btn-sm btn-danger rounded-0">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="4">Belum ada alat yang ingin dipinjam</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <button wire:click.prevent="simpan" type="submit" class="btn btn-primary rounded-0">Simpan</button>
    </form>
</div>

@push('scripts')
    <script>
        window.addEventListener('swal', function(e) {
            Swal.fire(e.detail);
        });

        $(document).on('livewire:load', function() {
            $('#id_jadwal_praktek').select2({
                placeholder: "",
                theme: "bootstrap4"
            });
            $('#id_siswa').select2({
                placeholder: "",
                theme: "bootstrap4"
            });
            $('#id_alat').select2({
                placeholder: "",
                theme: "bootstrap4"
            });

            $('#id_jadwal_praktek').on('change', function() {
                @this.id_jadwal_praktek = $(this).val();
            });
            $('#id_siswa').on('change', function() {
                @this.id_siswa = $(this).val();
            });
            $('#id_alat').on('change', function() {
                @this.id_alat = $(this).val();
            });

            Livewire.hook('message.processed', (message, component) => {
                $('#id_jadwal_praktek').select2({
                    theme: "bootstrap4"
                })
                $('#id_siswa').select2({
                    theme: "bootstrap4"
                })
                $('#id_alat').select2({
                    theme: "bootstrap4"
                })
            });
        });
    </script>
@endpush
