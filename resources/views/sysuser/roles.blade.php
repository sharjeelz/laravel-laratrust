@extends('layouts.app')
@section('content')
@section('title','Roles')
@section('css')
<link href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('bread')
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="{{url('/')}}"><span>Home</span></a></li>
        <li class="breadcrumb-item"><a href="{{url('admin/users')}}"><span>User</span></a></li>
        <li class="breadcrumb-item"><a href="{{url('admin/roles')}}">Roles</a></li>
</ul>

@endsection
<div class="content-i">
<div class="content-box">
<div class="element-wrapper">
<div class="element-actions"><a class="btn btn-success btn-md" href="{{url('admin/role/create')}}"><i class="os-icon os-icon-ui-22"></i><span>Add Role</span></a></div>
        <h6 class="element-header">System Roles</h6>

        <div class="element-box">
                <div class="controls-above-table">
                        {{-- <div class="row">
                            <div class="col-sm-6">
                                <a class="btn btn-sm btn-secondary" href="#">Download CSV</a>
                                <a class="btn btn-sm btn-secondary" href="#">Archive</a>
                                <a class="btn btn-sm btn-danger" href="#">Delete</a>
                            </div>
                            <div class="col-sm-6">
                                <form class="form-inline justify-content-sm-end"><input class="form-control form-control-sm rounded bright" placeholder="Search" type="text">
                                    <select class="form-control form-control-sm rounded bright">
                                        <option selected="selected" value="">Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Active">Active</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </form>
                            </div>
                        </div> --}}
                    </div>
            <div class="table-responsive">
                <table id="roletable" width="100%" class="table table-striped table-lightfont">
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
                            @foreach ($roles as $role)

                            <tr id="tr-role-{{$role->id}}">

                            <td>{{ $role->name }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($role->created_at)->format('d/m/Y h:i:s A')}}</td>
                            <td>{{ \Carbon\Carbon::parse($role->updated_at)->format('d/m/Y h:i:s A')}}</td>
                            <td>
                            <button aria-expanded="false" aria-haspopup="true" class="btn btn-success dropdown-toggle" data-toggle="dropdown" id="formactions" type="button">Actions</button>
                            <div aria-labelledby="formactions" class="dropdown-menu">
                            @if($role->users=='[]')
                            <a class="dropdown-item delBtnRole" data-id=" {{$role->id}}"  data-name=" {{$role->name}}" href="#"><i class="fa fa-trash-o"></i> <span>Delete</span></a>
                            @else <a class="dropdown-item listUser"  data-name="{{$role->name}}" data-users="{{$role->users}}" data-target="#mymodalusers" data-toggle="modal"   href="#"><i class="fa fa-users"></i>
                                <span>View Users</span>
                                </a>
                            @endif
                            </div>
                        </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                @include('partials._modal_roles')
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