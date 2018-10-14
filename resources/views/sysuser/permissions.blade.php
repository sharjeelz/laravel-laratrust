@extends('layouts.app')
@section('content')
@section('title','Permissions')
@section('css')
<link href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('bread')
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="{{url('/')}}"><span>Home</span></a></li>
    <li class="breadcrumb-item"><a href="{{url('admin/users')}}"><span>User</span></a></li>
        <li class="breadcrumb-item"><a href="{{url('admin/permissions')}}">Permissions</a></li>
</ul>

@endsection
<div class="content-i">
<div class="content-box">
<div class="element-wrapper">
        <div class="element-actions"><a class="btn btn-success btn-md" href="{{url('admin/permission/create')}}"><i class="os-icon os-icon-ui-22"></i><span>Add Permission</span></a></div>
        <h6 class="element-header">System Permissions</h6>
        <div class="element-box">
            <div class="table-responsive">
                <table id="permissionuser" width="100%" class="table table-striped table-lightfont">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Date Created</th>
                            <th>Last Updated</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($permissions as $permission)
                        <tr id="tr-{{$permission->id}}">

                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->display_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($permission->created_at)->format('d/m/Y h:i:s A')}}</td>
                            <td>{{ \Carbon\Carbon::parse($permission->updated_at)->format('d/m/Y h:i:s A')}}</td>
                            <td>
                                    <button aria-expanded="false" aria-haspopup="true" class="btn btn-success dropdown-toggle" data-toggle="dropdown" id="formactions" type="button">Actions</button>
                                    <div aria-labelledby="formactions" class="dropdown-menu">
                                    @if($permission->users=='[]')
                                    <a class="dropdown-item delBtnPermission" data-id=" {{$permission->id}}"  data-name=" {{$permission->name}}" href="#"><i class="fa fa-trash-o"></i> <span>Delete</span></a>
                                    @else <a class="dropdown-item listUser"  data-name="{{$permission->name}}" data-users="{{$permission->users}}" data-target="#mymodalpermissions" data-toggle="modal"   href="#"><i class="fa fa-users"></i>
                                        <span>View Users</span>
                                        </a>
                                    @endif
                                    </div>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                @include('partials._modal_permissions')
            </div>
        </div>
    </div>
</div>
</div>
@section('js')
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/sysuser-custom.js')}}"></script>
@endsection

@endsection