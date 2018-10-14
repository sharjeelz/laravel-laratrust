@extends('layouts.app')

@section('content')

@section('css')

@endsection('css')
<div class="content-i">
    <div class="content-box">
        <div class="row" >
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <h6 class="element-header">Dashboard</h6>
                    <div class="element-content">


                            <stats total_users="{{$total_users}}" total_roles="{{$total_roles}}" total_permissions="{{$total_permissions}}" ></stats>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('js')
@endsection('js')

@endsection('content')