@extends('admin.dashboard')
@section('content')
<div class="row">
    {!! Form::open(array('route' =>'subcats.store','files'=>true,'class' => 'ajax-form-request')) !!}
    
      @include ('admin.subcats.form',['submitButton' => 'Create'])
      
      {!! Form::close() !!}
</div>
@endsection