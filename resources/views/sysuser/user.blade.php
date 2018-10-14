@extends('layouts.app')
@section('content')
@include('partials._alert')
@section('css')
<link href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/custom.css')}}" rel="stylesheet">
@endsection
@section('bread')
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="{{url('/')}}"><span>Home</span></a></li>
        <li class="breadcrumb-item"><a href="{{url('admin/users')}}"><span>User</span></a></li>
        <li class="breadcrumb-item"><a href="{{url('admin/user/profile/edit/'.$user->id)}}">Profile</a></li>
</ul>

@endsection('bread')

<div class="content-i">
<div class="content-box">
        <div class="row">
            <div class="col-sm-7">
                <div class="user-profile compact">
                    <div class="up-head-w" style="background-image:url({{asset('storage/'.$user->pic)}})">
                        {{-- <div class="up-social">
                            <a href="#">
                                <i class="os-icon os-icon-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="os-icon os-icon-facebook"></i>
                            </a>
                        </div> --}}
                        <div class="up-main-info">
                            <h2 class="up-header">{{$user->name}}</h2>
                            <h6 class="up-sub-header">{{$user->email}}</h6>
                        </div>
                        <svg class="decor" width="842px" height="219px" viewbox="0 0 842 219" preserveaspectratio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF">
                                <path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="up-controls">

                        <div class="row">
                            <div class="col-sm-12 text-right">
                                    @if(Auth::user()->id!=$user->id)
                                    <a class="btn btn-primary btn-sm sendMailNow" href="">
                                            <i class="os-icon os-icon-email-2-at"></i>
                                            <span>Email</span>
                                        </a>
                                <a class="btn btn-secondary btn-sm sendSMSNOw" href="#">
                                        <i class="os-icon os-icon-mail-07"></i>
                                        <span>SMS</span>
                                    </a>

                                    @if($user->trashed())
                                    <a class="btn btn-info btn-sm restoreBtn" data-id="{{$user->id}}" data-name="{{$user->name}}" href="#">
                                            <i class="os-icon os-icon-grid-18"></i>
                                            <span>Restore</span>
                                        </a>
                                        @else
                                        <a class="btn btn-danger btn-sm delBtn" data-id="{{$user->id}}" data-name="{{$user->name}}"  href="#">
                                                <i class="os-icon os-icon-cancel-circle"></i>
                                                <span>Block</span>
                                            </a>
                                    @endif
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="up-contents hide" id="emaildiv" style="display:none;">
                            <form id="sendEmailForm"  method="POST" action="{{route('admin.user.send.email',$user->id)}}">
                                @csrf
                            <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group"><label for="subject">Subject</label>
                                            <input id="subject" type="text" class="form-control" name="subject" value="" required autofocus>
                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                        </div>
                                        <div class="form-group"><label for="cc">CC</label>
                                            <input id="cc" type="email" class="form-control" name="cc" value=""  autofocus>
                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Send Now</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                            <div class="form-group"><label for="content">Content</label>
                                                <textarea id="content" class="form-control" cols="10" rows="10" name="content"  required autofocus></textarea>
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                </div>
                            </form>
                        </div>
                    {{-- <div class="up-contents">
                        <div class="m-b">
                            <div class="row m-b">
                                <div class="col-sm-6 b-r b-b">
                                    <div class="el-tablo centered padded-v">
                                        <div class="value">25</div>
                                        <div class="label">Password Requests</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 b-b">
                                    <div class="el-tablo centered padded-v">
                                        <div class="value">315</div>
                                        <div class="label">Friends</div>
                                    </div>
                                </div>
                            </div>
                            <div class="padded">
                                <div class="os-progress-bar primary">
                                    <div class="bar-labels">
                                        <div class="bar-label-left">
                                            <span>Profile Completion</span><span class="positive">+10</span></div>
                                        <div class="bar-label-right">
                                            <span class="info">72/100</span></div>
                                    </div>
                                    <div class="bar-level-1" style="width: 100%">
                                        <div class="bar-level-2" style="width: 80%">
                                            <div class="bar-level-3" style="width: 30%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="os-progress-bar primary">
                                    <div class="bar-labels">
                                        <div class="bar-label-left">
                                            <span>Status Unlocked</span><span class="positive">+5</span></div>
                                        <div class="bar-label-right">
                                            <span class="info">45/100</span></div>
                                    </div>
                                    <div class="bar-level-1" style="width: 100%">
                                        <div class="bar-level-2" style="width: 30%">
                                            <div class="bar-level-3" style="width: 10%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="os-progress-bar primary">
                                    <div class="bar-labels">
                                        <div class="bar-label-left">
                                            <span>Followers</span><span class="negative">-12</span></div>
                                        <div class="bar-label-right">
                                            <span class="info">74/100</span></div>
                                    </div>
                                    <div class="bar-level-1" style="width: 100%">
                                        <div class="bar-level-2" style="width: 80%">
                                            <div class="bar-level-3" style="width: 60%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="element-wrapper">

                    <div class="element-box">
                            <div class="controls-above-table">

                                    <div class="row">

                                        <div class="col-sm-12">
                                            @empty(!$user->lastLoginAt())
                                            <a href="{{url('/admin/export/logins',$user->id)}}" class="btn btn-sm btn-success">Download CSV</a>
                                            @endempty
                                            <input type="hidden" id="bulkactionCsvFormData" name="data[]" value=""/>
                                            <div class="value-pair">
                                                    <div class="label">Last Login:</div>
                                                    <div class="value badge badge-pill badge-danger">
                                                       @if ($user->lastLoginAt())
                                                       {{ date('Y-m-d h:i:s A',strtotime($user->lastLoginAt()))}}
                                                       @else
                                                        Never Logged In
                                                       @endif

                                                    </div>
                                                </div>

                                         </div>

                                    </div>

                                </div>

                        <h6 class="element-header">User Login/Logout Activity</h6>

                        <div class="timed-activities compact">

                                <div class="table-responsive">
                                        <!-------------------- START - Basic Table -------------------->
                                        <table id="logstable" width="100%" class="table table-striped table-lightfont">
                                            <thead>
                                                <tr>
                                                    <th>No#</th>
                                                    <th>Login At</th>
                                                    <th>Logout At</th>
                                                    <th>Duration</th>
                                                    <th>IP</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($user->authentications as $authentication)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>

                                                <td> {{ \Carbon\Carbon::parse($authentication->login_at)->format('d-M-Y h:i:s A')}}</td>
                                                @if($authentication->logout_at!=null)
                                                <td> {{ \Carbon\Carbon::parse($authentication->logout_at)->format('d-M-Y h:i:s A')}}</td>
                                                <td> {{$authentication->logout_at->diffInMinutes($authentication->login_at) }} Min(s)</td>
                                                @else
                                                <td>-</td>
                                                <td>-</td>
                                                @endif
                                                    <td>{{$authentication->ip_address}}</td>


                                                </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                        <!-------------------- END - Basic Table -------------------->
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">

                <div class="element-wrapper">
                    <div class="element-box">

                        <form id="formValidate" enctype="multipart/form-data"   method="POST" action="{{route('admin.user.update',$user->id)}}">

                              @csrf
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="os-icon os-icon-wallet-loaded"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Profile Settings</h5>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Name</label>

                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"  placeholder="Name" required="required" type="text" name="name" value="{{$user->name}}">

                                        @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  placeholder="Email" required="required" type="email" name="email" value="{{$user->email}}">
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
                                                <input class="form-control{{ $errors->has('pic') ? ' is-invalid' : '' }}" id="pic" type="file" name="pic"/>
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                                @if ($errors->has('pic'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('pic') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                    </div>


                                </div>


                            <div class="form-buttons-w">
                                <button class="btn btn-primary" type="submit">
                                    Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="element-wrapper">
                        <div class="element-box">

                                <div class="element-info">
                                    <div class="element-info-with-icon">
                                        <div class="element-info-icon">
                                            <div class="os-icon os-icon-delivery-box-2"></div>
                                        </div>
                                        <div class="element-info-text">
                                            <h5 class="element-inner-header">Other</h5>

                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                        <div class="col-md-6">
                                                <div class="table-responsive">

                                                        <table class="table table-lightborder">
                                                            <thead>
                                                                <tr>
                                                                    <th>Roles</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @foreach ($user->roles as $role)
                                                                <tr>

                                                                <td>{{$role->name}}</td>
                                                                </tr>
                                                                @endforeach






                                                            </tbody>

                                                        </table>


                                                    </div>
                                        </div>
                                    <div class="col-md-6">
                                            <div class="table-responsive">

                                                    <table class="table table-lightborder">
                                                        <thead>
                                                            <tr>
                                                                <th>Permissions</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($user->permissions as $permission)
                                                            <tr>

                                                            <td>{{$permission->name}}</td>
                                                            </tr>
                                                            @endforeach






                                                        </tbody>

                                                    </table>


                                                </div>
                                    </div>

                                </div>

                        </div>
                    </div>
            </div>

        </div>






        <!-------------------- START - Chat Popup Box -------------------->
        {{-- <div class="floated-chat-btn">
            <i class="os-icon os-icon-mail-07"></i>
            <span>Chat</span>
        </div> --}}
        {{-- <div class="floated-chat-w">
            <div class="floated-chat-i">
                <div class="chat-close">
                    <i class="os-icon os-icon-close"></i>
                </div>
                <div class="chat-head">
                    <div class="user-w with-status status-green">
                        <div class="user-avatar-w">
                            <div class="user-avatar"><img alt="" src="img/avatar1.jpg"></div>
                        </div>
                        <div class="user-name">
                            <h6 class="user-title">John Mayers</h6>
                            <div class="user-role">Account Manager</div>
                        </div>
                    </div>
                </div>
                <div class="chat-messages">
                    <div class="message">
                        <div class="message-content">Hi, how can I help you?</div>
                    </div>
                    <div class="date-break">Mon 10:20am</div>
                    <div class="message">
                        <div class="message-content">Hi, my name is Mike, I will be happy to assist you</div>
                    </div>
                    <div class="message self">
                        <div class="message-content">Hi, I tried ordering this product and it keeps showing me error code.</div>
                    </div>
                </div>
                <div class="chat-controls"><input class="message-input" placeholder="Type your message here..." type="text">
                    <div class="chat-extra">
                        <a href="#">
                            <span class="extra-tooltip">Attach Document</span>
                            <i class="os-icon os-icon-documents-07"></i>
                        </a>
                        <a href="#">
                            <span class="extra-tooltip">Insert Photo</span>
                            <i class="os-icon os-icon-others-29"></i>
                        </a>
                        <a href="#">
                            <span class="extra-tooltip">Upload Video</span>
                            <i class="os-icon os-icon-ui-51"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-------------------- END - Chat Popup Box -------------------->
    </div>
</div>

@section('js')


<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>


<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

<script>

$('#logstable').DataTable({

    "pageLength": 5
});

    $(document).on('click','.sendMailNow', function (e) {
        e.preventDefault();
    $('#emaildiv').toggle('fast');




});

//Restore User
$(document).on('click', '.restoreBtn', function (e) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    swal({
            title: "Are you sure to Restore "+name+" ?",
            type: "info",
            confirmButtonClass: "btn-info",
            confirmButtonText: "Yes",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "/admin/restore/user",
                data: {_token: CSRF_TOKEN, id:id},
                success: function (data) {
                    window.location.reload();
                   swal("Restored!", "User Restored Successfuly", "success");


                    }
            });
    });

});

//Delete User
$(document).on('click', '.delBtn', function (e) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    swal({
            title: "Are you sure to block "+name+" ?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "/admin/destroy/user",
                data: {_token: CSRF_TOKEN, id:id},
                success: function (data) {
                    window.location.reload();
                    swal("Deleted!", "User Blocked", "success");
                    }
            });
    });
});

$("#h_logo").change(function() {

path='{{asset("img")}}/';
filename = this.files[0].name
$('.logo_hover').css('background-image','url('+path+filename+')');


});





</script>

@endsection
@endsection
