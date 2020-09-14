<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title','Yönetici Paneli') - Bilgisayar Laboratuvar Otomasyon Sistemi</title>
    <meta name="keywords" content="@yield('meta_keywords','laravel,php,otomasyon,laboratuvar otomasyon sistemi,laboratuvar otomasyon yazılımı')">
    <meta name="description" content="@yield('meta_description','Laravel ile geliştirilen bilgisayar laboratuvarları otomasyonu')">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="icon" href="{{ asset('images/icon.png') }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">




</head>
<body>
    <div id="app">
        <div id="wrapper">
            <sidebar-d ></sidebar-d>
            <div id="content-wrapper">
                <section class="all-content">
                    <div class="content">
                        <navbar-d admin="{{ auth()->user()->name}}"></navbar-d>
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </div>
                </section>
                <footer-d></footer-d>
            </div>

        </div>
    </div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script>

</script>
</body>
</html>
