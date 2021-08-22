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
                <li class="nav-header">MENU SISWA</li>
                <li class="nav-item">
                    <a href="{{ route('siswa.jadwal.index') }}"
                        class="nav-link {{ $menu == 'jadwal' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Jadwal Praktek
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('siswa.peminjaman.index') }}"
                        class="nav-link {{ $menu == 'peminjaman' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>
                            Peminjaman
                            @if (terima_alat() > 0)
                                <span class="badge badge-danger right">{{ terima_alat() }}</span>
                            @endif
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('siswa.riwayat.index') }}"
                        class="nav-link {{ $menu == 'riwayat' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>
                            Riwayat
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
