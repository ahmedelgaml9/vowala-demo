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
    <h2 class="panel-title">Header Settings</h2>
 </header>
 <div class="panel-body">
<div class="row">
    <div id="test1" class="col s12">
     <div class="form-group">
        <div class="col-sm-6">
            <div class="btn teal lighten-1">
                <span>{{trans('lang.photo')}}</span>
                {!!Form::file('logo', null,array('id'=>'photo'))!!}
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-6">
         <label for="phone">{{trans('lang.mobile')}}</label>
            {!!Form::text('mobile', null,array('class'=>'form-control','id'=>'mobile'))!!}
        </div>
     </div>
    
     <div class="form-group">
        <div class="col-sm-6">
            <label for="address">{{trans('lang.message')}}</label>
            {!!Form::text('welcome', null,array('class'=>'form-control'))!!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label for="address">{{trans('lang.ar_mesaage')}}</label>
            {!!Form::text('welcome_ar', null,array('class'=>'form-control'))!!}
        </div>
    </div>

</div>
</section>
</div>
</div>
  {!! Form::submit('edit', array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
{!! Form::close() !!}
@stop

