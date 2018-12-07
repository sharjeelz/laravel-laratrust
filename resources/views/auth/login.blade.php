<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>LARATRUST CMS</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{asset('css/maince5a.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/fonts.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}" crossorigin="anonymous">

</head>

<body class="auth-wrapper">
    <div class="all-wrapper menu-side with-pattern">
        <div class="auth-box-w">
            <div class="logo-w"><img alt="" src="{{asset('img/logo-big.png')}}"></div>
            <h4 class="auth-header">Authentication</h4>
            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email/Username</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                        required autofocus>
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                        required>
                    <div class="pre-icon os-icon os-icon-fingerprint"></div>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first(password) }}</strong>
                                    </span> @endif
                </div>
                <div class="buttons-w"><button class="btn btn-primary">Log me in</button>
                    <div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox">Remember
                                    Me</label></div>
                </div>
            </form>
        </div>
    </div>


</body>

</html>