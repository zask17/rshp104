<nav>
    <div class="logo-container">
        <img src="https://media.discordapp.net/attachments/1430819152146468944/1430819611875475626/LOGO_UNAIR.png?ex=69197c9a&is=69182b1a&hm=a2b68f9f1fea49fcf06fb3bd840e29c55822cf6d333a6ac75f6460e371138b67&=&format=webp&quality=lossless&width=660&height=660"
            alt="Logo UNAIR" class="logo">
        <img src="https://media.discordapp.net/attachments/1430819152146468944/1430819611254984814/LOGO_RSHP.png?ex=68fb2a1a&is=68f9d89a&hm=aa4a03b159c44395dc726c4208040033cbe3c9ecd39d50651f2acaa9a985279c&=&format=webp&quality=lossless&width=823&height=800"
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