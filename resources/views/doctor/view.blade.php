@extends('layouts.app')
@section('content')

@section('css')

<link href="{{asset('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('bread')
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="{{url('/')}}"><span>Home</span></a></li>
        <li class="breadcrumb-item"><a href="{{route('doctors.index')}}"><span>Doctors</span></a></li>
        <li class="breadcrumb-item"><a href="{{route('doctors.create')}}">Add Doctor</a></li>

</ul>

@endsection
<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box">

                        <form enctype="multipart/form-data" action="{{url('admin/register')}}" method="POST" id="formValidate" novalidate="true">
                            @csrf
                            <h5 class="form-header">Create User</h5>

                    <fieldset class="form-group">
                        <legend><span>User</span></legend>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label for="">Name</label>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                    <div class="help-block form-text with-errors form-control-feedback"></div>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                    <div class="form-group"><label for="">Email</label>
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                        @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                    <div class="form-group"><label for="">Picture</label>
                                        <input class="form-control{{ $errors->has('pic') ? ' is-invalid' : '' }}" type="file" name="pic"/>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                        @if ($errors->has('pic'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('pic') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>


                    </div>



                </fieldset>

                <div
                    class="form-buttons-w"><button class="btn btn-primary disabled" type="submit"> Submit</button></div>
            </form>
        </div>
    </div>
</div>
</div>
 </div>
</div>

@section('js')

<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('.permissions_pills').select2();
    $('.roles_pills').select2();
});
</script>

@endsection


    @endsection