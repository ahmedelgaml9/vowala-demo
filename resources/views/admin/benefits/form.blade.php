
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
                <select   name="icon"   class="form-control" >
                <option value="shipping">shipping</option>  
                <option value="us-dollar">dollar</option>  
                <option value="support">support</option>  
                </select>
        
                </div>
                </div>
            
                <div class="form-group">
                <div class="col-sm-6">
                <label for="title"> Name</label>
                       {!!Form::text('name', null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                </div>
                </div>
                
                <div class="form-group">
                <div class="col-sm-6">
                  <label for="title">Name arabic</label>
                    {!!Form::text('name_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
                </div>
            <div class="row" style="padding: 10px;">
                <div class="col-lg-6">
                  <div class="form-group">
                         <label for="blog"> Description</label>
                          {!!Form::textarea('desc', null,array('class'=>'form-control','id'=>'desc'))!!}
                  </div>
                </div>
               
                <div class="col-lg-6">
                   <div class="form-group">
                    <label for="blog"> Description arabic</label>
                       {!!Form::textarea('desc_ar', null,array('class'=>'form-control','id'=>'desc_ar'))!!}
                    <label class="error">{{ $errors->first('desc') }}</label>
                </div>
              </div>
            </div>
           </section>
         </div>
               {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}  
            </div>
        </div>
        </section>
        
    </div>
     
