<nav>
    <div class="logo-container">
        <a href="https://ibb.co.com/qLLWXNZ3">
            <img src="https://i.ibb.co.com/Fkk0N5PL/LOGO-UNAIR.png" alt="LOGO-UNAIR" class="logo">
        </a>

        <a href="https://ibb.co.com/r9FZgtH">
            <img src="https://i.ibb.co.com/5ZG5d9L/rshp.png" alt="Logo RSHP" class="logo">
        </a>
    </div>


    <ul>
        <li>
            <a href="{{ url('/') }}" class="@if(request()->is('home')) active @endif">
                Home <span class="underline"></span>
            </a>
        </li>

        <li>
            <a href="{{ url('struktur-organisasi') }}" class="@if(request()->is('struktur-organisasi')) active @endif">
                Struktur Organisasi <span class="underline"></span>
            </a>
        </li>

        <li>
            <a href="{{ url('layanan-rshp') }}" class="@if(request()->is('layanan-rshp')) active @endif">
                Layanan RSHP <span class="underline"></span>
            </a>
        </li>

        <li>
            <a href="{{ url('visi-misi') }}" class="@if(request()->is('visi-misi')) active @endif">
                Visi Misi & Tujuan <span class="underline"></span>
            </a>
        </li>
    </ul>

    {{-- <ul class="navbar-nav ms-auto"> --}}
        <!-- AUTHENSIKASI -->
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login <span class="underline"></span></a>
                </li>

                {{-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li> --}}
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register <span class="underline"></span></a>
                    {{-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>

</nav>