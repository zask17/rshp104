<nav>
    <div class="logo-container">

        <a href="https://ibb.co.com/N6h1LFtv"><img src="https://i.ibb.co.com/PZpT5rFL/unair-pinggit-biru.jpg"
                alt="Logo UNAIR" class="logo"></a>
        <a href="https://ibb.co.com/r9FZgtH"><img src="https://i.ibb.co.com/5ZG5d9L/rshp.png" alt="rshp"
                class="logo"></a>
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
</nav>