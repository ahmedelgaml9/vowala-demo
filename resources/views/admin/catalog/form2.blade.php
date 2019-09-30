@if(Session::has('flash_message'))
<div class="alert alert-danger text-center"><em> {!! session('flash_message') !!}</em></div>
@endif
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
            </header>
            <div class="panel-body">
                <div class="row">
                      <div class="tabs tabs-vertical tabs-left">
								<ul class="nav nav-tabs  col-sm-4">
								    
									<li class="active">
										<a href="#main" data-toggle="tab"><i class="fa fa-star"></i>Main </a>
									</li>
									<li >
										<a href="#en" data-toggle="tab">En </a>
									</li>
									<li>
								    	<a href="#ar" data-toggle="tab">Ar</a>
									</li>
										<li>
								    	<a href="#seo" data-toggle="tab">Seo</a>
									</li>
									
									
								</ul>
						<div class="tab-content col-sm-12">
							<div id="main" class="tab-pane active">
            					  <div class="form-group">
                                    <div class="col-sm-8">
                                        <div class="btn teal lighten-1">
                                            <span>{{trans('lang.photo')}}</span>
                                            {!!Form::file('photo', null,array('id'=>'image','required'=>'required'))!!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <div class="btn teal lighten-1">
                                            <span></span>
                                            <input type="file" name="gallary[]" multiple>
                                        </div>
                                    </div>
                                </div>
                   
                                    <div class="form-group">
                                      <div class="col-sm-8">
                                          <label for="blog">{{trans('lang.cats')}}</label>
                                         <select name="cat_id" class="form-control" id="cat_id">
                                                 @foreach($cats as $ca)
                                                <option value="{{ $ca->id }}">{{ $ca->name }}</option>
                                                 @foreach($ca->childrens   as $c)
                                                 <option value="{{ $c->id }}"> ^^ {{ $c->name }}</option>
                                                      @endforeach
                                                      @endforeach
                                            </select>
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
                                                
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog"> {{trans('lang.sku')}}</label>
                                        {!!Form::text('sku',
                                        null,array('class'=>'form-control','id'=>'address_ar'))!!}
                                      
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog"> {{trans('lang.model')}}</label>
                                        {!!Form::text('model', null,array('class'=>'form-control'))!!}
            
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog"> {{trans('lang.weight')}}</label>
                                        {!!Form::number('weight', null,array('class'=>'form-control','step'=>'any'))!!}
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                           <label for="name"> {{trans('lang.brands')}}</label>
                                        {!!Form::select('brand_id', $brands,null,array('class'=>'form-control','id'=>'brand_id'))!!}
                                    </div>
                                </div>
            				</div>
								    
						  <div id="en" class="tab-pane">
                	               <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="title"> {{trans('lang.name')}}</label>
                                        {!!Form::text('name',
                                             null,array('class'=>'form-control','id'=>'title'))!!}
                                  </div>
                                 </div>
                                 
                                  <div class="form-group">
                                    <div class="col-sm-8">
                                       <label for="title">{{trans('lang.custom_url')}}</label>
                                        {!!Form::text('custom_url',
                                           null,array('class'=>'form-control'))!!}
                                          @if($errors->has('custom_url'))
                                           <label class="alert alert-danger nopaddinng">{{ $errors->first('custom_url') }}</label>
                                          @endif
                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="desc">{{trans('lang.desc')}}</label>
                                             {!!Form::textarea('desc',
                                            null,array('class'=>'validate','id'=>'desc','placeholder'=>'Product
                                            Description','style'=>'padding-top:20px'))!!}
                                            @if($errors->has('desc'))
                                            <label class="alert alert-danger nopaddinng">{{ $errors->first('desc') }}</label>
                                            @endif
                                    </div>
                                 </div>

            						 <div class="form-group">
                                        <div class="col-sm-8">
                                        <label for="desc">{{trans('lang.return_policy')}}</label>
                                        {!!Form::textarea('return_policy',
                                            null,array('class'=>'validate','id'=>'desc','placeholder'=>'Product
                                           Description','style'=>'padding-top:20px'))!!}
            
                                  </div>
						    	</div>
						        </div>
						   	   <div id="ar" class="tab-pane">
                                    <div class="form-group">
                                      <div class="col-sm-8">
                                         <label for="title"> {{trans('lang.ar_name')}}</label>
                                         {!!Form::text('name_ar',
                                            null,array('class'=>'form-control','id'=>'title'))!!}
                                            @if($errors->has('name_ar'))
                                            <label class="alert alert-danger nopaddinng">{{ $errors->first('name_ar') }}</label>
                                            @endif
                                    </div>
                                </div>
                              <div class="form-group">
                                <div class="col-sm-8">
                                    <label for="title"> {{trans('lang.ar_custom_url')}}</label>
                                    {!!Form::text('custom_url_ar',
                                    null,array('class'=>'form-control','id'=>'title'))!!}
                                    @if($errors->has('cutom_url_ar'))
                                    <label class="alert alert-danger nopaddinng">{{ $errors->first('custom_url_ar') }}</label>
                                    @endif
                                  </div>
                               </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="desc">{{trans('lang.ar_desc')}}</label>
                                        {!!Form::textarea('desc_ar',
                                        null,array('class'=>'validate','id'=>'desc_ar','placeholder'=>'Product
                                        Description','style'=>'padding-top:20px'))!!}
                                        @if($errors->has('desc_ar'))
                                        <label class="alert alert-danger nopaddinng">{{ $errors->first('desc_ar') }}</label>
                                        @endif
                                    </div>
                                  </div>
                                  
                                      <div class="form-group">
                                         <div class="col-sm-8">
                                       <label for="desc"> {{trans('lang.ar_return_policy')}}</label>
                                               {!!Form::textarea('return_policy_ar',
                                                null,array('class'=>'validate','id'=>'desc_ar','placeholder'=>'Product
                                                Description','style'=>'padding-top:20px'))!!}
                                              
                                          </div>
                                       </div>
        							</div>
        							
        							
        					      <div id="seo" class="tab-pane">
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                                <label for="title">{{trans('lang.meta_title')}}</label>
                                                {!!Form::text('meta_title', null,array('class'=>'form-control','id'=>'title'))!!}
                                            </div>
                                        </div>
                            
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                                <label for="title">{{trans('lang.ar_meta_title')}}</label>
                                                {!!Form::text('meta_title_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                                <label for="title">{{trans('lang.meta_desc')}}</label>
                                                {!!Form::textarea('meta_description',
                                                null,array('class'=>'form-control','id'=>'meta_description'))!!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                                <label for="title">{{trans('lang.ar_meta_desc')}}</label>
                                                {!!Form::textarea('meta_description_ar',
                                                null,array('class'=>'form-control','id'=>'meta_description_ar'))!!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                            
                                            <div class="col-sm-8">
                                                <label for="title">{{trans('lang.meta_keyword')}} </label>
                                                {!!Form::text('meta_keyword', null,array('class'=>'form-control','id'=>'meta_keyword'))!!}
                                            </div>
                                        </div>
                            
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                                <label for="title">{{trans('lang.ar_meta_keyword')}} </label>
                                                {!!Form::text('meta_keyword_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                                            </div>
                                        </div>
                                      
            						</div>
            					</div>
            				</div>  
                        </div>
                        
                        {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
                    
                </div>
            </div>
          <br>
    </div>
</div>
</div>
</div>

</div>
</div>
</section>
</div>


<script>
    CKEDITOR.replace('desc', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    CKEDITOR.replace('desc_ar', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    
    CKEDITOR.replace('return_policy', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    CKEDITOR.replace('return_policy_ar', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    
    CKEDITOR.replace('meta_description', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    CKEDITOR.replace('meta_description_ar', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
</script>