@extends('layouts.master')
@section('css')

@section('title')
    {{trans('main_trans.students_all')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main_trans.students_all')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.students_all')}}</li>
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


<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">
            <a href="{{route('students.create')}}" class="btn btn-success btn-sm" role="button"
                aria-pressed="true">{{trans('main_trans.students_add')}}</a><br><br>
            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                        data-page-length="50"
                        style="text-align: center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{trans('main_trans.name')}}</th>
                        <th>{{trans('main_trans.Email')}}</th>
                        <th>{{trans('main_trans.gender')}}</th>
                        <th>{{trans('main_trans.Grade')}}</th>
                        <th>{{trans('main_trans.classrooms')}}</th>
                        <th>{{trans('main_trans.section')}}</th>
                        <th>{{trans('main_trans.Processes')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->gender->name}}</td>
                        <td>{{$student->grade->name}}</td>
                        <td>{{$student->classroom->name}}</td>
                        <td>{{$student->section->name}}</td>
                            <td>
                                <a href="{{route('students.edit',$student->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del{{ $student->id }}" title="{{ trans('main_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                <a href="{{route('students.show',$student->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                        <!-- delete !-->

<div class="modal" id="del{{ $student->id }}" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
            id="exampleModalLabel">
            {{ trans('main_trans.delete_student') }}
        </h5>
        <button type="button" class="close" data-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="{{route('students.destroy','test')}}" method="post">
         {{method_field('delete')}}  
            @csrf
            
            <input id="id" type="hidden" name="id" class="form-control"
                value="{{ $student->id }}">
                <p>{{ trans('main_trans.delete_confirmation') }} </p>
                <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('main_trans.Close') }}</button>
                <button type="submit"
                    class="btn btn-danger">{{ trans('main_trans.Delete') }}</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
                    





                    @endforeach
                </table>
            </div>
        </div>
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
