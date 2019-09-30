
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
                    <div class="btn teal lighten-1">
                        <span>{{trans('lang.photo')}}</span>
                        {!!Form::file('photo', null,array('id'=>'image'))!!}
                         @if(!empty($errors->first('photo')))
                              <label class="alert alert-danger nopaddinng">{{ $errors->first('photo') }}</label>
                           @endif
                    </div>
                </div>
                </div>
             
                <div class="form-group">
                <div class="col-sm-6">
                <label for="title">{{trans('lang.name')}}</label>
                    {!!Form::text('title', null,array('class'=>'form-control','id'=>'title'))!!}
                        @if(!empty($errors->first('title')))
                          <label class="alert alert-danger nopaddinng">{{ $errors->first('title') }}</label>
                        @endif
                </div>
                </div>
              
                <div class="form-group">
                <div class="col-sm-6">
                  <label for="title">{{trans('lang.name_ar')}}</label>
                    {!!Form::text('title_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                      @if(!empty($errors->first('title_ar')))
                        <label class="alert alert-danger nopaddinng">{{ $errors->first('title_ar') }}</label>
                     @endif
                </div>
                </div>

        
             <div class="form-group">
                <div class="col-sm-6">
                  <label for="title">{{trans('lang.photo_alt')}} </label>
                    {!!Form::text('photo_alt', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
              </div>

             <div class="form-group">
                <div class="col-sm-6">
                  <label for="title">{{trans('lang.photo_alt_ar')}}</label>
                    {!!Form::text('photo_alt_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
            </div>

  
             <div class="form-group">
                <div class="col-sm-6">
                  <label for="title">{{trans('lang.link')}}</label>
                    {!!Form::text('link', null,array('class'=>'form-control','id'=>'title'))!!}
                      @if(!empty($errors->first('link')))
                          <label class="alert alert-danger nopaddinng">{{ $errors->first('link') }}</label>
                       @endif

                </div>
           </div>
         </section>
       </div>
               {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
                
            </div>
        </div>
        </section>
        
    </div>
 