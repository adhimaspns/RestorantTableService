<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Restaurant Table Service</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item @yield('beranda')">
                    <a class="nav-link" href="{{ url('admin/beranda') }}">Beranda <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown @yield('booking')">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        Booking
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item @yield('persetujuan')" href="{{ url('admin/booking') }}">Menunggu Persetujuan</a>
                        <a class="dropdown-item @yield('pembayaran')" href="{{ url('admin/booking/menunggu-pembayaran') }}">Menunggu Pembayaran</a>
                        <a class="dropdown-item @yield('booking-sukses')" href="{{ url('admin/booking/sukses') }}">Sukses</a>
                    </div>
                </li>
                <li class="nav-item dropdown @yield('setting')">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        Settings
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item @yield('meja-setting')" href="{{ url('admin/meja-setting') }}">Meja</a>
                        <a class="dropdown-item @yield('user')" href="{{ route('user.index') }}">Users</a>
                    </div>
                </li>
                <li class="nav-item @yield('laporan')">
                    <a class="nav-link" href="{{ url('admin/laporan') }}">Laporan</a>
                </li>
            </ul>

            <form action="{{ url('logout') }}" method="POST" class="form-inline my-2 my-lg-0">
                @csrf
                <button class="btn btn-danger border-radius-20" type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>