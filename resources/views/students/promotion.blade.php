@extends('layouts.master')
@section('css')

@section('title')
    {{trans('main_trans.students_promotions')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main_trans.students_promotions')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.students_promotions')}}</li>
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


            <h6 style="color: red;font-family: Cairo">{{trans('main_trans.old_grade')}}</h6><br>

<form method="post" action="{{route('promotions.store')}}">
    @csrf
    <div class="form-row">
        <div class="form-group col">
            <label for="inputState">{{trans('Students_trans.Grade')}}</label>
            <select class="custom-select mr-sm-2" name="from_grade" required>
                <option selected disabled>{{trans('main_trans.Choose')}}...</option>
                @foreach($grades as $g)
                    <option value="{{$g->id}}">{{$g->name}}</option>
                @endforeach
            </select>
         @error('from_grade')
         <span class="text-danger">{{$message}} </span>
         @enderror

        </div>
        <div class="form-group col">
            <label for="Classroom_id">{{trans('main_trans.classrooms')}} : <span
                    class="text-danger">*</span></label>
            <select class="custom-select mr-sm-2" name="from_classroom" required>

            </select>
            @error('from_classroom')
         <span class="text-danger">{{$message}} </span>
         @enderror
        </div>

        <div class="form-group col">
            <label for="section_id">{{trans('main_trans.section')}} : </label>
            <select class="custom-select mr-sm-2" name="from_section" required>

            </select>

            @error('from_section')
         <span class="text-danger">{{$message}} </span>
         @enderror
        </div>

        <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{trans('main_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="from_academic_year">
                                        <option selected disabled>{{trans('main_trans.Choose')}}...</option>
                                        @php
                                            $current_year = date("Y");
                                        @endphp
                                        @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                            <option value="{{ $year}}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>




    </div>
    <br><h6 style="color: red;font-family: Cairo">{{trans('main_trans.new_grade')}}</h6><br>

    <div class="form-row">
        <div class="form-group col">
            <label for="inputState">{{trans('main_trans.Grade')}}</label>
            <select class="custom-select mr-sm-2" name="to_grade" >
                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                @foreach($grades as $g)
                    <option value="{{$g->id}}">{{$g->name}}</option>
                @endforeach
            </select>

            @error('to_grade')
         <span class="text-danger">{{$message}} </span>
         @enderror
        </div>
        <div class="form-group col">
            <label for="Classroom_id">{{trans('main_trans.classrooms')}}: <span
                    class="text-danger">*</span></label>
            <select class="custom-select mr-sm-2" name="to_classroom" >

            </select>

            @error('to_classroom')
         <span class="text-danger">{{$message}} </span>
         @enderror
        </div>
        <div class="form-group col">
            <label for="section_id">:{{trans('main_trans.section')}} </label>
            <select class="custom-select mr-sm-2" name="to_section" >

            </select>

            @error('to_section')
         <span class="text-danger">{{$message}} </span>
         @enderror
        </div>


        <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{trans('main_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="to_academic_year">
                                        <option selected disabled>{{trans('main_trans.Choose')}}...</option>
                                        @php
                                            $current_year = date("Y");
                                        @endphp
                                        @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                            <option value="{{ $year}}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>





    </div>
    <button type="submit" class="btn btn-primary">{{trans('main_trans.submit')}}</button>
</form>







        </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

<script>

$(document).ready(function(){

   $('select[name="from_grade"]').on('change',function(){

   let from_grade = $(this).val();

   if(from_grade){
     
     $.ajax({
      type : 'get',
      dataType : 'json',
      url : '/students/getclassbyajax/' + from_grade,

      success:function(data){

        $('select[name="from_classroom"]').empty();
        $('select[name="from_classroom"]').append('<option selected disabled> choose  </option>');

        $.each(data,function(key,value){
       

      $('select[name="from_classroom"]').append('<option value= "'+key +'">' +value+ '</option>');


        });

      }
     

     });
    

   }


   }) 




});




</script>


<script>

$(document).ready(function(){

   $('select[name="from_classroom"]').on('change',function(){

   let from_classroom = $(this).val();

   if(from_classroom){
     
     $.ajax({
      type : 'get',
      dataType : 'json',
      url : '/students/getsectionbyajax/' + from_classroom,

      success:function(data){

        $('select[name="from_section"]').empty();

        $.each(data,function(key,value){
       

      $('select[name="from_section"]').append('<option value= "'+key +'">' +value+ '</option>');


        });

      }
     

     });
    

   }


   }) 




});




</script>














@endsection
