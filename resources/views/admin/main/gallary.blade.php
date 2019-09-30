@extends('admin.dashboard')
@section('content')   
<!-- end START BREADCRUMB -->
{!! Form:: open(array('method' => 'post','action' => ['MainController@create'], 'files'=>true,'class' => 'ajax-form-request')) !!}
<div class="message" style="padding:26px; ">
</div>
<div class="block">
   <div class="file-field input-field s6">
    <div class="btn teal lighten-1">
        <span>{{ trans('lang.image')}}</span>
        {!!Form::file('photo', null,array('id'=>'photo'))!!}
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="{{ trans('lang.image')}}">
    </div>
    <label class="error">{{ $errors->first('photo') }}</label>
</div> 
    {!! Form::submit('Upload', array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
</div>
{!! Form::close() !!}    
@foreach($photoes as $ph)
<img src="{{ asset('adminstyle/assets/images/gallery/'.$ph->photo) }}" height="150" width="300"><br>
{!! Form::open(['action'=>['MainController@destroy',$ph->id],'method'=>'delete']) !!}
<button type="submit" class="btn btn-danger red" onclick='return confirm("Are You sure!!")' style="display: inline"><span class="fa fa-times"></span></button>
{!! Form::close() !!}
@endforeach
@stop
