<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                @if (auth()->user()->role == 'siswa')
                    <span class="font-weight-bold">{{ auth()->user()->siswa->nama }}</span>
                @elseif (auth()->user()->role == 'guru')
                    <span class="font-weight-bold">{{ auth()->user()->guru->nama }}</span>
                @else
                    <span class="font-weight-bold">{{ auth()->user()->petugas->nama }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="{{ asset('assets/profil') }}/{{ auth()->user()->image }}" alt="User Avatar"
                            class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title font-weight-bold">
                                @if (auth()->user()->role == 'siswa')
                                    {{ auth()->user()->siswa->nama }}
                                @elseif (auth()->user()->role == 'guru')
                                    {{ auth()->user()->guru->nama }}
                                @else
                                    {{ auth()->user()->petugas->nama }}
                                @endif
                            </h3>
                            <p class="text-sm">{{ auth()->user()->email }}</p>
                            <p class="text-sm text-muted">
                                Role : {{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item dropdown-footer text-danger">Logout</button>
                </form>
            </div>
        </li>
    </ul>
</nav>
