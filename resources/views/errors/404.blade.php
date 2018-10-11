@extends('layouts.app')
@section('content')

@section('css')
<link href="{{asset('css/custom.css')}}" rel="stylesheet">
@endsection

<div class="content-i">
    <div class="content-box">
        <div class="big-error-w">
            <h1>404</h1>
            <img class="image-responsive e404" src="{{asset('img/not.jpg')}}"/>
            <h4>Error message: {{ $exception->getMessage() }}</h4>
        </div>

    </div>
    </div>
@endsection