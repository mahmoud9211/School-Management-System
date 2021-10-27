@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
@section('title')
{{trans('main_trans.sections')}}
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
<div class="row">
<div class="col-sm-6">
<h4 class="mb-0"> {{trans('main_trans.sections')}}</h4>
</div>
<div class="col-sm-6">
<ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
<li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Home')}}</a></li>
<li class="breadcrumb-item active">{{trans('main_trans.sections')}}</li>
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

<a type="button" class="btn btn-secondary" style="color:white;" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">{{trans('main_trans.add_section')}}</a>

<br> <br>

<div id="accordion">

@foreach($grade as $g)
  <h3>{{$g->name}}</h3>

  <div>


  <div class="table">
<table  class="table table-striped table-bordered p-0">
<thead>
<tr>
<th>#</th>
<th>{{trans('main_trans.section_name')}}</th>
<th>{{trans('main_trans.Name_class')}}</th>
<th>{{trans('main_trans.status')}}</th>
<th>{{trans('main_trans.Processes')}}</th>
</tr>
</thead>
<tbody>

@php
$i = 1;
@endphp
@foreach($g->sections as $sec)
<tr>
<td>{{$i++}}</td>
<td>{{$sec->name}}</td>
<td>{{$sec->classes->name}}</td>

@if($sec->status == 1)
<td class="badge badge-success">{{trans('main_trans.active')}}</td>
@else
<td class="badge badge-danger">{{trans('main_trans.inactive')}}</td>
@endif




<td>
<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
data-toggle="modal" data-target="#edit{{$sec->id}}" ><i class="fa fa-edit"></i></a>

<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
data-toggle="modal" data-target="#del{{$sec->id}}"><i class=" fa fa-trash"></i></a>


</td>
</tr>


<div class="modal" id="edit{{ $sec->id }}" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" >
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
id="exampleModalLabel">
{{ trans('main_trans.edit_section') }}
</h5>
<button type="button" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<!-- edit_form -->
<form action="{{route('sections.update')}}" method="post">
@csrf
<div class="row">
<div class="col">
<label for="Name"
class="mr-sm-2">{{ trans('main_trans.section_name_ar') }}
:</label>
<input  type="text" name="name"
class="form-control"
value="{{ $sec->getTranslation('name', 'ar') }}"
>
<input id="id" type="hidden" name="id" class="form-control"
value="{{ $sec->id }}">
</div>
<div class="col">
<label for="Name_en"
class="mr-sm-2">{{ trans('main_trans.section_name_en') }}
:</label>
<input type="text" class="form-control"
value="{{ $sec->getTranslation('name', 'en') }}"
name="name_en" >
</div>
</div><br>
<div class="form-group">
<label
for="exampleFormControlTextarea1">{{ trans('main_trans.grade_name') }}
:</label>
<select class="form-control form-control-lg"
id="exampleFormControlSelect1" name="grade_id">

@foreach ($grade as $g)
<option value="{{ $g->id }}" {{$g->id == $sec->grade_id ? 'selected' : '' }}>
{{ $g->name }}
</option>
@endforeach
</select>

</div>




<div class="form-group">
<label
for="exampleFormControlTextarea1">{{ trans('main_trans.grade_name') }}
:</label>
<select class="form-control form-control-lg"
id="exampleFormControlSelect1" name="class_id">
@foreach($class as $c)
		<option value="{{$c->id}}" {{$c->id == $sec->class_id ? 'selected' : ''}}> {{$c->name}} </option>
		@endforeach


</select>

</div>




<div class="form-group">
    <label for="exampleFormControlSelect2">Example multiple select</label>
    <select multiple class="form-control" name="teacher_id[]" id="exampleFormControlSelect2">

    @foreach($sec->teachers as $t)
      <option selected value="{{$t->id}}">{{$t->Name}}</option>
     @endforeach

@foreach($teacher as $t)
      <option value="{{$t->id}}">{{$t->Name}}</option>
     @endforeach
    </select>
  </div>

<input type="checkbox" name="status" value="{{$sec->status}}" {{$sec->status == 1 ? 'checked' : ''}}> {{trans('main_trans.status')}}





<br><br>

<div class="modal-footer">
<button type="button" class="btn btn-secondary"
data-dismiss="modal">{{ trans('main_trans.Close') }}</button>
<button type="submit"
class="btn btn-success">{{ trans('main_trans.update_') }}</button>
</div>
</form>

</div>
</div>
</div>
</div>



<!-- delete !-->

<div class="modal" id="del{{ $sec->id }}" tabindex="-1" role="dialog"
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
        <form action="{{route('sections.delete')}}" method="post">
           
            @csrf
            
            <input id="id" type="hidden" name="id" class="form-control"
                value="{{ $sec->id }}">
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

</tbody>


</table>
</div>




  </div>
  @endforeach
  
  
</div>






<!-- modal for insert data !-->

<div class="modal" id="modaldemo8">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">{{trans('main_trans.add_section')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">


					<form  action="{{route('sections.store')}}"  method="post">
						@csrf
<div class="form-row">
    <div class="col-md-6">
  <div class="form-group">
    <label for="exampleInputEmail1">{{trans('main_trans.section_name_ar')}}</label>
    <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" >
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label for="exampleInputPassword1">{{trans('main_trans.section_name_en')}}</label>
    <input type="text" class="form-control" name="name_en" id="exampleInputEmail1" aria-describedby="emailHelp" >

  </div>
  </div>
</div>


<div class="form-row">
    <div class="col-md-6">
  <div class="form-group">
  <label >{{ trans('main_trans.grade_name') }}</label>

        <div class="box">
            <select class="form-control" name="grade_id">
                <option disabled ="" selected=""> {{trans('main_trans.selectgarde')}}</option>
                @foreach ($grade as $g)
                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                @endforeach
            </select>
        </div>
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
  <label for="exampleFormControlSelect1" >{{ trans('main_trans.Name_class') }}</label>
  <div class="box">
            <select class="form-control" name="class_id" id="exampleFormControlSelect1">

            
               
            </select>
        </div>

        <div class="form-group">
    <label for="exampleFormControlSelect2">Example multiple select</label>
    <select multiple class="form-control" name="teacher_id[]" id="exampleFormControlSelect2">
@foreach($teacher as $t)
      <option value="{{$t->id}}">{{$t->Name}}</option>
     @endforeach
    </select>
  </div>



   

  </div>
  </div>
</div>

  <div class="modal-footer">
						<button class="btn ripple btn-primary" type="submit">{{trans('main_trans.confirm')}}</button>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('main_trans.cancel')}}</button>
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

<script>
$(document).ready(function(){
    $( "#accordion" ).accordion();
$('select[name="grade_id"]').on('change',function(){
let grade_id = $(this).val();

if(grade_id)
{
  $.ajax({
    type : 'GET',
	url : '/classrooms/classbyajax/' + grade_id,
	dataType : 'json',
	success:function(data)
	{ 
		$('select[name="class_id"]').empty();
		$.each(data,function(key,value){
			$('select[name="class_id"]').append('<option value=" '+key+' " >'+ value+ '</option>') ;

		})
		


	}

  })

}



})





})

 


</script>





@endsection
