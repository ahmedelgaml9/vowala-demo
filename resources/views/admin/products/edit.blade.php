@extends('admin.dashboard')
@section('content') 
<div class="row">
     {!! Form:: model($product,array('method' => 'PATCH','action' => ['ProductController@update',$product->id], 'files'=>true,'class' => 'ajax-form-request')) !!}
    <div class="message" style="padding:26px; ">
    </div><!-- div to display message after insert -->
    @include ('admin.products.form2',['submitButton' => "Update"])
    {!! Form::close() !!} 
</div>
@endsection