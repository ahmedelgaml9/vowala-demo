@extends('admin.dashboard')
@section('content')

{!! Form:: model($main,array('method' => 'PUT','action' => ['MainController@update'], 'files'=>true,'class' =>
'ajax-form-request')) !!}
@if(Session::has('flash_message'))

 <div class="alert alert-danger text-center"><em> {!! session('flash_message') !!}</em></div>
        @endif
        <div class="row">
  <div class="col-md-12">
     <section class="panel">
     <header class="panel-heading">                                             
    <h2 class="panel-title"> Aboutus Settings</h2>
 </header>
 <div class="panel-body">
<div class="row">
    <div id="test1" class="col s12">
    
  <div class="form-group">
        <div class="col-sm-6">
            <div class="btn teal lighten-1">
                <span>Aboutus Photo</span>
                {!!Form::file('aboutusphoto', null,array('id'=>'photo'))!!}
            </div>
        </div>
    </div>
    
   <div class="form-group">
        <div class="col-sm-6">
            <div class="btn teal lighten-1">
                <span>Aboutus Photo</span>
                {!!Form::file('categoryphoto', null,array('id'=>'photo'))!!}
            </div>
        </div>
    </div>

  
    <div class="form-group">
          <div class="col-sm-6">
            <div class="btn teal lighten-1">
                <span>Section photo</span>
                {!!Form::file('productsphoto', null,array('id'=>'photo'))!!}
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-6">
        <label for="address">Company  Description</label>
            {!!Form::text('company_description', null,array('class'=>'form-control','id'=>'address'))!!}
            </div>
        </div>
         <div class="form-group">
        <div class="col-sm-6">
         <label for="address">company Description arabic</label>

            {!!Form::text('company_description_ar', null,array('class'=>'form-control','id'=>'address'))!!}
        </div>
   </div>
      
        <div class="row" style="padding: 10px;">
            <div class="col-lg-6">  
                 <div class="form-group">
                     <label for="address">aboutus</label>
                        {!!Form::textarea('aboutus', null,array('class'=>'form-control','id'=>'aboutus'))!!}
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                     <label for="address">aboutus arabic</label>
                        {!!Form::textarea('aboutus_ar', null,array('class'=>'form-control','id'=>'aboutus_ar'))!!}
                    </div>
                 </div>
            </div>
    
        <div class="row" style="padding: 10px;">
            <div class="col-lg-6">  
             <div class="form-group">
                 <label for="address">Return policy</label>
                    {!!Form::textarea('return_policy', null,array('class'=>'form-control','id'=>'return_policy'))!!}
                </div>
            </div>
                
            <div class="col-lg-6">
                <div class="form-group">
                        <label for="address">Return policy arabic</label>
                        {!!Form::textarea('return_policy_ar', null,array('class'=>'form-control','id'=>'return_policy_ar'))!!}
                </div>
            </div>
        </div>
    
   
    </div>
</div>
</section>
</div>
</div>
  {!! Form::submit('edit', array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
{!! Form::close() !!}
@stop

