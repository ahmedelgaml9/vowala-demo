@extends('coordinators.shipmentCoordinator.dashboard')
@section('content')
<div class="row">
    {!! Form::open(array('route' =>'shipmentCoordinator.zones.store')) !!}
    <div class="message" style="padding:26px; ">
        @if (Session::has('done'))
         {{ Sessions::get('success') }}
        @endif
    </div><!-- div to display message after insert -->
    @include ('coordinators.shipmentCoordinator.zones.form',['submitButton' => 'Submit Data'])
    {!! Form::close() !!}
</div>
@endsection
