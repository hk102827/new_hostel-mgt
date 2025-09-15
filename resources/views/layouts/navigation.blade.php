<header class="header_area">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Logo -->
            <a class="navbar-brand logo_h" href="{{ route('home') }}">
                {{-- <img src="{{ asset('assets/image/Logo.png') }}" alt=""> --}}
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Navbar Items -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('accomodation') }}">Successful Students</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blog') }}">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>

                    <!-- Auth Buttons -->
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-sm ml-3">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}" class="ml-2">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-sm ml-3">
                                    Login
                                </a>
                            </li>
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm ml-2">
                                        Register
                                    </a>
                                </li>
                            @endif --}}
                        @endauth
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>
