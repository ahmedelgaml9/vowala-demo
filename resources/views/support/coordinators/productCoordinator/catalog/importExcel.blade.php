@extends('coordinators.productCoordinator.dashboard')
@section('content')
<div class="row">

{{-- {!! Form::open(array('route' =>'importExcel','files'=>true,'class' => 'ajax-form-request')) !!} --}}
<form class="ajax-form-request" action="{{ route('importExcel') }}" enctype="multipart/form-data" method="post">
  {{ csrf_field() }}

    <div class="message" style="padding:26px; ">
    </div><!-- div to display message after insert -->

    <div class="file-field col s6">
        <div class="btn teal lighten-1">
            <span>Import From Excel Sheet</span>
            <input type="file" name="import_file" value="File" id="import_file">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Select Excel Sheet">
        </div>
        {{-- <label class="error">{{ $errors->first('import_file') }}</label> --}}

    </div>

      <input class="btn btn-success" type="submit" name="submit" value="Save">

</form>

</div>
@endsection
