@extends('layouts.app')
@section('content')
@section('title','Users')

@section('css')
<link href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/custom.css')}}" rel="stylesheet">
{{-- <link href="{{asset('css/dataTables.checkboxes.css')}}" rel="stylesheet"> --}}

@endsection

@section('bread')
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="{{url('/')}}"><span>Home</span></a></li>
<li class="breadcrumb-item"><a href="{{url('admin/users')}}">Users</a></li>
</ul>

@endsection
<div class="content-i">
<div class="content-box">
<div class="element-wrapper">
        <div class="element-actions"><a class="btn btn-success btn-md" href="{{url('admin/register')}}"><i class="os-icon os-icon-ui-22"></i><span>Add User</span></a></div>
        <h6 class="element-header">System Users</h6>
        <div class="element-box">


                <div class="controls-above-table">
                        <form id="bulkactionCsvForm"  role="form" action="{{url('/admin/export/users')}}" method="POST">
                            @csrf
                        <div class="row">

                            <div class="col-sm-6">


                                <button type="submit" class="btn btn-sm btn-success">Download CSV</button>
                                <input type="hidden" id="bulkactionCsvFormData" name="data[]" value=""/>

                                <a id="bulkactionDelete" class="btn btn-sm btn-danger" href="#" >Block</a>
                                <a id="bulkactionRestore" class="btn btn-sm btn-info" href="#" >Restore</a>
                                {{-- <a href="{{asset('users.csv')}}" >Download CSV</a> --}}
                             </div>

                        </div>
                        </form>
                    </div> <!-- controls Above-->
            <div class="table-responsive">

                <table id="usertable" width="100%" class="table table-striped table-lightfont">
                    <thead>
                        <tr>
                            <th><input id="outer_checkbox"  type="checkbox"></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date Created</th>
                            <th>Last Updated</th>
                            <th>Role <i>(s)</i></th>
                            <th>Permission <i>(s)</i></th>
                            <th>Actions</th>
                            <th>Blocked</th>
                        </tr>
                    </thead>
                    <tbody>

                            @foreach ($data as $user)

                            @php
                            $is=false;
                            @endphp

                                @php
                                $class='danger';
                                @endphp

                            @foreach ($user['users']->roles as $item)
                                @if ($item->name!=env('USER_ROLE'))
                                    @php
                                    $is=true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach

                            @if($user['users']->trashed())
                                <tr  class="{{$class}}"  id="tr-{{$user['users']->id}}">
                            @endif



                                @if($is)
                                @if($user['users']->trashed())
                            <td><input class="inner_checkbox" data-trash="true" type="checkbox" value="{{$user['users']->id}}"></td>
                            @else
                            <td><input class="inner_checkbox" data-trash="false" type="checkbox" value="{{$user['users']->id}}"></td>
                            @endif
                            @else
                            <td></td>
                            @endif
                            <td>{{ $user['users']->name }}</td>
                            <td>{{ $user['users']->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($user['users']->created_at)->format('d/m/Y h:i:s A')}}</td>
                            <td>{{ \Carbon\Carbon::parse($user['users']->updated_at)->format('d/m/Y h:i:s A')}}</td>
                            <td>

                            @foreach ($user['users']->roles as $role)

                            {{$role->name}}.
                            @endforeach
                        </td>
                        <td>

                                @foreach ($user['users']->permissions as $permission)
                                {{$permission->name}}.
                                @endforeach
                            </td>


                            <td><button aria-expanded="false" aria-haspopup="true" class="btn btn-success dropdown-toggle" data-toggle="dropdown" id="formactions" type="button">Actions</button>
                                <div aria-labelledby="formactions" class="dropdown-menu">
                                        @if($user['users']->trashed()) {{--    if user  softdelete --}}
                                        <a class="dropdown-item restoreBtn" data-id="{{$user['users']->id}}"  data-name=" {{$user['users']->name}}" href="#"><i class="fa fa-refresh"></i> <span>Restore</span></a>
                                        <a  class="dropdown-item" href="{{url('admin/user/profile/edit',['userid'=>$user['users']->id])}}"><i class="fa fa-star"></i> <span>Profile</span></a>

                                        @else  {{--    if user not softdelete --}}


                                        @if ($is)
                                        <a class="dropdown-item delBtn" data-id="{{$user['users']->id}}"  data-name=" {{$user['users']->name}}" href="#"><i class="fa fa-trash-o"></i> <span>Block</span></a>
                                        @endif




                                        @if($user['pexpiry'])
                                     <a class="dropdown-item sendPassowrdEmail" data-id="{{$user['users']->id}}"  data-email=" {{$user['users']->email}}" href="#"><i class="fa fa-lock"></i> <span>Change Password</span></a>
                                    @else

                                    <a class="dropdown-item" data-placement="top" data-toggle="tooltip" title="" type="link" data-original-title="Wait for Expiry Time"><i class="fa fa-lock"></i> <span>Change Password</span></a>
                                    @endif
                                    @if ($is)
                                    <a class="dropdown-item" data-target="#mymodal" data-roles="{{$user['users']->roles}}"  data-userid="{{$user['users']->id}}" data-toggle="modal" href="#"><i class="fa fa-users"></i> <span>Roles</span></a>

                                    <a class="dropdown-item" data-target="#mymodalp" data-permissions="{{$user['users']->permissions}}"  data-userid="{{$user['users']->id}}" data-toggle="modal" href="#"><i class="fa fa-shield"></i> <span>Permissions</span></a>

                                    <a  class="dropdown-item" href="{{url('admin/user/profile/edit',['userid'=>$user['users']->id])}}"><i class="fa fa-star"></i> <span>Profile</span></a>
                                    @endif

                                    @endif {{--    end if user  softdelete --}}


                                </div>

                            </td>

                            @if($user['users']->trashed())

                            <td>Yes</td>

                            @else

                            <td>No</td>
                            @endif


                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                            <tr>    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                            </tr>
                        </tfoot>
                </table>

                @include('partials._modal_users')
        </div>

    </div>
</div>
</div>
</div>


@section('js')
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>

{{-- <script src="{{asset('js/dataTables.checkboxes.js')}}"></script> --}}

<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>


<script src="{{asset('js/sysuser-custom.js')}}"></script>


@endsection


@endsection