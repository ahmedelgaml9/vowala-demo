@extends('coordinators.shipmentCoordinator.dashboard')
@section('content')
<div class="row">
{!! Form::open(array('route' =>'shipmentCoordinator.shipment.store','files'=>true)) !!}
    <div class="message" style="padding:26px; ">
    </div><!-- div to display message after insert -->
@include ('coordinators.shipmentCoordinator.shipment.form',['submitButton' => 'Submit Data'])
{!! Form::close() !!}
</div>
@endsection
