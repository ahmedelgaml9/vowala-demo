@extends('admin.dashboard')
@section('content') 
<div class="row">
 {!! Form:: model($user,array('method' => 'PATCH','action' => ['UsersController@update',$user->id], 'files'=>true,'class' => 'ajax-form-request')) !!}
<div class="message" style="padding:26px; ">
</div><!-- div to display message after insert -->
@include ('admin.users.form',['submitButton' => "Update"])
{!! Form::close() !!}  
</div>
@endsection