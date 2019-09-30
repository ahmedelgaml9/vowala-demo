@extends('coordinators.shipmentCoordinator.dashboard')
@section('content')
      @if (Session::has('success'))
        <div class="alert alert-success">
         {{ Session::get('success') }}
        </div>
        @endif
     {!! Form:: model($zone,array('method' => 'PATCH','action' => ['Coordinators\shipmentCoordinator\ZoneController@update',$zone->id], 'files'=>true,'class' => '')) !!}
    <div class="message">
    </div><!-- div to display message after insert -->
    @include ('coordinators.shipmentCoordinator.zones.form',['submitButton' => "Update"])
    {!! Form::close() !!}
 @endsection
