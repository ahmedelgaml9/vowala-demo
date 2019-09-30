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
    <h2 class="panel-title">Main Settings</h2>
 </header>
 <div class="panel-body">
<div class="row">
    <div id="test1" class="col s12">
   
    <div class="form-group">
        <div class="col-sm-6">
            <label for="phone">Phone</label>

            {!!Form::text('phone', null,array('class'=>'form-control','id'=>'phone'))!!}
        </div>
     </div>
    <div class="form-group">
        <div class="col-sm-6">
         <label for="phone">Mobile Number</label>
            {!!Form::text('mobile', null,array('class'=>'form-control','id'=>'mobile'))!!}
        </div>
     </div>
        
    <div class="form-group">
        <div class="col-sm-6">
            <label for="email">Support Email</label>
            {!!Form::email('email', null,array('class'=>'form-control','id'=>'support'))!!}
           
        </div>
    </div>
     <div class="form-group">
        <div class="col-sm-6">
            <label for="address">Address</label>
            {!!Form::text('address', null,array('class'=>'form-control','id'=>'address'))!!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-6">
         <label for="address">Map</label>

            {!!Form::text('map', null,array('class'=>'form-control','id'=>'address'))!!}
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

