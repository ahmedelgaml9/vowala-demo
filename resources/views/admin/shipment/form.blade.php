
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
                                 
              <div class="col-lg-6">
                <div class="form-group">
                <label for="title">{{trans('lang.name')}}</label>
                   {!!Form::text('name', null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                </div>
                
                <div class="form-group">
                     <label for="title"> {{trans('lang.ar_name')}}</label>
                       {!!Form::text('name_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="form-group">
                      <label for="blog">{{trans('lang.phone')}}</label>
                        {!!Form::number('phone', null,array('class'=>'form-control','id'=>'desc'))!!}
                 </div>
                
                <div class="form-group">
                    <label for="blog">{{trans('lang.status')}}</label>
                     {!!Form::select('active', array('1'=>'Active','0'=>'Desactive'),null,array('class'=>'form-control','id'=>'section_id'))!!}
                </div>
            </div>
        </div>
                  
        <div class="row">
             <div class="col-lg-6">        
              <div class="form-group">
                    <label for="blog">{{trans('lang.desc')}}</label>
                    {!!Form::textarea('desc', null,array('class'=>'form-control','id'=>'desc'))!!}
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="blog">{{trans('lang.ar_desc')}}</label>
                    {!!Form::textarea('desc_ar', null,array('class'=>'form-control','id'=>'desc_ar'))!!}
                    <label class="error">{{ $errors->first('desc') }}</label>
                 </div>
            </div>
        </div>
              
             <div class="col-md-12">
                <section class="panel">
                <header class="panel-heading">
                                                            
               <h2 class="panel-title">{{trans('lang.zones')}}</h2>
                    </header>
              <div class="panel-body">
                  
                    @foreach($zones as $zone)
                    
                 <div class="col-sm-6">
                     <input type="checkbox" name="zones[]" value="{{$zone->id}}"  id="{{$zone->id}}">
                     <label for="{{$zone->id}}"> {{$zone->name}}
                    </label>
                    <br>
                </div>
                    @endforeach
                </div>
                     </div>
                     </section>
                       </div>
                  {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
                
            </div>
        </div>
        </section>
        
    </div>
     
 