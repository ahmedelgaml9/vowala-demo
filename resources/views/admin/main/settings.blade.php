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
    <h2 class="panel-title">{{trans('lang.settings')}}</h2>
 </header>
 <div class="panel-body">
<div class="row">
    <div id="test1" class="col s12">
    <div class="row">
      <div class="col-lg-6">    
       <div class="form-group">
          <img src="" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                <div class="btn teal lighten-1">
                    <span>Aboutus Photo</span>
                    {!!Form::file('aboutusphoto', null,array('id'=>'photo'))!!}
                </div>
            </div>
        </div>
    <div class="col-lg-6"> 
        <div class="form-group">
            <img src="" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                <div class="btn teal lighten-1">
                    <span>Category Photo</span>
                      {!!Form::file('categoryphoto', null,array('id'=>'photo'))!!}
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
      <div class="col-lg-6"> 
          <div class="form-group">
              <img src="" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                    <div class="btn teal lighten-1">
                        <span>Fav Icon</span>
                          {!!Form::file('favicon', null,array('id'=>'photo'))!!}
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
             <div class="form-group">
                 <img src="" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                    <div class="btn teal lighten-1">
                        <span>icons footer</span>
                         {!!Form::file('iconsfooter', null,array('id'=>'photo'))!!}
                    </div>
                </div>
            </div>
    </div>

  
    <div class="form-group">
        <div class="col-sm-6">
            <label for="phone">{{trans('lang.phone')}}</label>
              {!!Form::text('phone', null,array('class'=>'form-control','id'=>'phone'))!!}
        </div>
     </div>
     
    <div class="form-group">
        <div class="col-sm-6">
            <label for="email">{{trans('lang.salestax')}}</label>
               {!!Form::number('sales_tax', null,array('class'=>'form-control','steps'=>'any'))!!}
        </div>
    </div>
        <div class="form-group">
         <div class="col-sm-6">
             <label for="email">{{trans('lang.design')}}</label>
           <input type="radio"name="chosetemplate"     value="1">   Template1
           <input type="radio"name="chosetemplate"     value="2">   Template2
           </div>
        </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label for="email">{{trans('lang.email')}}</label>
            {!!Form::email('email', null,array('class'=>'form-control','id'=>'support'))!!}
           
        </div>
    </div>
    
     <div class="form-group">
       <div class="col-sm-6">
          <label for="email">C{{trans('lang.curr')}}</label>
          <br>
         @foreach($currency as $h)
          <input type="radio"   value="{{$h->id}}"  name="default_currency" >{{$h->name}} 
         @endforeach
           </div>
        </div>
           
 
    <div class="row" style="padding: 10px;">
      <div class="col-lg-6">       
            <div class="form-group">
                     <label for="address">{{trans('lang.vision')}}</label>
                    {!!Form::textarea('vision', null,array('class'=>'form-control','id'=>'vision'))!!}
                </div>
            </div> 
              
            <div class="col-lg-6">       
               <div class="form-group">
                       <label for="address">{{trans('lang.ar_vision')}}</label>
                     {!!Form::textarea('vision_ar', null,array('class'=>'form-control','id'=>'vision_ar'))!!}
            </div>
        </div>
    </div>
            
            
   <div class="row" style="padding: 10px;">
      <div class="col-lg-6">             
            <div class="form-group">
                     <label for="address">{{trans('lang.mission')}}</label>
                    {!!Form::textarea('mission', null,array('class'=>'form-control','id'=>'mission'))!!}
                </div>
              </div> 
              
            <div class="col-lg-6">  
               <div class="form-group">
                       <label for="address">{{trans('lang.ar_mission')}}</label>
                     {!!Form::textarea('mission_ar', null,array('class'=>'form-control','id'=>'mission_ar'))!!}
            </div>
        </div>
     </div>
        
    <div class="form-group">
        <div class="col-sm-12">
         <label for="address">{{trans('lang.map')}}</label>
            {!!Form::text('map', null,array('class'=>'form-control','id'=>'address'))!!}
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

