@extends('admin.dashboard')
@section('content') 
<div class="row">
     {!! Form:: model($row,array('method' => 'PATCH','action' => ['CountryController@update',$row->id], 'files'=>true,'class' => 'ajax-form-request')) !!}
    <div class="message" style="padding:26px;">
    </div><!-- div to display message after insert -->
 @include ('coordinators.shipmentCoordinator.country.form',['submitButton' => "Update"])
 {!! Form::close() !!} 
</div>
@endsection