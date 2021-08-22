<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('beranda') }}" class="brand-link elevation-4">
        <img src="{{ asset('favicon.png') }}" alt="logo" class="brand-image elevation-3">
        <span class="brand-text font-weight-light">{{ substr(config('app.name'), 0, 3) }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/profil') }}/{{ auth()->user()->image }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                @if (auth()->user()->role == 'siswa')
                    <a href="#" class="d-block">{{ auth()->user()->siswa->nama }}</a>
                @elseif (auth()->user()->role == 'guru')
                    <a href="#" class="d-block">{{ auth()->user()->guru->nama }}</a>
                @else
                    <a href="#" class="d-block">{{ auth()->user()->petugas->nama }}</a>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('beranda') }}" class="nav-link {{ $menu == 'beranda' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                @if (auth()->user()->role == 'admin')
                    <li class="nav-header">MASTER</li>
                    <li class="nav-item">
                        <a href="{{ route('petugas.index') }}"
                            class="nav-link {{ $menu == 'petugas' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Petugas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kelas.index') }}"
                            class="nav-link {{ $menu == 'kelas' ? 'active' : '' }}">
                            <i class="nav-icon fab fa-buromobelexperte"></i>
                            <p>
                                Kelas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('mapel.index') }}"
                            class="nav-link {{ $menu == 'mapel' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>
                                Mata Pelajaran
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'staff')
                    <li class="nav-header">DATA</li>
                    <li class="nav-item">
                        <a href="{{ route('guru.index') }}"
                            class="nav-link {{ $menu == 'guru' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>
                                Guru
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.index') }}"
                            class="nav-link {{ $menu == 'siswa' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Siswa
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jadwal-praktek.index') }}"
                            class="nav-link {{ $menu == 'jadwal-praktek' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clock"></i>
                            <p>
                                Jadwal Praktek
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('rak.index') }}" class="nav-link {{ $menu == 'rak' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>
                                Rak Laboratorium
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('alat.index') }}"
                            class="nav-link {{ $menu == 'alat' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Alat Laboratorium
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-header">MENU UTAMA</li>
                <li class="nav-item">
                    <a href="{{ route('peminjaman.index') }}"
                        class="nav-link {{ $menu == 'peminjaman' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>
                            Data Peminjaman
                            @if (auth()->user()->role == 'admin')
                                @php
                                    $notif = peminjaman_baru() + sudah_konfirmasi() + sudah_acc() + diterima();
                                @endphp
                                @if ($notif > 0)
                                    <span class="badge badge-danger right">{{ $notif }}</span>
                                @endif
                            @elseif (auth()->user()->role == 'staff')
                                @php
                                    $notif = peminjaman_baru() + sudah_acc();
                                @endphp
                                @if ($notif > 0)
                                    <span class="badge badge-danger right">{{ $notif }}</span>
                                @endif
                            @endif
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.index') }}"
                        class="nav-link {{ $menu == 'laporan' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-print"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
                <br>
                <br>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
