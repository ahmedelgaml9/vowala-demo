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
            <h2 class="panel-title">{{trans('lang.seo')}}</h2>
         </header>
         <div class="panel-body">
        <div class="row">
            <div id="test1" class="col s12">
                
        <div class="row" style="padding: 10px;">  
          <div class="col-lg-6">
            <div class="form-group">
                <label for="address">Page Title</label>
                    {!!Form::text('page_title', null,array('class'=>'form-control','id'=>'address'))!!}
                    </div>
                </div>
                
            <div class="col-lg-6">
                 <div class="form-group">
                 <label for="address">Page Title Arabic</label>
                      {!!Form::text('page_title_ar', null,array('class'=>'form-control','id'=>'address'))!!}
                 </div>
             </div>
        </div>
              
        <div class="row" style="padding: 10px;">  
          <div class="col-lg-6">  
            <div class="form-group">
                 <label for="address">{{trans('lang.meta_title')}}</label>
                    {!!Form::text('meta_title', null,array('class'=>'form-control'))!!}
                </div>
            </div>
                
            <div class="col-lg-6">
              <div class="form-group">
                 <label for="address">{{trans('lang.ar_meta_title')}}</label>
                    {!!Form::text('meta_title_ar', null,array('class'=>'form-control'))!!}
                </div>
             </div>
        </div>
        
        <div class="row" style="padding: 10px;">  
          <div class="col-lg-6">  
             <div class="form-group">
                 <label for="address">{{trans('lang.meta_keyword')}}</label>
                      {!!Form::text('meta_keyword', null,array('class'=>'form-control'))!!}
                 </div>
             </div>
                
            <div class="col-lg-6"> 
                <div class="form-group">
                 <label for="address">{{trans('lang.ar_meta_keyword')}}</label>
                    {!!Form::text('meta_keyword_ar', null,array('class'=>'form-control'))!!}
                    
                </div>
             </div>
            </div>
            
        <div class="row" style="padding: 10px;">  
          <div class="col-lg-6">  
             <div class="form-group">
                     <label for="address">{{trans('lang.meta_desc')}}</label>
                    {!!Form::textarea('meta_description', null,array('class'=>'form-control','id'=>'vision'))!!}
                </div>
              </div> 
              
              <div class="col-lg-6">  
               <div class="form-group">
                       <label for="address">{{trans('lang.ar_meta_desc')}}</label>
                     {!!Form::textarea('meta_description_ar', null,array('class'=>'form-control','id'=>'vision_ar'))!!}
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

