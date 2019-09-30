
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
                                    <div class="col-sm-8">
                                        <div class="btn teal lighten-1">
                                            <span>{{trans('lang.photo')}}</span>
                                               {!!Form::file('photo', null,array('id'=>'image'))!!}
                                               @if($errors->has('photo'))
                                               <label class="alert alert-danger nopaddinng">{{ $errors->first('photo') }}</label>
                                               @endif
                                           
                                        </div>
                                    </div>
                                </div>
                                   
                      
                      
                      
                      
                <div class="form-group">
                <div class="col-sm-6">
                <label for="title"> {{trans('lang.name')}}</label>
                    {!!Form::text('name', null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                </div>
                </div>
                 <div class="form-group">
                <div class="col-sm-6">
                <label for="title"> {{trans('lang.ar_name')}}</label>
                    {!!Form::text('name_ar', null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                </div>
                </div>
            
                <div class="form-group">
                <div class="col-sm-6">
                  <label for="title"> {{trans('lang.paymentprice')}}</label>
                      {!!Form::number('value', null,array('class'=>'form-control','steps'=>'any','required'=>'required'))!!}
                </div>
                </div>
              
              <div class="form-group">
                      <div class="col-sm-6">
                        <label for="blog">{{trans('lang.status')}}</label>
                        <select name="active" class="form-control" required>
                          <option value="1">{{trans('lang.active')}}</option>
                          <option value="0">{{trans('lang.unactive')}}</option>
                        </select>
                      </div>
                    </div>
                 </div>
             </div>
           </section>
                  {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}

    </div>
      </div>
     
 