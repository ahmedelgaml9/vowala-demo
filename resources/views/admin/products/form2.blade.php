
        
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
									 <li>
								    	 <a href="#sizes" data-toggle="tab">{{trans('lang.size')}}</a>
									  </li>
									  
									  <li>
								    	 <a href="#colors" data-toggle="tab">{{trans('lang.ccolors')}}</a>
									  </li>
									  <li>
										<a  href="#related" data-toggle="tab">{{trans('lang.related')}}</a>
								    	</li>
								      </ul>
					        	<div class="tab-content col-sm-12">
						        	<div id="main" class="tab-pane active">
            					      <div class="form-group">
                                        <div class="col-sm-8">
                                            <div class="btn teal lighten-1">
                                                <span>{{trans('lang.photo')}}</span>
                                             {!!Form::file('photo', null,array('id'=>'image'))!!}
                                             
                                		    <form action="/upload" class="dropzone dz-square" id="dropzone-example"></form>

                            				<form class="form-horizontal form-bordered" action="#">

                                                  @if($errors->has('photo'))
                                                    <label class="alert alert-danger nopaddinng">{{ $errors->first('photo') }}</label>
                                                   @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <div class="btn teal lighten-1">
                                            <span></span>
                                            <input type="file" name="gallary[]" multiple>
                                            
                                             @if($errors->has('gallary'))
                                             <label class="alert alert-danger nopaddinng">{{ $errors->first('gallary') }}</label>
                                              @endif
                                            
                                           </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                   <div class="form-group">
                                      <div class="col-sm-8">
                                          <label for="blog">Parent</label>
                                         <select name="cat_id" class="form-control" id="cat_id">
                                             <option    value="0">No Parent</option>
                                                 @foreach($cats as $ca)
                                                <option @if ($ca->id == $product->cat_id) selected  @endif  value="{{ $ca->id }}">{{ $ca->name }}</option>
                                                 @foreach($ca->childrens   as $c)
                                                 <option @if ($c->id == $product->cat_id) selected  @endif }value="{{ $c->id }}"> ^^ {{ $c->name }}</option>
                                                      @endforeach
                                                 @endforeach
                                            </select>
                                          </div>
                                         </div>
                                  
                                       <div class="form-group">
                                            <div class="col-sm-8">
                                                {!!Form::hidden('catalog_id',null,array('class'=>'form-control','id'=>'cat_id'))!!}
                                             </div>
                                         </div>
                                      <div class="form-group">
                                       <div class="col-sm-8">
                                            <input type="radio" id="home" name="type" value="hot" @if(isset($row) && $row->type== 'hot') checked @endif>
                                                <label for="home">Hot</label>&nbsp;&nbsp;	
                                            <input type="radio" id="header" name="type"  value="sale" @if(isset($row) && $row->type == 'sale') checked @endif>
                                                <label for="header">Sale</label>&nbsp;&nbsp;	
                                            <input type="radio" id="new"  name="type"  value="new" @if(isset($row) && $row->type == 'new') checked @endif>
                                                 <label >New</label>
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
                                            <label for="blog">{{trans('lang.sku')}}</label>
                                            {!!Form::text('sku',
                                            null,array('class'=>'form-control','id'=>'address_ar'))!!}
                                            @if($errors->has('sku'))
                                            <label class="alert alert-danger nopaddinng">{{ $errors->first('sku') }}</label>
                                            @endif
                                         </div>
                                     </div>
            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog">{{trans('lang.model')}}</label>
                                              {!!Form::text('model', null,array('class'=>'form-control'))!!}
                                            @if($errors->has('model'))
                                           <label class="alert alert-danger nopaddinng">{{ $errors->first('model') }}</label>
                                            @endif
            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog">{{trans('lang.offer')}}</label>
                                        {!!Form::number('offer', null,array('class'=>'form-control'))!!}
            
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog">{{trans('lang.weight')}}</label>
                                        {!!Form::number('weight', null,array('class'=>'form-control','step'=>'any'))!!}
                                            @if($errors->has('weight'))
                                              <label class="alert alert-danger nopaddinng">{{ $errors->first('weight') }}</label>
                                            @endif
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                         <label for="name">{{trans('lang.cats')}}</label>
                                          {!!Form::select('block_id', $blocks,null,array('class'=>'form-control','id'=>'brand_id'))!!}
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                       <label for="name">{{trans('lang.brands')}}</label>
                                         {!!Form::select('brand_id', $brands,null,array('class'=>'form-control','id'=>'brand_id'))!!}
                                    </div>
                                </div>
            			   	</div>
							
						    <div id="sell" class="tab-pane">
                                  <div class="form-group">
                                        <div class="col-sm-8">
                                            <label for="blog"> {{trans('lang.managesstocks')}}</label>
                                            {!!Form::select('manage_stock', array('1'=>'track','0'=>'donot track'),null,array('class'=>'form-control','id'=>'stockcart'))!!}
                                        </div>
                                    </div>
                                    
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog">{{trans('lang.price')}}</label>
                                          {!!Form::number('price',
                                             null,array('class'=>'form-control','id'=>'address','step'=>'any'))!!}
                                              @if($errors->has('price'))
                                              <label class="alert alert-danger nopaddinng">{{ $errors->first('price') }}</label>
                                             @endif
                                      </div>
                                   </div>
                	             
    						       </div>
						         <div id="en" class="tab-pane">
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
                                  <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="desc">{{trans('lang.desc')}}</label>
                                        {!!Form::textarea('desc',
                                            null,array('class'=>'form-control','id'=>'desc'))!!}
                                         @if($errors->has('desc'))
                                        <label class="alert alert-danger nopaddinng">{{ $errors->first('desc') }}</label>
                                        @endif
                                    </div>
                                 </div>
            						 <div class="form-group">
                                        <div class="col-sm-8">
                                        <label for="desc">{{trans('lang.return_policy')}} </label>
                                        {!!Form::textarea('return_policy',
                                             null,array('class'=>'validate'))!!}
                                             @if($errors->has('return_policy'))
                                             <label class="alert alert-danger nopaddinng">{{ $errors->first('return_policy')}}</label>
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
                                    <label for="title">  {{trans('lang.ar_custom_url')}}</label>
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
                                          null,array('class'=>'form-control','id'=>'desc_ar'))!!}
                                          @if($errors->has('desc_ar'))
                                           <label class="alert alert-danger nopaddinng">{{ $errors->first('desc_ar') }}</label>
                                          @endif
                                    </div>
                                  </div>
                                  
                                      <div class="form-group">
                                         <div class="col-sm-8">
                                            <label for="desc"> {{trans('lang.ar_return_policy')}}</label>
                                              {!!Form::textarea('return_policy_ar',
                                                null,array('class'=>'validate'))!!}
                                                @if($errors->has('return_policy_ar'))
                                                   <label class="alert alert-danger nopaddinng">{{ $errors->first('return_policy_ar') }}</label>
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
                                            @if(!isset($row))
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                            @endif
            						    </div>
            					
        					                 <div id="sizes" class="tab-pane">
        					                    @foreach($sizes as $size) 
                                            <div class="row">
                                            <div class="col-sm-2">

                                                <input type="checkbox"  name="size[]"    value="{{$size->size}}">{{$size->size}}
                                                </div>
                                                <div class="col-sm-2">

                                                <INPUT TYPE="NUMBER" MIN="0" MAX="10000" STEP="2"  class="form-control"  id="qq" name="qu[]">

                                                   </div>
                                                   
                                                </div>
                                                
                                                  @endforeach
                                                   </div>
                                                   
                                                   
                                            
                                     <div id="related"  class="tab-pane"> 
                                        <div class="form-group" id="relatedproduct" name="products">
                                        </div>
            						 </div>
                                    <div id="colors" class="tab-pane">
                                        <div class="form-group">
                                            
                                            
                                            @foreach($colors as $color )
 
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <input type="checkbox"  name="color[]"    value="{{$color->color}}">{{$color->color}}
                                                    </div>
                                                    <div class="col-sm-2">
    
                                                    <INPUT TYPE="NUMBER" MIN="0" MAX="10000" STEP="2"  class="form-control"  id="colorquantity"   name="qu2[]">
    
                                                       </div>
                                                     </div>
                                                     
                                                     @endforeach
            						 </div>
            					</div>
            				</div>  
                        </div>
                        
                            {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
                    </div>
                <br>
            </div>
        </div>
      </div>  
     </div>


                    <!--<div class="col-md-12">
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
<script>
     $(document).ready(function(){
      $('#qq').keyup( function() {
      if (this.value)
        
        {
   
        $('#colorquantity').hide();
        
        }
      
    
    }); 
   });
    
   
      $(document).ready(function(){
      $('#colorquantity').keyup( function() {
      if (this.value)
        
        {
   
        $('#qq').hide();
        
        }
      
    
    }); 
   });
    
</script>

<script>

 $(document).on('click', '.image-add-more', function (e) {
     e.preventDefault();
 $('#appendsize').append('<input type="text" name="size[]" class="form-control" /></br>')
     });
$(document).on('click', '.color', function (e) {
     e.preventDefault();
 $('#appendcolor').append('<input type="text" name="color[]" class="form-control" /></br>')
     }); 
    
 
</script> 


@section('script')

<script>
        
          $(document).ready(function(){
             $("Select[name='cat_id']").change(function(){
                    
              var id= $(this).val();
              var url = "{{ url ('/admin/getrelatedproducts')}}";
              var token = $("input[name='_token']").val();
              $.ajax({
                  url: url,
                  method: 'POST',
                  data: {id:id, _token:token},
                  success: function(data) {
                    $("[name='products']").html('');
                    $("[name='products']").html(data.options);
                     
                  }
                });
              });
        
           });
        </script>    
        
  @endsection
        
        
        
        
        
        
        
        