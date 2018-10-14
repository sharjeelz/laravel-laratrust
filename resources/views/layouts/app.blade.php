<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>
            @yield('title','LARATRUST CMS')
        </title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/maince5a.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('bower_components/sweetalert/sweet.css')}}" rel="stylesheet">
        <link href="{{asset('css/icon_fonts_assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/fonts.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">

        @yield('css')
    </head>
    <body class="menu-position-side menu-side-left with-content-panel">
        <div class="all-wrapper with-side-panel solid-bg-all" id="app">
            <div class="layout-w">

                @include('partials._navbar')
                <div class="content-w">
                    @include('partials._header')
                    @yield('bread')
                    @yield('content')
                </div>
            </div>
            <div class="display-type"></div>
        </div>

        {{-- app .js includes Jquery and Bootstrap --}}
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('bower_components/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>
        <script src="{{asset('bower_components/tether/dist/js/tether.min.js')}}"></script>
        <script src="{{asset('bower_components/slick-carousel/slick/slick.min.js')}}"></script>
        <script src="{{asset('js/maince5a.js')}}"></script>
        <script src="{{asset('bower_components/sweetalert/sweet.js')}}"></script>
        @yield('js')
    </body>
</html>
