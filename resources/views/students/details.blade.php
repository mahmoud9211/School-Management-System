@extends('layouts.master')
@section('css')

@section('title')
    {{trans('main_trans.student_details')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main_trans.student_details')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.student_details')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">






<div class="tab nav-border">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                    role="tab" aria-controls="home-02"
                    aria-selected="true">{{trans('main_trans.student_details')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                    role="tab" aria-controls="profile-02"
                    aria-selected="false">{{trans('main_trans.student_att')}}</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                    aria-labelledby="home-02-tab">
                <table class="table table-striped table-hover" style="text-align:center">
                    <tbody>
                    <tr>
                        <th scope="row">{{trans('main_trans.name')}}</th>
                        <td>{{ $student->name }}</td>
                        <th scope="row">{{trans('main_trans.Email')}}</th>
                        <td>{{$student->email}}</td>
                        <th scope="row">{{trans('main_trans.gender')}}</th>
                        <td>{{$student->gender->name}}</td>
                        <th scope="row">{{trans('main_trans.Nationality')}}</th>
                        <td>{{$student->Nationality->name}}</td>
                    </tr>

                    <tr>
                        <th scope="row">{{trans('main_trans.Grade')}}</th>
                        <td>{{ $student->grade->name }}</td>
                        <th scope="row">{{trans('main_trans.classrooms')}}</th>
                        <td>{{$student->classroom->name}}</td>
                        <th scope="row">{{trans('main_trans.section')}}</th>
                        <td>{{$student->section->name}}</td>
                        <th scope="row">{{trans('main_trans.Date_of_Birth')}}</th>
                        <td>{{ $student->Date_Birth}}</td>
                    </tr>

                    <tr>
                        <th scope="row">{{trans('main_trans.parent')}}</th>
                        <td>{{ $student->myparent->Name_Father}}</td>
                        <th scope="row">{{trans('main_trans.academic_year')}}</th>
                        <td>{{ $student->academic_year }}</td>
                        <th scope="row"></th>
                        <td></td>
                        <th scope="row"></th>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="profile-02" role="tabpanel"
                    aria-labelledby="profile-02-tab">
                <div class="card card-statistics">
                    <div class="card-body">
                        <form method="post" action="{{route('students.attachment')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label
                                        for="academic_year">{{trans('main_trans.student_att')}}
                                        : <span class="text-danger">*</span></label>
                                    <input type="file" accept="image/*" name="photos[]" multiple required>
                                    <input type="hidden" name="student_name" value="{{$student->name}}">
                                    <input type="hidden" name="student_id" value="{{$student->id}}">
                                </div>
                            </div>
                            <br><br>
                            <button type="submit" class="button button-border x-small">
                                    {{trans('main_trans.submit')}}
                            </button>
                        </form>
                    </div>
                    <br>

                    <table class="table center-aligned-table mb-0 table table-hover"
                                               style="text-align:center">
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('main_trans.filename')}}</th>
                                                <th scope="col">{{trans('main_trans.created_at')}}</th>
                                                <th scope="col">{{trans('main_trans.Processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($student->image as $image)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$image->file_name}}</td>
                                                    <td>{{$image->created_at->diffForHumans()}}</td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm"

                                                        href="{{url('attachments_download')}}//{{ $image->imageable->name }}/{{$image->file_name}}"
                                                        role="button"><i class="fa fa-download"></i>&nbsp; {{trans('main_trans.Download')}}</a>

                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target=""
                                                                title="{{ trans('main_trans.delete') }}">{{trans('main_trans.delete_')}}
                                                        </button>

                                                    </td>
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
<!-- row closed -->
@endsection
@section('js')

@endsection
