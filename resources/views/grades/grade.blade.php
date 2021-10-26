@extends('layouts.master')
@section('css')

@section('title')
    {{trans('main_trans.Grades_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main_trans.Grades_list')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{url('/')}}" class="default-color">{{trans('main_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.Grades_list')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">   
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">

<div class="col-sm-6 col-md-4 col-xl-3">
    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">{{trans('main_trans.add_grade')}}</a>
</div>
<br>

            <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>{{trans('main_trans.grade_name')}}</th>
                      <th>{{trans('main_trans.notes')}}</th>
                      <th>{{trans('main_trans.operations')}}</th>
                  </tr>
              </thead>
              <tbody>

              @php
             $i = 1;
              @endphp
                  @foreach($grade as $g)
                  <tr>
                      <td>{{$i++}}</td>
                      <td>{{$g->name}}</td>
                      <td>{{$g->notes}}</td>
                      <td>
<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
 data-toggle="modal" data-target="#edit{{$g->id}}" ><i class="fa fa-edit"></i></a>

  <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
 data-toggle="modal" data-target="#del{{$g->id}}"><i class=" fa fa-trash"></i></a>


                      </td>
                  </tr>

<!-- modal for Edit data !-->

<div class="modal" id="edit{{$g->id}}">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content modal-content-demo">
<div class="modal-header">
<h6 class="modal-title">{{trans('main_trans.grade_update')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">


<form  action="{{route('grade.update','test')}}"  method="post">
{{ method_field('patch') }}
@csrf
<div class="form-row">
<div class="col-md-6">
<div class="form-group">
    <input type="hidden" value="{{$g->id}}" name="id">
<label for="exampleInputEmail1">{{trans('main_trans.grade_name_ar')}}</label>
<input type="text" class="form-control" name="name" id="exampleInputEmail1" value="{{$g->getTranslation('name','ar')}}" >
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="exampleInputPassword1">{{trans('main_trans.grade_name_en')}}</label>
<input type="text" class="form-control" name="name_en" id="exampleInputEmail1" value="{{$g->getTranslation('name','en')}}" >

</div>
</div>
</div>

<div class="form-group">
<label for="exampleInputPassword1">{{trans('main_trans.notes')}}</label>
<textarea type="text" name="notes" class="form-control" id="exampleInputPassword1" >{{$g->notes}} </textarea>
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



<!-- modal for delete data !-->

<div class="modal" id="del{{$g->id}}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">{{trans('main_trans.del_grade')}} </h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                   type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{route('grade.destroy','test')}}" method="post">
                                    {{method_field('delete')}}
                                    @csrf
									

                                    <div class="modal-body">
									<input type ="hidden" id="id" name="id" value="{{$g->id}}">
                                        <p>{{trans('main_trans.delete_confirmation')}}</p><br>
                                       
	<input type="text" class="form-control" value="{{$g->name}}" name="name"  aria-describedby="emailHelp" readonly >



                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.cancel')}}</button>
                                        <button type="submit" class="btn btn-danger">{{trans('main_trans.confirm')}}</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>



                  







@endforeach

</tbody>


</table>




          </div>

    <!-- modal for insert data !-->

	<div class="modal" id="modaldemo8">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">{{trans('main_trans.add_grade')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">


					<form  action="{{route('grade.store')}}"  method="post">
						@csrf
<div class="form-row">
    <div class="col-md-6">
  <div class="form-group">
    <label for="exampleInputEmail1">{{trans('main_trans.grade_name_ar')}}</label>
    <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" >
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label for="exampleInputPassword1">{{trans('main_trans.grade_name_en')}}</label>
    <input type="text" class="form-control" name="name_en" id="exampleInputEmail1" aria-describedby="emailHelp" >

  </div>
</div>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">{{trans('main_trans.notes')}}</label>
    <textarea type="text" name="notes" class="form-control" id="exampleInputPassword1" > </textarea>
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



@endsection
