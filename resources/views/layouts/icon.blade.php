<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | inspiration </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app2.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @if(app('env') == 'production')
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif

    <link rel="shortcut icon" href="/images/logo.ico">
</head>
<body class="p-body--icon">
<x-header></x-header>
    <div class="original-content">
        {{-- コンテンツ部分 --}}
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>