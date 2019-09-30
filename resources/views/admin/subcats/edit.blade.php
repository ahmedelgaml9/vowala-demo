@extends('admin.dashboard')
@section('content')
<div class="row">
    {!! Form:: model($row,array('method' => 'PATCH','action' => ['SubcatController@update',$row->id],
    'files'=>true,'class'
    => 'ajax-form-request')) !!}
    <div class="message" style="padding:26px;">
   </div>
    @include ('admin.subcats.form2',['submitButton' => "Update"])
    {!! Form::close() !!}
</div>
@endsection