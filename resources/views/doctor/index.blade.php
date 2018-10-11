@extends('layouts.app') 
@section('content') 
@section('title','Doctors')
    @include('partials._alert') 
@section('css')
<link href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/custom.css')}}" rel="stylesheet">
@endsection
 ('css') 
@section('bread')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}"><span>Home</span></a></li>
    <li class="breadcrumb-item"><a href="{{url('doctors')}}">Doctors</a></li>
</ul>
@endsection
 ('bread')

<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <div class="element-actions">
                <a class="btn btn-success btn-md" href="{{route('doctors.create')}}"><i class="os-icon os-icon-ui-22"></i><span>Add Doctor</span></a>
            </div>
            <h6 class="element-header">Doctors</h6>
            <div class="element-box">
                <div class="controls-above-table">
                    <form id="bulkactionCsvForm" role="form" action="{{url('export/doctors')}}" method="POST">@csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-sm btn-success">Download CSV</button>
                                <input type="hidden" id="bulkactionCsvFormData" name="data[]" value="" />
                                <a id="bulkactionDelete" class="btn btn-sm btn-danger" href="#">Block</a>
                                <a id="bulkactionRestore" class="btn btn-sm btn-info" href="#">Restore</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table id="doctortable" width="100%" class="table table-striped table-lightfont">
                        <thead>
                            <tr>
                                <th><input id="outer_checkbox" type="checkbox"></th>
                                <th>Name</th>
                                <th>Date Created</th>
                                <th>Last Updated</th>
                                <th>Actions</th>
                                <th>Blocked</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor) @php $class='danger'; 
@endphp @if($doctor->trashed())
                            <tr class="{{$class}}" id="tr-{{$doctor->id}}">
                                @endif @if($doctor->trashed())

                                <td><input class="inner_checkbox" data-trash="true" name="inner_checkbox" type="checkbox" value="{{$doctor->id}}"></td>
                                @else

                                <td><input class="inner_checkbox" data-trash="false" name="inner_checkbox" type="checkbox" value="{{$doctor->id}}"></td>
                                @endif

                                <td>{{ $doctor->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($doctor->created_at)->format('d/m/Y h:i:s A')}}</td>
                                <td>{{ \Carbon\Carbon::parse($doctor->updated_at)->format('d/m/Y h:i:s A')}}</td>
                                <td><button aria-expanded="false" aria-haspopup="true" class="btn btn-success dropdown-toggle"
                                        data-toggle="dropdown" id="doctorsaction" type="button">Actions</button>
                                    <div aria-labelledby="doctorsaction" class="dropdown-menu">
                                        @if($doctor->trashed()) {{-- if user softdelete --}}
                                        <a class="dropdown-item restoreBtn" data-id=" {{$doctor->id}}" data-name=" {{$doctor->name}}" href="#"><i class="fa fa-refresh"></i> <span>Restore</span></a>                                        @else {{-- if Doctor not softdelete --}}
                                        <a class="dropdown-item delBtn" data-id=" {{$doctor->id}}" data-name=" {{$doctor->name}}" href="#"><i class="fa fa-trash-o"></i> <span>Block</span></a>                                        @endif {{-- end if user softdelete --}} {{-- <a class="dropdown-item" href="{{url('admin/user/profile/edit',['userid'=>$doctor->id])}}"><i class="fa fa-star"></i> <span>Profile</span></a>                                        --}}
                                    </div>
                                </td>
                                @if($doctor->trashed())
                                <td>Yes</td>@else
                                <td>No</td>@endif
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


























































































































































    
@section('js')
    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/doctor-custom.js')}}"></script>
@endsection
 ('js')
@endsection
 ('content')