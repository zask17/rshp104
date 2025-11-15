<!DOCTYPE html>
<html lang="id">
<head>
    <title>@yield('title', 'RSHP UNAIR')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('layouts.nav')

    <main>
        @yield('content')
    </main>
    @include('layouts.footer')
</body>
</html>