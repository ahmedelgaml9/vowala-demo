@extends('coordinators.productCoordinator.dashboard')
@section('content')
<div class="row">

{!! Form::open(array('route' =>'productCoordinator.catalogs.store','files'=>true,'class' => 'ajax-form-request')) !!}
<div class="message" style="padding:26px; ">
</div><!-- div to display message after insert -->
@include ('coordinators.productCoordinator.catalog.form',['submitButton' => 'Create'])
{!! Form::close() !!}
</div>
@endsection
