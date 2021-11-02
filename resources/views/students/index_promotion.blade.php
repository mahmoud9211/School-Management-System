@extends('layouts.master')
@section('css')

@section('title')
{{trans('main_trans.students_promotions_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main_trans.students_promotions_list')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Home')}}</a></li>
                <li class="breadcrumb-item active"> {{trans('main_trans.students_promotions_list')}}</li>
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

            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                   {{trans('main_trans.Undo all')}}
                                </button>
                                <br><br>


         
            <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{trans('main_trans.name')}}</th>
                                            <th class="alert-danger">{{trans('main_trans.previous_grade')}}</th>
                                            <th class="alert-danger">{{trans('main_trans.academic_year')}}</th>
                                            <th class="alert-danger">{{trans('main_trans.previous_classroom')}}</th>
                                            <th class="alert-danger">{{trans('main_trans.previous_section')}}</th>
                                            <th class="alert-success">{{trans('main_trans.current_grade')}}</th>
                                            <th class="alert-success">{{trans('main_trans.academic_year_current')}}</th>
                                            <th class="alert-success">{{trans('main_trans.current_classroom')}}</th>
                                            <th class="alert-success">{{trans('main_trans.current_section')}}</th>
                                            <th style="width:25%">{{trans('main_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$promotion->student->name}}</td>
                                                <td>{{$promotion->grade->name}}</td>
                                                <td>{{$promotion->from_academic_year}}</td>
                                                <td>{{$promotion->classroom->name}}</td>
                                                <td>{{$promotion->section->name}}</td>
                                                <td>{{$promotion->t_grade->name}}</td>
                                                <td>{{$promotion->to_academic_year}}</td>
                                                <td>{{$promotion->t_classroom->name}}</td>
                                                <td>{{$promotion->t_section->name}}</td>
                                                <td>
                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Delete_one{{$promotion->id}}">ارجاع الطالب</button>
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">تخرج الطالب</button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="Delete_one{{$promotion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('main_trans.Undo_student')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('promotions.delete',$promotion->id)}}" method="post">
                    @csrf
                   

                    <input type="hidden" name="page_id" value="1">
                    <h5 style="font-family: 'Cairo', sans-serif;">  {{trans('main_trans.undoall_students_msg')}}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('main_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





                                  





                                        @endforeach
                                    </table>
                                </div>




                                <!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_all" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('main_trans.Undo all')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('promotions.destroy','test')}}" method="post">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="page_id" value="1">
                    <h5 style="font-family: 'Cairo', sans-serif;">  {{trans('main_trans.undoall_students_msg')}}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('main_trans.submit')}}</button>
                    </div>
                </form>
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
