
    @if(Session::has('flash_message'))
 <div class="alert alert-danger text-center"><em> {!! session('flash_message') !!}</em></div>
        @endif
        <div class="row">
         <div class="col-md-12">
     <section class="panel">
     <header class="panel-heading">                                         
    <h2 class="panel-title">Add Products</h2>
          </header>
           <div class="panel-body">
            <div class="row">
                
                 <div class="tabs tabs-vertical tabs-left">
								<ul class="nav nav-tabs  col-sm-4">
								    
									<li class="active">
										<a href="#main" data-toggle="tab"><i class="fa fa-star"></i>Main </a>
									</li>
									<li>
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
                                            {!!Form::select('catalog_id', $cats,null,array('class'=>'form-control','id'=>'cat_id','required'))!!}
                                         </div>
                                     </div>
                                    <div class="form-group">
                                        <div class="col-sm-8">
                                            <label for="blog">Product Status</label>
                                            {!!Form::select('status', array('1'=>'Publish','0'=>'Publish as
                                            Sold','2'=>'Hidden'),null,array('class'=>'form-control','id'=>'section_id'))!!}
                
                                        </div>
                                    </div>
                                    
                                      <div class="form-group">
                                        <div class="col-sm-8">
                                            <label for="blog">Product Enabled</label>
                                            {!!Form::select('active', array('1'=>'Active','0'=>'Desactive'),null,array('class'=>'form-control','id'=>'section_id'))!!}
                
                                        </div>
                                    </div>
                    
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog">Product Price</label>
                                          {!!Form::number('price',
                                             null,array('class'=>'form-control','id'=>'address','required'=>'required','step'=>'any'))!!}
                                              @if($errors->has('price'))
                                         <label class="alert alert-danger nopaddinng">{{ $errors->first('price') }}</label>
                                             @endif
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog">Product Sku</label>
                                        {!!Form::text('sku',
                                        null,array('class'=>'form-control','id'=>'address_ar','required'=>'required'))!!}
                                        @if($errors->has('sku'))
                                        <label class="alert alert-danger nopaddinng">{{ $errors->first('sku') }}</label>
                                        @endif
                                    </div>
                                </div>
                  
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog">Product Model</label>
                                        {!!Form::text('model', null,array('class'=>'form-control','required'=>'required'))!!}
            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog">Product Offer %</label>
                                        {!!Form::number('offer', null,array('class'=>'form-control'))!!}
            
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog">Product Weight in gs</label>
                                        {!!Form::number('weight', null,array('class'=>'form-control','required'=>'required','step'=>'any'))!!}
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                       <label for="name">Blocks</label>

                                        {!!Form::select('block_id', $blocks,null,array('class'=>'form-control'))!!}
                                    </div>
                                </div>
            				</div>
								    
						  <div id="en" class="tab-pane active">
                	               <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="title"> Name</label>
                                        {!!Form::text('name',
                                       null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                                  </div>
                                 </div>
                                 
                                   <div class="form-group">
                                    <div class="col-sm-8">

                                        <label for="title"> custom url</label>
                                        {!!Form::text('custom_url',
                                        null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                                        @if($errors->has('custom_url'))
                                        <label class="alert alert-danger nopaddinng">{{ $errors->first('custom_url') }}</label>
                                        @endif
                                    </div>
                                </div>
                                
                               
						    	</div>
						   	   <div id="ar" class="tab-pane">
                                    <div class="form-group">
                                      <div class="col-sm-8">
                                         <label for="title"> Name arabic</label>
                                         {!!Form::text('name_ar',
                                            null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                                            @if($errors->has('name_ar'))
                                            <label class="alert alert-danger nopaddinng">{{ $errors->first('name_ar') }}</label>
                                            @endif
                                    </div>
                                </div>
                              <div class="form-group">
                                <div class="col-sm-8">
                                    <label for="title"> custom url arabic</label>
                                    {!!Form::text('custom_url_ar',
                                    null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                                    @if($errors->has('cutom_url_ar'))
                                    <label class="alert alert-danger nopaddinng">{{ $errors->first('custom_url_ar') }}</label>
                                    @endif
                                  </div>
                               </div>
        			    	</div>
        							
        							
        					      <div id="seo" class="tab-pane">
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="title">Meta title</label>
                                                {!!Form::text('meta_title', null,array('class'=>'form-control','id'=>'title'))!!}
                                            </div>
                                        </div>
                            
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="title">Meta title arabic</label>
                                                {!!Form::text('meta_title_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="title">Meta Description</label>
                                                {!!Form::textarea('meta_description',
                                                null,array('class'=>'form-control','id'=>'meta_description'))!!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="title">Meta Description Arabic</label>
                                                {!!Form::textarea('meta_description_ar',
                                                null,array('class'=>'form-control','id'=>'meta_description_ar'))!!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                            
                                            <div class="col-sm-6">
                                                <label for="title">Meta keyword </label>
                                                {!!Form::text('meta_keyword', null,array('class'=>'form-control','id'=>'meta_keyword'))!!}
                                            </div>
                                        </div>
                            
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="title">Meta keyword </label>
                                                {!!Form::text('meta_keyword_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                                            </div>
                                        </div>
                                       
            						</div>
            					</div>
            				</div>  
                        </div>
                        
                          {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!} 
                
       
              <!-- <div class="col-md-12">
                <section class="panel">
                <h2 class="panel-title">Product Quantity</h2>
                    </header>
                 <div class="panel-body">
                    <div class="row">
                       <div class="col-sm-6">
                   {!!Form::text('size[]', null,array('class'=>'validate','steps'=>'any'))!!}
                    <label for="meta_keyword">Product  Size</label>
                        </div>
                    <div class="col-sm-6">
                            {!!Form::text('qu[]', null,array('class'=>'validate','steps'=>'any'))!!}
                        <label >Value</label>
                        </div>
                    </div>
                </div>
            </section>
          </div>-->
            </div>
        </div>
        </section>
    </div>
<script>
    CKEDITOR.replace('desc', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    CKEDITOR.replace('ar_desc', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    CKEDITOR.replace('return_policy', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    CKEDITOR.replace('ar_return_policy', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
</script>
