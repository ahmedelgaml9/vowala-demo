@extends('coordinators.productCoordinator.dashboard')
@section('content')
<div class="row">
     {!! Form:: model($product,array('method' => 'PATCH','action' => ['Coordinators\productCoordinator\CatalogController@update',$product->id], 'files'=>true,'class' => 'ajax-form-request')) !!}
    <div class="message" style="padding:26px; ">
    </div><!-- div to display message after insert -->
    @include ('coordinators.productCoordinator.catalog.form',['submitButton' => "Update"])
    {!! Form::close() !!}
</div>
@endsection
