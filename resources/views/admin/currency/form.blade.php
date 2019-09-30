
    @if(Session::has('flash_message'))
 <div class="alert alert-danger text-center"><em> {!! session('flash_message') !!}</em></div>
        @endif
        <div class="row">

  <div class="col-md-12">
     <section class="panel">
     <header class="panel-heading">
                                                    
    <h2 class="panel-title"></h2>
          </header>
 <div class="panel-body">

            <div class="row">
              
               
                <div class="form-group">
                <div class="col-sm-6">
                <label for="title">{{trans('lang.name')}}</label>

              {!!Form::text('name', null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                </div>
                </div>
                
                <div class="form-group">
                <div class="col-sm-6">
                  <label for="title"> {{trans('lang.ar_name')}}</label>
                    {!!Form::text('name_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
                </div>
              
              <div class="form-group">
               <div class="col-sm-6">
                 <label for="blog">{{trans('lang.symbols')}}</label>
                    {!!Form::text('value', null,array('class'=>'form-control'))!!}
                </div>
                </div>
            </div>
        </div>
    
         {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}

        </section>
       </div>
     
 