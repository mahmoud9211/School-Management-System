@extends('layouts.master')
@section('css')

@section('title')
{{ trans('main_trans.Add_Teacher') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('main_trans.Add_Teacher') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.Add_Teacher') }}</li>
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

            @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">


                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('teachers.update',$data->id)}}" method="post">
                                {{method_field('patch')}}
                             @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('main_trans.Email')}}</label>
                                    <input type="email" name="Email" class="form-control" value="{{$data->Email}}">
                                    @error('Email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('main_trans.Password')}}</label>
                                    <input type="password" name="Password" class="form-control" value="{{$data->Password}}">
                                    @error('Password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('main_trans.teacher_Name_ar')}}</label>
                                    <input type="text" name="Name_ar" class="form-control" value="{{$data->getTranslation('Name','ar')}}">
                                    @error('Name_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('main_trans.teacher_Name_en')}}</label>
                                    <input type="text" name="Name_en" class="form-control" value="{{$data->getTranslation('Name','en')}}">
                                    @error('Name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputCity">{{trans('main_trans.spec')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="Specialization_id">
                                        <option selected disabled>{{trans('main_trans.Choose')}}...</option>
                                        @foreach($spec as $s)
                                            <option value="{{$s->id}}" {{$s->id == $data->Specialization_id ? 'selected' : ''}} >{{$s->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Specialization_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputState">{{trans('main_trans.gender')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="Gender_id">
                                        <option selected disabled>{{trans('main_trans.Choose')}}...</option>
                                        @foreach($gender as $g)
                                            <option value="{{$g->id}}" {{$g->id == $data->Gender_id ? 'selected' : ''}} >{{$g->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Gender_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('main_trans.joining_date')}}</label>
                                    <div class='input-group date'>
                                        <input class="form-control" type="text"  id="datepicker-action" value="{{$data->Joining_Date}}" name="Joining_Date" data-date-format="yyyy-mm-dd"  required>
                                    </div>
                                    @error('Joining_Date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{trans('main_trans.Address')}}</label>
                                <textarea class="form-control" name="Address"
                                          id="exampleFormControlTextarea1" rows="4">{{$data->Address}}</textarea>
                                @error('Address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('main_trans.submit')}}</button>
                    </form>
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
