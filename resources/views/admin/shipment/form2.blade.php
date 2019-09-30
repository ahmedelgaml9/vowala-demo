
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
                <label for="title"> Name</label>
                    {!!Form::text('name', null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                </div>
                </div>
                <div class="form-group">
                <div class="col-sm-6">
                  <label for="title"> Name arabic</label>

                    {!!Form::text('name_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
                </div>
                
                 <div class="form-group">
                  <div class="col-sm-6">
                      <label for="blog"> Phone</label>
                        {!!Form::number('phone', null,array('class'=>'form-control','id'=>'desc'))!!}
                  </div>
                 </div>
            </div>
            
            <div class="row">
               <div class="col-lg-6">
                 <div class="form-group">
                    <label for="blog"> Description</label>
                    {!!Form::textarea('desc', null,array('class'=>'form-control','id'=>'desc'))!!}
                </div>
              </div>
              
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="blog">Description arabic</label>
                    {!!Form::textarea('desc_ar', null,array('class'=>'form-control','id'=>'desc_ar'))!!}
                    <label class="error">{{ $errors->first('desc') }}</label>
                </div>
              </div>
            </div>
            
             <div class="col-md-12">
                <section class="panel">
                <header class="panel-heading">
                                                            
               <h2 class="panel-title">Zones</h2>
                    </header>
              <div class="panel-body">
                    
                    <?php
                    
                    
                        $get= App\Shipmentzone::where('shipment_id',$method->id)->pluck('zone_id');
                        $zones = App\Zone::select('id','name')->whereNotin('id',$get)->get();
                    ?>
                    
                    @foreach($zones as $zone)
                 <div class="col-sm-6">
                     <input type="checkbox" name="zones[]" value="{{$zone->id}}"   id="{{$zone->id}}">
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
     
 