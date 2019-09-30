@extends('seller.dashboard')
@section('content') 
<div class="row">

{!! Form::open(array('route' =>'ourproducts.store','files'=>true,'class' => 'ajax-form-request')) !!}
<div class="message" style="padding:26px; ">
</div><!-- div to display message after insert -->
@include ('seller.products.form',['submitButton' => Lang::get('lang.cretae')])
{!! Form::close() !!}   
</div>
@endsection