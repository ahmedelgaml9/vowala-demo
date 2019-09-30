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
                           <div class="col-lg-6">
                            <label for="title">{{trans('lang.name')}}</label>
                            {!!Form::text('name',
                               null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                               
                              @if($errors->has('name'))
                               <label class="alert alert-danger nopaddinng">{{ $errors->first('name') }}</label>
                              @endif
                        </div>
                    </div>
                    
                      <div class="form-group">
                          <div class="col-lg-6">
                             <label for="title">{{trans('lang.ar_name')}}</label>
                                {!!Form::text('name_ar', null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                                 @if($errors->has('name_ar'))
                                  <label class="alert alert-danger nopaddinng">{{ $errors->first('name_ar') }}</label>
                                @endif
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-lg-6">
                             <label for="title">{{trans('lang.zones')}}</label>
                               <select  name="country_id" class="form-control">
                                  @foreach($zones as $c)
                                <option  value="{{$c->id}}">{{$c->name}}</option>
                                 @endforeach
                           </select>
                        </div>
                    </div>
        </section>
    </div>
        {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}

</div>
</div>
</div>