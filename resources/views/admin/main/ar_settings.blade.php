@extends('admin.dashboard')
@section('content')   
<!-- end START BREADCRUMB -->
{!! Form:: model($main,array('method' => 'PUT','action' => ['MainController@update'], 'files'=>true,'class' => 'ajax-form-request')) !!}
<div class="message">
</div><!-- div to display message after insert -->

<div class="card card-transparent">
    <div class="card-content">
        <span class="card-title">Main Settings</span>
    </div>
</div>
<div class="row">
    <div class="col s12 16">
        <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
            <li class="tab col s3"><a href="#test1" class="active">About Us</a></li>
            <li class="tab col s3"><a href="#test5">Return Policy </a></li>
            <li class="tab col s3"><a href="#test4">Meta Data</a></li>
        </ul>
    </div>
    <div id="test1" class="col s12">
        <div class="input-field col s12">
            <label for="vision">About Us</label>
            {!!Form::textarea('ar_aboutus', null,array('class'=>'materialize-textarea','id'=>'ar_aboutus'))!!}
            <label class="error">{{ $errors->first('ar_aboutus') }}</label>
        </div>
        <div class="input-field col s12">
            <label for="vision">Address</label>
            {!!Form::text('ar_address', null,array('class'=>'validate','id'=>'ar_address'))!!}
            <label class="error">{{ $errors->first('ar_address') }}</label>
        </div>
        <div class="input-field col s12">
            <label for="vision">Vision</label>
            {!!Form::textarea('ar_vision', null,array('class'=>'materialize-textarea','id'=>'ar_vision'))!!}
            <label class="error">{{ $errors->first('ar_vision') }}</label>
        </div>
        <div class="input-field col s12">
            <label for="mission">Mission</label>
            {!!Form::textarea('ar_mission', null,array('class'=>'materialize-textarea','id'=>'ar_mission'))!!}
            <label class="error">{{ $errors->first('ar_mission') }}</label>
        </div>
    </div>
    <div id="test5" class="col s12">
        <div class="input-field col s12">
            {!!Form::textarea('ar_return_policy', null,array('class'=>'validate','id'=>'ar_return_policy','rows'=>'10'))!!}
            <label class="error">{{ $errors->first('ar_return_policy') }}</label>
        </div>
    </div>
    <div id="test4" class="col s12">
        <div class="input-field col s6">
            {!!Form::text('ar_title', null,array('class'=>'validate','id'=>'ar_title'))!!}
            <label for="title">Website Title</label>
            <label class="error">{{ $errors->first('ar_title') }}</label>
        </div>
        <div class="input-field col s6">
            {!!Form::text('ar_meta_title', null,array('class'=>'validate','id'=>'meta_title'))!!}
            <label for="meta_title">Website Meta Title</label>
            <label class="error">{{ $errors->first('ar_meta_title') }}</label>
        </div>
        <div class="input-field col s12">
            {!!Form::text('ar_photo_alt', null,array('class'=>'validate','id'=>'ar_photo_alt'))!!}
            <label for="photo_alt">Alt of logo </label>
            <label class="error">{{ $errors->first('ar_photo_alt') }}</label>
        </div>
        <div class="input-field col s12">
            {!!Form::textarea('ar_meta_description', null,array('class'=>'materialize-textarea','id'=>'ar_meta_description'))!!}
            <label for="meta_description"> meta description</label>
        </div>
        <div class="input-field col s12">
            {!!Form::textarea('ar_meta_keyword', null,array('class'=>'materialize-textarea','id'=>'ar_meta_keyword'))!!}
            <label for="meta_keyword"> meta keyword</label>
        </div>
    </div>

</div>
<div class="panel-footer">                                                               
    {!! Form::submit('edit', array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
</div>
{!! Form::close() !!}  


<script>
    CKEDITOR.replace('ar_return_policy', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
     
</script>
<!-- END BREADCRUMB -->   
@stop
