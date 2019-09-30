@extends('admin.dashboard')
@section('content') 
<div class="row">
{!! Form::open(array('action' =>'ProductController@storecatalog','method'=>'put','files'=>true,'class' => 'ajax-form-request')) !!}
<div class="message" style="padding:26px;">
</div><!-- div to display message after insert -->
@include ('admin.products.form3',['submitButton' => 'Create'])
{!! Form::close() !!}   
</div>
@endsection