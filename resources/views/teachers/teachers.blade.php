@extends('layouts.master')
@section('css')

@section('title')
    {{trans('main_trans.teachers_all')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main_trans.teachers_all')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.teachers_all')}}</li>
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

            <a href="{{route('teachers.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('main_trans.Add_Teacher') }}</a><br><br>

<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('main_trans.teacher_name') }}</th>
            <th>{{ trans('main_trans.gender') }}</th>
            <th>{{ trans('main_trans.joining_date') }}</th>
            <th>{{ trans('main_trans.spec') }}</th>
            <th>{{ trans('main_trans.Processes') }}</th>
           
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
      @foreach($data as $d)
            <tr>
                <?php $i++; ?>
                <td> {{$i}} </td>
                <td> {{$d->Name}} </td>
                <td> {{$d->gender->name}} </td>
                <td> {{$d->Joining_Date}} </td>
                <td> {{$d->spec->name}} </td>
               
                <td>
         <a href="{{route('teachers.edit',$d->id)}}"  title="{{ trans('main_trans.Edit') }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
 <a type="button" class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
data-toggle="modal" data-target="#del{{$d->id}}"   title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></a>



        <div class="modal" id="del{{ $d->id }}" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
            id="exampleModalLabel">
            {{ trans('main_trans.delete_class') }}
        </h5>
        <button type="button" class="close" data-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="{{route('teachers.destroy','test')}}" method="post">
           {{method_field('delete')}}
            @csrf
            
            <input id="id" type="text" name="id" class="form-control"
                value="{{ $d->id }}">
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








                </td>
            </tr>
            @endforeach
       
    </table>
</div>







        </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
