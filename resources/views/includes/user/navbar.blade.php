<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        @if (Auth::check())
            <a class="navbar-brand" href="{{ url('beranda') }}">Restaurant Table Service</a>
        @else
            <a class="navbar-brand" href="{{ url('/') }}">Restaurant Table Service</a>
        @endif

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @auth
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    
                    <li class="nav-item @yield('beranda')">
                        <a class="nav-link" href="{{ url('beranda') }}">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item @yield('booking')">
                        <a class="nav-link" href="{{ url('booking') }}">Booking</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>

                <form action="{{ url('logout') }}" method="POST" class="form-inline my-2 my-lg-0">
                    @csrf
                    <button class="btn btn-danger border-radius-20" type="submit">Logout</button>
                </form>
            </div>
        @endauth

        @guest
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                
                <li class="nav-item active">
                    <a class="nav-link" href="">Beranda <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <a href="{{ url('register') }}" class="btn btn-sm btn-outline-success" style="margin-right: 5px;">
                Register
            </a>

            <a href="{{ url('login') }}" class="btn btn-sm btn-success">
                Masuk
            </a>
        </div>
        @endguest
    </div>
</nav>