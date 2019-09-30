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
    <h2 class="panel-title">{{trans('lang.settings')}}</h2>
 </header>
 <div class="panel-body">
<div class="row">
    <div id="test1" class="col s12">
   
    <div class="form-group">
        <div class="col-sm-6">
            <label for="phone">{{trans('lang.phone')}}</label>

            {!!Form::text('phone', null,array('class'=>'form-control','id'=>'phone'))!!}
        </div>
     </div>
  
        
    <div class="form-group">
        <div class="col-sm-6">
            <label for="email">{{trans('lang.email')}}</label>
            {!!Form::email('email', null,array('class'=>'form-control','id'=>'support'))!!}
           
        </div>
    </div>
     <div class="form-group">
        <div class="col-sm-6">
            <label for="address">{{trans('lang.address')}}</label>
            {!!Form::text('address', null,array('class'=>'form-control','id'=>'address'))!!}
        </div>
    </div>

     <div class="form-group">
        <div class="col-sm-6">
            <label for="email">{{trans('lang.phone')}}</label>
            {!!Form::text('working_hours',null,array('class'=>'form-control','id'=>'support'))!!}
           
        </div>
    </div>
      

   <div class="form-group">
        <div class="col-sm-6">
            <label for="phone">{{trans('lang.fb')}}</label>

            {!!Form::text('fb', null,array('class'=>'form-control','id'=>'phone'))!!}
        </div>
     </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label for="phone">{{trans('lang.tw')}}</label>
            {!!Form::text('tw', null,array('class'=>'form-control','id'=>'phone'))!!}
        </div>
     </div>
  
        
     <div class="form-group">
        <div class="col-sm-6">
            <label for="phone">Instagram</label>

            {!!Form::text('ins', null,array('class'=>'form-control','id'=>'phone'))!!}
        </div>
     </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label for="phone">Behance</label>

            {!!Form::text('be', null,array('class'=>'form-control','id'=>'phone'))!!}
        </div>
     </div>
    <div class="form-group">
        <div class="col-sm-6">
         <label for="phone">Linkedin</label>
            {!!Form::text('linkedin', null,array('class'=>'form-control','id'=>'mobile'))!!}
        </div>
     </div>
      
    <div class="form-group">
        <div class="col-sm-6">
            <label for="email">Google Plus</label>
            {!!Form::text('gp', null,array('class'=>'form-control','id'=>'support'))!!}
           
        </div>
    </div>


        <div class="form-group">
        <div class="col-sm-6">
         <label for="address">{{trans('lang.ar_address')}}</label>
            {!!Form::text('address_ar', null,array('class'=>'form-control','id'=>'address'))!!}
        </div>
     </div>
   
</div>
</section>
</div>
</div>
  {!! Form::submit('edit', array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
{!! Form::close() !!}
@stop

