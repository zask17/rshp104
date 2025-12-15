<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2-field').select2({ theme: "default" });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>


<body>
    <div id="app">
        @include('layouts.nav')
        {{-- @include('layouts.sidebar') --}}


        <main class="py-4">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
</body>

</html>