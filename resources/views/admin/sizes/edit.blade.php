@extends('admin.dashboard')
@section('content') 
<div class="row">
     {!! Form:: model($row,array('method' => 'PATCH','action' => ['SizesController@update',$row->id], 'files'=>true,'class' => 'ajax-form-request')) !!}
    <div class="message" style="padding:26px;">
 </div>
 @include ('admin.sizes.form',['submitButton' => "Update"])
 {!! Form::close() !!} 
</div>
@endsection