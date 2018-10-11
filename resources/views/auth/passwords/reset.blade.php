<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Hospital System Admin</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
        <link href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
        <link href="{{asset('bower_components/dropzone/dist/dropzone.css')}}" rel="stylesheet">
        <link href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('bower_components/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
        <link href="{{asset('bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
        <link href="{{asset('bower_components/slick-carousel/slick/slick.css')}}" rel="stylesheet">
        {{-- <link href="{{asset('css/fonts.css')}}" rel="stylesheet" type="text/css"> --}}
        <link rel="stylesheet" href="{{asset('css/app.css')}}" crossorigin="anonymous">

    </head>
    <body class="auth-wrapper">
            <div class="all-wrapper menu-side with-pattern">
                <div class="auth-box-w">
                    <div class="logo-w"><img alt="" src="{{asset('img/logo-big.png')}}"></div>
                    <h4 class="auth-header">Reset Password</h4>
                    <form method="POST" action="{{ url('password/reset') }}" aria-label="{{ __('Reset Password') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                    <label for="email">Email/Username</label>


                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                            </div>

                            <div class="form-group">
                                    <label for="password">Password</label>

                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif

                            </div>

                            <div class="form-group">
                                    <label for="password-confirm">Confirm Password</label>


                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                            </div>
                            <div class="buttons-w"><button type="submit" class="btn btn-primary">Reset Password</button>

                            </div>

                        </form>
                </div>
            </div>






        <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('bower_components/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('bower_components/moment/moment.js')}}"></script>
        <script src="{{asset('bower_components/chart.js/dist/Chart.min.js')}}"></script>
        <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
        <script src="{{asset('bower_components/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
        <script src="{{asset('bower_components/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap-validator/dist/validator.min.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{asset('bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
        <script src="{{asset('bower_components/dropzone/dist/dropzone.js')}}"></script>
        <script src="{{asset('bower_components/editable-table/mindmup-editabletable.js')}}"></script>
        <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
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
        <script src="{{asset('js/demo_customizerce5a.js')}}"></script>
        <script src="{{asset('js/maince5a.js')}}"></script>
    </body>
</html>



