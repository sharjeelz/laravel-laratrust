@extends('layouts.app')

@section('content')

@section('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
@endsection('css')
<div class="content-i">
    <div class="content-box">
        <div class="row" >
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <h6 class="element-header">Dashboard</h6>
                    <div class="element-content">
                        <div class="row">
                            <alerts></alerts>
                            <users total_users="{{$total_users}}"></users>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('js')
    <script src="{{asset('js/app.js')}}"></script>
@endsection('js')

@endsection('content')