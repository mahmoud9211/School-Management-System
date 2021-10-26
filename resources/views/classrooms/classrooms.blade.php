@extends('layouts.master')

@section('title')
{{ trans('main_trans.title_page') }}

@endsection
@section('page-header')
<!-- breadcrumb -->

@section('content')
<!-- row -->
<div class="row">

<div class="col-xl-12 mb-30">
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

<button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
{{ trans('main_trans.add_class') }}
</button>


<button type="button" class="button x-small" id="btn_delete_all">
                    {{ trans('main_trans.delete_checkbox') }}
                </button>

<br><br>

<br><br>

                <form action="{{route('classrooms.filter')}}" method="POST">
                   @csrf

<select class="form-select" aria-label="Disabled select example"  name="grade_id" required
        onchange="this.form.submit()">
  <option selected disabled>{{ trans('main_trans.Search_By_Grade') }}</option>
  @foreach ($grade as $g)
  <option value="{{ $g->id }}">{{ $g->name }}</option>
  @endforeach
  
</select>
</form>

<div class="table-responsive">
<table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
style="text-align: center">
<thead>
<tr>
<th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>    
<th>#</th>
<th>{{ trans('main_trans.Name_class') }}</th>
<th>{{ trans('main_trans.grade_name') }}</th>
<th>{{ trans('main_trans.Processes') }}</th>
</tr>
</thead>
<tbody>

@if (isset($details))

<?php $classroom = $details; ?>
@else

<?php $classroom = $classroom; ?>
@endif





@php
$i=1;
@endphp

@foreach ($classroom as $My_Class)
<tr>
<td><input type="checkbox" name="bo1"  value="{{ $My_Class->id }}" class="box1" ></td>
<td>{{ $i++ }}</td>
<td>{{ $My_Class->name }}</td>
<td>{{ $My_Class->Grades->name }}</td>
<td>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal"
    data-target="#edit{{ $My_Class->id }}"
    title="{{ trans('main_trans.Edit') }}"><i class="fa fa-edit"></i></button>
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
    data-target="#delete{{ $My_Class->id }}"
    title="{{ trans('main_trans.Delete') }}"><i
        class="fa fa-trash"></i></button>
</td>
</tr>



<!-- edit_modal_Grade  -->
<div class="modal fade" id="edit{{ $My_Class->id }}" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
id="exampleModalLabel">
{{ trans('main_trans.edit_class') }}
</h5>
<button type="button" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<!-- edit_form -->
<form action="{{route('classrooms.update')}}" method="post">
@csrf
<div class="row">
<div class="col">
<label for="Name"
class="mr-sm-2">{{ trans('main_trans.Name_class_ar') }}
:</label>
<input id="Name" type="text" name="name"
class="form-control"
value="{{ $My_Class->getTranslation('name', 'ar') }}"
>
<input id="id" type="hidden" name="id" class="form-control"
value="{{ $My_Class->id }}">
</div>
<div class="col">
<label for="Name_en"
class="mr-sm-2">{{ trans('main_trans.Name_class_en') }}
:</label>
<input type="text" class="form-control"
value="{{ $My_Class->getTranslation('name', 'en') }}"
name="name_class_en" >
</div>
</div><br>
<div class="form-group">
<label
for="exampleFormControlTextarea1">{{ trans('main_trans.grade_name') }}
:</label>
<select class="form-control form-control-lg"
id="exampleFormControlSelect1" name="grade_id">

@foreach ($grade as $g)
<option value="{{ $g->id }}" {{$g->id == $My_Class->grade_id ? 'selected' : '' }}>
{{ $g->name }}
</option>
@endforeach
</select>

</div>
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

<!-- delete_modal_Grade  -->
    <div class="modal fade" id="delete{{ $My_Class->id }}" tabindex="-1" role="dialog"
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
        <form action="{{route('classrooms.delete')}}" method="post">
           
            @csrf
            
            <input id="id" type="hidden" name="id" class="form-control"
                value="{{ $My_Class->id }}">
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
 


























<!-- add_modal_class -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
{{ trans('main_trans.add_class') }}
</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<form class=" row mb-30" action="{{route('classrooms.store')}}" method="POST">
@csrf

<div class="card-body">
<div class="repeater">
<div data-repeater-list="List_Classes">
<div data-repeater-item>

<div class="row">

    <div class="col">
        <label for="Name"
            class="mr-sm-2">{{ trans('main_trans.Name_class_ar') }}
            :</label>
        <input class="form-control" type="text" name="name"  />
    </div>


    <div class="col">
        <label for="Name"
            class="mr-sm-2">{{ trans('main_trans.Name_class_en') }}
            :</label>
        <input class="form-control" type="text" name="name_class_en"  />
    </div>


    <div class="col">
        <label for="Name_en"
            class="mr-sm-2">{{ trans('main_trans.grade_name') }}
            :</label>

        <div class="box">
            <select class="fancyselect" name="grade_id">
                @foreach ($grade as $g)
                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="col">
        <label for="Name_en"
            class="mr-sm-2">{{ trans('main_trans.Processes') }}
            :</label>
        <input class="btn btn-danger btn-block" data-repeater-delete
            type="button" value="{{ trans('main_trans.Delete') }}" />
    </div>
</div>
</div>
</div>
<div class="row mt-20">
<div class="col-12">
<input class="button" data-repeater-create type="button" value="{{ trans('main_trans.add_row') }}"/>
</div>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary"
data-dismiss="modal">{{ trans('main_trans.Close') }}</button>
<button type="submit"
class="btn btn-success">{{ trans('main_trans.submit') }}</button>
</div>










</div>
</div>
</form>
</div>


</div>

</div>
















</div>
</div>



<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('main_trans.delete_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('classrooms.deletechecked')}}" method="POST">
                @csrf
                <div class="modal-body">
                    {{ trans('main_trans.Warning_Grade') }}
                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('main_trans.Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('main_trans.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>





</div>

</div>

<!-- row closed -->
@endsection
@section('js')

<script>

function CheckAll(classname,elem) 
{

let elements  = document.getElementsByClassName(classname);
let L = elements.length;

if (elem.checked)
{
    for(let i=0; i < L ; i++){

        elements[i].checked = true;
    }
}else
{
    for (let i = 0; i < L ; i++){

    elements[i].checked = false;
    }
}


}


</script>

<script type="text/javascript">
    $(function() {

        $("#btn_delete_all").click(function() {
            let selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
</script>

@endsection