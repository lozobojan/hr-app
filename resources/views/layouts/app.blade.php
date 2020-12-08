<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="#">

    <title>{{ config('app.name', 'Home') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="{{ asset('//fonts.gstatic.com') }}">
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Nunito') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>

        <main class="py-4">
            @yield('content')
        </main>
    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
