@extends('coordinators.shipmentCoordinator.dashboard')
@section('content')
     {!! Form:: model($method,array('method' => 'PATCH','action' => ['Coordinators\shipmentCoordinator\ShipmentController@update',$method->id], 'files'=>true)) !!}
    <div class="message">
    </div><!-- div to display message after insert -->
    @include ('coordinators.shipmentCoordinator.shipment.form',['submitButton' => "Update"])
    {!! Form::close() !!}
 @endsection
