@extends('layouts.master')
@section('css')

@section('title')
{{trans('main_trans.students_add')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main_trans.students_add')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.students_add')}}</li>
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


            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post"  action="{{route('students.update',$student->id)}}" autocomplete="off">
                    {{method_field('patch')}}
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('main_trans.personal_information')}}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('main_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="name_ar"  class="form-control" value="{{$student->getTranslation('name','ar')}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('main_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="name_en" type="text" value="{{$student->getTranslation('name','en')}}" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('main_trans.Email')}} : </label>
                                    <input type="email"  name="email" class="form-control" value="{{$student->email}}" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('main_trans.Password')}} :</label>
                                    <input  type="password" name="password" class="form-control" value="{{$student->password}}" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{trans('main_trans.gender')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="gender_id">
                                        <option selected disabled>{{trans('main_trans.Choose')}}...</option>
                                        @foreach($gender as $g)
                                            <option  value="{{ $g->id }}" {{$g->id == $student->gender_id ? 'selected' : '' }}>{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">{{trans('main_trans.Nationality')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="nationalitie_id">
                                        <option selected disabled>{{trans('main_trans.Choose')}}...</option>
                                        @foreach($nationality as $nal)
                                            <option  value="{{ $nal->id }}" {{$nal->id == $student->nationalitie_id ? 'selected' : ''}}>{{ $nal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{trans('main_trans.blood_type')}} : </label>
                                    <select class="custom-select mr-sm-2" name="blood_id">
                                        <option selected disabled>{{trans('main_trans.Choose')}}...</option>
                                        @foreach($blood as $bg)
                                            <option value="{{ $bg->id }}" {{$bg->id == $student->blood_id ? 'selected' : ''}}>{{ $bg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('main_trans.Date_of_Birth')}}  :</label>
                                    <input class="form-control" type="text"  id="datepicker-action" name="Date_Birth" data-date-format="yyyy-mm-dd" value ="{{$student->Date_Birth}}">
                                </div>
                            </div>

                        </div>

                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('main_trans.Student_information')}}</h6><br>
                    <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Grade_id">{{trans('main_trans.grade_name')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="Grade_id">
                                        <option selected disabled>{{trans('main_trans.Choose')}}...</option>
                                        @foreach($Grade as $c)
  <option  value="{{ $c->id }}" {{$c->id == $student->Grade_id ? 'selected' : ''}}>{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">{{trans('main_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="Classroom_id">
                                        <option value="{{$student->Classroom_id}}">{{$student->classroom->name}} </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{trans('main_trans.sections')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">
                                    <option value="{{$student->section_id}}">{{$student->section->name}} </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{trans('main_trans.parent')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parent_id">
                                        <option selected disabled>{{trans('main_trans.Choose')}}...</option>
                                       @foreach($myparent as $parent)
                                            <option value="{{ $parent->id }}" {{$parent->id == $student->parent_id ? 'selected' : ''}}>{{ $parent->Name_Father }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{trans('main_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    <option selected disabled>{{trans('main_trans.Choose')}}...</option>
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == $student->academic_year ? 'selected' : ''}} >{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        </div><br>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('main_trans.submit')}}</button>
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

   $('select[name="Grade_id"]').on('change',function(){

   let Grade_id = $(this).val();

   if(Grade_id){
     
     $.ajax({
      type : 'get',
      dataType : 'json',
      url : '/students/getclassbyajax/' + Grade_id,

      success:function(data){

        $('select[name="Classroom_id"]').empty();
        $('select[name="Classroom_id"]').append('<option selected disabled> choose  </option>');

        $.each(data,function(key,value){
       

      $('select[name="Classroom_id"]').append('<option value= "'+value +'">' +key+ '</option>');


        });

      }
     

     });
    

   }


   }) 




});




</script>



<script>

$(document).ready(function(){

   $('select[name="Grade_id"]').on('change',function(){

   let Grade_id = $(this).val();

   if(Grade_id){
     
     $.ajax({
      type : 'get',
      dataType : 'json',
      url : '/students/getclassbyajax/' + Grade_id,

      success:function(data){

        $('select[name="Classroom_id"]').empty();
        $('select[name="Classroom_id"]').append('<option selected disabled> choose  </option>');

        $.each(data,function(key,value){
       

      $('select[name="Classroom_id"]').append('<option value= "'+key +'">' +value+ '</option>');


        });

      }
     

     });
    

   }


   }) 




});




</script>


<script>

$(document).ready(function(){

   $('select[name="Classroom_id"]').on('change',function(){

   let Classroom_id = $(this).val();

   if(Classroom_id){
     
     $.ajax({
      type : 'get',
      dataType : 'json',
      url : '/students/getsectionbyajax/' + Classroom_id,

      success:function(data){

        $('select[name="section_id"]').empty();

        $.each(data,function(key,value){
       

      $('select[name="section_id"]').append('<option value= "'+key +'">' +value+ '</option>');


        });

      }
     

     });
    

   }


   }) 




});




</script>

@endsection
