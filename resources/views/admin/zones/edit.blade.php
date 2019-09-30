@extends('admin.dashboard')
@section('content') 
      @if (Session::has('success'))
        <div class="alert alert-success">
         {{ Session::get('success') }}
        </div>
        @endif
     {!! Form:: model($row,array('method' => 'PATCH','action' => ['ZoneController@update',$row->id], 'files'=>true)) !!}
    <div class="message">
    </div><!-- div to display message after insert -->
    @include ('admin.zones.form',['submitButton' => "Update"])
    {!! Form::close() !!}  
 @endsection