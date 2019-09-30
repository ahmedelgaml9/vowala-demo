@extends('admin.dashboard')
@section('content')

{!! Form:: model($main,array('method' => 'PUT','action' => ['MainController@update'], 'files'=>true,'class' =>
'ajax-form-request')) !!}
@if(Session::has('flash_message'))

 <div class="alert alert-danger text-center"><em> {!! session('flash_message') !!}</em></div>
        @endif
        <div class="row">
  <div class="col-md-12">
     <section class="panel">
     <header class="panel-heading">                                             
    <h2 class="panel-title">{{trans('lang.baners')}}</h2>
 </header>
 <div class="panel-body">
<div class="row">
    <div id="test1" class="col s12">
     <div class="form-group">
        <div class="col-sm-6">
            <div class="btn teal lighten-1">
                <span>Banner</span>
                {!!Form::file('homebanner', null,array('id'=>'photo'))!!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label for="phone">{{trans('lang.title')}}</label>

            {!!Form::text('home_title', null,array('class'=>'form-control','id'=>'phone'))!!}
        </div>
     </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label for="phone">{{trans('lang.ar_title')}}</label>

            {!!Form::text('home_title_ar', null,array('class'=>'form-control','id'=>'phone'))!!}
        </div>
     </div>
     
    <div class="form-group">
        <div class="col-sm-6">
         <label for="phone">{{trans('lang.link')}}</label>
            {!!Form::text('home_link', null,array('class'=>'form-control','id'=>'mobile'))!!}
        </div>
     </div>
    </div>
</div>
</section>
</div>
</div>
  {!! Form::submit('edit', array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
{!! Form::close() !!}
@stop

