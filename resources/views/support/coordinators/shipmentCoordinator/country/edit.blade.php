@extends('coordinators.shipmentCoordinator.dashboard')
@section('content')
     {!! Form:: model($c,array('method' => 'PATCH','action' => ['Coordinators\shipmentCoordinator\CountryController@update',$c->id], 'files'=>true)) !!}
    <div class="message">
    </div><!-- div to display message after insert -->
    @include ('coordinators.shipmentCoordinator.country.form',['submitButton' => "Update"])
    {!! Form::close() !!}
 @endsection
