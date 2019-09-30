@extends('admin.dashboard')
@section('content') 
<div class="row">
{!! Form::open(array('route' =>'size.store','files'=>true,'class' => 'ajax-form-request')) !!}
<div class="message" style="padding:26px; ">
</div>
@include ('admin.sizes.form',['submitButton' => 'Create'])
{!! Form::close() !!}   
</div>
@endsection