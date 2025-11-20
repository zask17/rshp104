<nav>
    <div class="logo-container">
        <img src="https://ibb.co.com/N6h1LFtv"
            alt="Logo UNAIR" class="logo">
        <img src="https://ibb.co.com/r9FZgtH"
            alt="Logo RSHP" class="logo">
    </div>

    <ul>
        <li>
            <a href="{{ url('home') }}" class="@if(request()->is('home')) active @endif">
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
</nav>