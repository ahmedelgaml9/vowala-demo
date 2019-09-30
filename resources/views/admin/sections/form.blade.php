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
                         <div class="tabs tabs-vertical tabs-left">
								<ul class="nav nav-tabs  col-sm-4">
									<li class="active">
										<a href="#main" data-toggle="tab"><i class="fa fa-star"></i>{{trans('lang.general')}} </a>
									</li>
								
									<li>
								    	<a href="#sell" data-toggle="tab">{{trans('lang.sell')}}</a>
									</li>
									<li>
										<a href="#en" data-toggle="tab">{{trans('lang.en')}} </a>
									</li>
									<li>
								    	<a href="#ar" data-toggle="tab">{{trans('lang.ar')}}</a>
									</li>
									  <li>
								    	 <a href="#seo" data-toggle="tab">{{trans('lang.seo')}}</a>
									  </li>
							    </ul>
						<div class="tab-content col-sm-12">
							<div id="main" class="tab-pane active">
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
                                        <label for="blog">{{trans('lang.status')}}</label>
                                        <select name="active" class="form-control" required>
                                          <option value="1">{{trans('lang.active')}}</option>
                                          <option value="0">{{trans('lang.unactive')}}</option>
                                        </select>
                                      </div>
								    
						        <div id="en" class="tab-pane ">
                	                 <div class="form-group">
                                        <div class="col-sm-8">
                                        <label for="title"> {{trans('lang.name')}}</label>
                                        {!!Form::text('name',
                                       null,array('class'=>'form-control','id'=>'title'))!!}
                                       @if($errors->has('name'))
                                        <label class="alert alert-danger nopaddinng">{{ $errors->first('name') }}</label>
                                        @endif
                                  </div>
                                 </div>
                                 
                                   <div class="form-group">
                                    <div class="col-sm-8">

                                        <label for="title"> {{trans('lang.custom_url')}}</label>
                                        {!!Form::text('custom_url',
                                        null,array('class'=>'form-control','id'=>'title'))!!}
                                        @if($errors->has('custom_url'))
                                        <label class="alert alert-danger nopaddinng">{{ $errors->first('custom_url') }}</label>
                                        @endif
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
                                                <label for="title">{{trans('lang.ar_custom_url')}}</label>
                                              {!!Form::text('custom_url_ar',
                                                null,array('class'=>'form-control','id'=>'title'))!!}
                                                @if($errors->has('cutom_url_ar'))
                                                <label class="alert alert-danger nopaddinng">{{ $errors->first('custom_url_ar') }}</label>
                                                @endif
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
                                                    <label for="title">{{trans('lang.meta_keyword')}}</label>
                                                    {!!Form::text('meta_keyword', null,array('class'=>'form-control','id'=>'meta_keyword'))!!}
                                                </div>
                                            </div>
                            
                                            <div class="form-group">
                                             <div class="col-sm-8">
                                                <label for="title">{{trans('lang.ar_meta_keyword')}}</label>
                                                {!!Form::text('meta_keyword_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                                             </div>
                                         </div>
            						  </div>
            				    	</div>
            				   </div>  
                            </div>
                        
                               {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}

                        </section>
                    </div>
                </div>
           </div>
       </section>
  </div>
 <script>
  

    CKEDITOR.replace('meta_description', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    CKEDITOR.replace('meta_description_ar', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
</script>


