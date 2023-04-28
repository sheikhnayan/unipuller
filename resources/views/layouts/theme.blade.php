<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UNIPULLAR | @yield('title')</title>

    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/preloader.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

</head>

<body class="">
    <div id="main-wrapper">
        @include('layouts.header')
        <div class="content-body">
            @yield('content')
        </div>
        @include('layouts.footer')


    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/script.js') }}" type="text/javascript"></script>
</body>

</html>
