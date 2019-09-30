@extends('admin.dashboard')
@section('content') 
<div class="row">
{!! Form::open(array('route' =>'benefits.store','files'=>true,'class' => 'ajax-form-request')) !!}
<div class="message" style="padding:26px; ">
</div><!-- div to display message after insert -->
@include ('admin.benefits.form',['submitButton' => 'Create'])
{!! Form::close() !!}   
</div>
@endsection