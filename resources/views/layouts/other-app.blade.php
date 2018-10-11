<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>
            @yield('title','Hospital System')
        </title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}" crossorigin="anonymous">
        <link href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
        <link href="{{asset('bower_components/dropzone/dist/dropzone.css')}}" rel="stylesheet">
        <link href="{{asset('bower_components/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
        <link href="{{asset('bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
        <link href="{{asset('bower_components/slick-carousel/slick/slick.css')}}" rel="stylesheet">
        <link href="{{asset('bower_components/sweetalert/sweet.css')}}" rel="stylesheet">
        <link href="{{asset('css/icon_fonts_assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/fonts.css')}}" rel="stylesheet" type="text/css">
        @yield('css')
    </head>
    <body class="menu-position-side menu-side-left">
        <div class="all-wrapper solid-bg-all">
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
        <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('bower_components/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('bower_components/moment/moment.js')}}"></script>
        <script src="{{asset('bower_components/chart.js/dist/Chart.min.js')}}"></script>
        <script src="{{asset('bower_components/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
        <script src="{{asset('bower_components/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap-validator/dist/validator.min.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{asset('bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
        <script src="{{asset('bower_components/dropzone/dist/dropzone.js')}}"></script>
        <script src="{{asset('bower_components/editable-table/mindmup-editabletable.js')}}"></script>
        <script src="{{asset('bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
        <script src="{{asset('bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>
        <script src="{{asset('bower_components/tether/dist/js/tether.min.js')}}"></script>
        <script src="{{asset('bower_components/slick-carousel/slick/slick.min.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap/js/dist/util.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap/js/dist/alert.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap/js/dist/button.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap/js/dist/carousel.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap/js/dist/collapse.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap/js/dist/dropdown.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap/js/dist/modal.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap/js/dist/tab.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap/js/dist/tooltip.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap/js/dist/popover.js')}}"></script>
        <script src="{{asset('js/maince5a.js')}}"></script>
        <script src="{{asset('bower_components/sweetalert/sweet.js')}}"></script>
        @yield('js')
    </body>
</html>
