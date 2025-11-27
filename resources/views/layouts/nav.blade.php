<nav>
    <div class="logo-container">
        <a href="https://ibb.co.com/qLLWXNZ3">
            <img src="https://i.ibb.co.com/Fkk0N5PL/LOGO-UNAIR.png" alt="LOGO-UNAIR" class="logo">
        </a>

        <a href="{{ url('/') }}" class="@if(request()->is('home')) @endif">
            <img src="https://i.ibb.co.com/5ZG5d9L/rshp.png" alt="Logo RSHP" class="logo">
        </a>
    </div>

    <ul>
        {{-- Menu Utama --}}
        <li>
            <a href="{{ url('/') }}" class="@if(request()->is('home')) active @endif">
                Home <span class="underline"></span></a>
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

        @guest
            {{-- Tampilkan Login jika belum login --}}
            <li>
                <a href="{{ route('login') }}" class="@if(request()->is('login')) active @endif">
                    Login <span class="underline"></span>
                </a>
            </li>
        @else
            {{-- Jika sudah Login, tampilkan Dashboard dan Logout sebagai menu horizontal --}}
            
            {{-- 1. Tombol Dashboard Berdasarkan Role --}}
            @php
                // Tentukan rute dan nama dashboard berdasarkan role
                $dashboardRoute = '';
                $dashboardName = '';

                switch (Auth::user()->role) {
                    case 'admin':
                        $dashboardRoute = route('admin.dashboard');
                        $dashboardName = 'Dashboard Admin';
                        break;
                    case 'dokter':
                        $dashboardRoute = route('dokter.dashboard');
                        $dashboardName = 'Dashboard Dokter';
                        break;
                    case 'perawat':
                        $dashboardRoute = route('perawat.dashboard');
                        $dashboardName = 'Dashboard Perawat';
                        break;
                    case 'resepsionis':
                        $dashboardRoute = route('resepsionis.dashboard');
                        $dashboardName = 'Dashboard Resepsionis';
                        break;
                    default:
                        $dashboardRoute = route('home'); // Rute default jika role tidak terdefinisi
                        $dashboardName = 'Dashboard';
                        break;
                }
            @endphp
            
            <li>
                <a href="{{ $dashboardRoute }}" class="@if(request()->is('*dashboard*')) active @endif">
                    {{ $dashboardName }} <span class="underline"></span>
                </a>
            </li>

            {{-- 2. Tombol Logout --}}
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout <span class="underline"></span>
                </a>
            </li>
            
            {{-- Form Logout harus tetap ada --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        @endguest
    </ul>
</nav>