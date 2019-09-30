@extends('admin.dashboard')
@section('content') 
<div class="row">
     {!! Form:: model($method,array('method' => 'PATCH','action' => ['ShipmentController@update',$method->id], 'files'=>true,'class' => 'ajax-form-request')) !!}
    <div class="message" style="padding:26px;">
    </div><!-- div to display message after insert -->
 @include ('admin.shipment.form2',['submitButton' => "Update"])
 {!! Form::close() !!} 
</div>
@endsection