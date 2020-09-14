<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title','Laboratuvar Otomasyon Sistemi') - Bilgisayar Laboratuvar Otomasyon Sistemi</title>
    <meta name="keywords" content="@yield('meta_keywords','laravel,php,otomasyon,laboratuvar otomasyon sistemi,laboratuvar otomasyon yazılımı')">
    <meta name="description" content="@yield('meta_description','Laravel ile geliştirilen bilgisayar laboratuvarları otomasyonu')">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="icon" href="{{ asset('images/icon.png') }}">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    </style>
</head>
<body class="bg-royal-blue">
<div id="app">
    <div class="container">
        @yield('content')
    </div>
</div>
</body>
</html>
