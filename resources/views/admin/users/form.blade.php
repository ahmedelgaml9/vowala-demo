@if(Session::has('flash_message'))
<div class="alert alert-danger text-center"><em> {!! session('flash_message') !!}</em></div>
@endif

<div class="col-md-12">
  <section class="panel">
    <header class="panel-heading">
      <h2 class="panel-title"></h2>
    </header>
    <div class="panel-body">

      <div class="row">
          <div class="col-lg-6">
        <div class="form-group">
            <label for="email">{{trans('lang.email')}}</label>
                  {!!Form::email('email', null,array('class'=>'form-control','id'=>'email'))!!}
                   @if(!empty($errors->first('email')))
                    <label class="alert alert-danger nopaddinng">{{ $errors->first('email') }}</label>
                   @endif
        </div>
      </div>
        <div class="col-lg-6">
         <div class="form-group">
            <label for="name">{{trans('lang.name')}}</label>
            {!!Form::text('name', null,array('class'=>'form-control','id'=>'name'))!!}
            @if(!empty($errors->first('name')))
            <label class="alert alert-danger nopaddinng">{{ $errors->first('name') }}</label>
            @endif
        </div>
      </div>
     </div>
     
  
    
      <div class="row">
          <div class="col-lg-6">
        <div class="form-group">
              <label for="email">{{trans('lang.permission')}}</label>
            {!!Form::select('permission',array(0 =>'Normal User', 1=>'Admin', 2=>'Seller', 3=>'Product Coordinator',
                4=>'shipmentCoordinator', 5 =>'shipping Coordinator'),null,array('class'=>'form-control'
                  ,'Select','id'=>'permission'))!!}</div>
           </div>
            <div class="col-lg-6">
                <div class="form-group">
                        <label for="blog">{{trans('lang.status')}}</label>
                        <select name="active" class="form-control" required>
                          <option value="1">{{trans('lang.active')}}</option>
                          <option value="0">{{trans('lang.unactive')}}</option>
                        </select>
                      </div>
                    </div>
                </div>
                
        <div class="row">
          <div class="col-lg-6">
                <div class="form-group">
                    <label for="name">{{trans('lang.country')}}</label>
                       {!!Form::select('country',$countries,null,array('class'=>'form-control'))!!}
                  </div>
                </div>
     
             <div class="col-lg-6">
                  <div class="form-group">
                       <label for="name">{{trans('lang.city')}}</label>
                           {!!Form::select('city' , $cities , null,array('class'=>'form-control','id'=>'permission'))!!}
                           @if(!empty($errors->first('city')))
                          <label class="alert alert-danger nopaddinng">{{ $errors->first('city') }}</label>
                          @endif
                      </div>
                  </div>
               </div>
            
    
      <div class="row">
         <div class="col-lg-6">
           <div class="form-group">
              <label for="email">{{trans('lang.address')}}</label>
                 {!!Form::text('address', null,array('class'=>'form-control','id'=>'email'))!!}
                 @if(!empty($errors->first('address')))
                  <label class="alert alert-danger nopaddinng">{{ $errors->first('address') }}</label>
                 @endif
          </div>
           <div class="form-group">
            <label for="email">{{trans('lang.phone')}}</label>
            {!!Form::text('phone', null,array('class'=>'form-control','id'=>'email'))!!}
                @if(!empty($errors->first('phone')))
                  <label class="alert alert-danger nopaddinng">{{ $errors->first('phone') }}</label>
                 @endif
        </div>
                <div class="form-group">
            <label class="control-label col-md-3">{{trans('lang.password')}}</label>
            <section class="form-group-vertical">
              <div class="input-group input-group-icon">
                <span class="input-group-addon">
                </span>
                <input class="validate form-control" type="password" name="password" id="password">
                @if(!empty($errors->first('password')))
                <label class="alert alert-danger nopaddinng">{{ $errors->first('password') }}</label>
                @endif
              </div>
            </section>
        </div>
            <div class="form-group">
            <label class="control-label col-md-6">{{trans('lang.r_password')}}</label>
            <section class="form-group-vertical">
              <div class="input-group input-group-icon">
                <span class="input-group-addon">
                </span>
                <input class="validate form-control" type="password" id="password_confirmation" name="password_confirmation">
                    @if(!empty($errors->first('password_confirmation')))
                 <label class="alert alert-danger nopaddinng">{{ $errors->first('password_confirmation') }}</label>
                   @endif
              </div>
            </section>
            </div>
        </div>
      
      
        </div>
      </div>
    </div>
    
    {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}

  </section>
</div>



<!--
<script>
    
        $(document).ready(function(){
        $('#permission').on('change', function() {
        
      if (this.value == '2'){
   
        $("#addresses").show(); 
        $("[name='street_number']").prop('required',true);
        $("[name='building_number']").prop('required',true);
        $("[name='floor_number']").prop('required',true);
        $("[name='flat_num']").prop('required',true);
        
        }
      
    else{
        
       $("#addresses").hide();

    }
      
    });
});
    
</script>-->




