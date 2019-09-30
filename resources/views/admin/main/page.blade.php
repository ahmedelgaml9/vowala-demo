@extends('admin.dashboard')
@section('content') 
     {!! Form:: model($row,array('method' => 'PUT','action' => ['MainController@updatemeta',$row->id], 'files'=>true,'class' => 'ajax-form-request')) !!}
   
   @if(Session::has('flash_message'))
 <div class="alert alert-danger text-center"><em> {!! session('flash_message') !!}</em></div>
        @endif
    <div class="card invoices-card">
        <div class="card-content">
            <span class="card-title">{{ $row->page }}</span>
            <div class="input-field col s12">
                {!!Form::text('title', null,array('class'=>'form-control','id'=>'title'))!!}
                <label for="title">Page Title </label>
                <label class="error">{{ $errors->first('title') }}</label>
            </div>
            <div class="input-field col s12">
                {!!Form::textarea('meta_description', null,array('class'=>'form-control','id'=>'meta_description'))!!}
                <label for="desc">Meta Description </label>
                <label class="error">{{ $errors->first('meta_description') }}</label>
            </div>
            <div class="input-field col s12">
                {!!Form::textarea('meta_keyword', null,array('class'=>'form-control','id'=>'meta_keyword'))!!}
                <label for="desc">Keywords </label>
                <label class="error">{{ $errors->first('meta_keyword') }}</label>
            </div>
            <div class="input-field col s12">
                {!!Form::textarea('meta_auther',null,array('class'=>'form-control','id'=>'meta_auther'))!!}
                <label for="desc"> Author  </label>
                <label class="error">{{ $errors->first('meta_auther') }}</label>
            </div>
    {!! Form::submit("Update", array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
        </div>
    </div>
</div>
{!! Form::close() !!} 
 @endsection