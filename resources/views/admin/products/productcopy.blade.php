
@extends('admin.dashboard')
@section('content') 

{!! Form::open(array('route' =>'cartproducts.store','files'=>true,'class' => 'ajax-form-request')) !!}

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
								    	<a href="#sell" data-toggle="tab">Sell</a>
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
									 <li>
								    	 <a href="#sizes" data-toggle="tab">Sizes</a>
									  </li>
									  
									  <li>
								    	 <a href="#colors" data-toggle="tab">Colors</a>
									  </li>
									     <li>
										<a  href="#related" data-toggle="tab">Related Products </a>
								    	</li>	  
								   </ul>
					    	<div class="tab-content col-sm-12">
						    	<div id="main" class="tab-pane active">
            					   <div class="form-group">
                                      <div class="col-sm-8">
                                         <div class="btn teal lighten-1">
                                            <span>Main Photo</span>
                                            {!!Form::file('photo', null,array('id'=>'image'))!!}
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
                                            <label for="blog">Categories Status</label>
                                            <br>
                                            <input type="radio" id="home" name="type" value="hot" @if(isset($row) && $row->type== 'hot') checked @endif>
                                                <label for="home">Hot</label>&nbsp;&nbsp;	
                                            <input type="radio" id="header" name="type"  value="sale" @if(isset($row) && $row->type == 'sale') checked @endif>
                                                <label for="header">Sale</label>&nbsp;&nbsp;	
                                            <input type="radio" id="new"  name="type"  value="new" @if(isset($row) && $row->type == 'new') checked @endif>
                                                 <label >New</label>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <div class="col-sm-8">
                                                {!!Form::hidden('catalog_id',null,array('class'=>'form-control','id'=>'cat_id'))!!}
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
                                            <label for="blog">Product Sku</label>
                                            {!!Form::text('sku',
                                            $product->sku,array('class'=>'form-control','id'=>'address_ar'))!!}
                                            @if($errors->has('sku'))
                                            <label class="alert alert-danger nopaddinng">{{ $errors->first('sku') }}</label>
                                            @endif
                                         </div>
                                     </div>
            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog">Product Model</label>
                                        {!!Form::text('model',$product->model,array('class'=>'form-control'))!!}
                                            @if($errors->has('model'))
                                           <label class="alert alert-danger nopaddinng">{{ $errors->first('model') }}</label>
                                            @endif
            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog">Product Offer %</label>
                                        {!!Form::number('offer',$product->offer ,array('class'=>'form-control'))!!}
        
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog">Product Weight in gs</label>
                                        {!!Form::number('weight',$product->weight,array('class'=>'form-control','step'=>'any'))!!}
                                           @if($errors->has('weight'))
                                             <label class="alert alert-danger nopaddinng">{{ $errors->first('weight') }}</label>
                                           @endif
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                         <label for="name">Blocks</label>
                                          {!!Form::select('block_id', $blocks,null,array('class'=>'form-control','id'=>'brand_id'))!!}
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="col-sm-8">
                                       <label for="name">Brand</label>
                                         {!!Form::select('brand_id', $brands,null,array('class'=>'form-control','id'=>'brand_id'))!!}
                                    </div>
                                </div>
            			   	</div>
							
						    <div id="sell" class="tab-pane">
                	             <div class="form-group">
                                        <div class="col-sm-8">
                                            <label for="blog">Stock Availability</label>
                                            {!!Form::select('status', array('1'=>'Available','0'=>'out of stock'),null,array('class'=>'form-control'))!!}
                                        </div>
                                    </div>
                                    
                                  <div class="form-group">
                                        <div class="col-sm-8">
                                            <label for="blog">Inventory Management</label>
                                            {!!Form::select('manage_stock', array('1'=>'track','0'=>'donot track'),null,array('class'=>'form-control','id'=>'stockcart'))!!}
                                        </div>
                                    </div>
                                    
                                        
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="blog">Product Price</label>
                                          {!!Form::number('price', $product->price ,
                                           array('class'=>'form-control','id'=>'address','step'=>'any'))!!}
                                              @if($errors->has('price'))
                                         <label class="alert alert-danger nopaddinng">{{ $errors->first('price') }}</label>
                                             @endif
                                    </div>
                                </div>
                	             
    						       </div>
						         <div id="en" class="tab-pane">
                	                <div class="form-group">
                                        <div class="col-sm-8">
                                          <label for="title"> Name</label>
                                            {!!Form::text('name',
                                              $product->name,array('class'=>'form-control','id'=>'title'))!!}
                                            @if($errors->has('name'))
                                           <label class="alert alert-danger nopaddinng">{{ $errors->first('name') }}</label>
                                            @endif
                                             
                                      </div>
                                    </div>
                                 
                                   <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="title"> custom url</label>
                                        {!!Form::text('custom_url',
                                        null,array('class'=>'form-control','id'=>'title'))!!}
                                        @if($errors->has('custom_url'))
                                        <label class="alert alert-danger nopaddinng">{{ $errors->first('custom_url') }}</label>
                                        @endif
                                     </div>
                                 </div>
                                
                                  <div class="form-group">
                                        <div class="col-sm-8">
                                            <label for="desc">Product Arabic Short Description</label>
                                            {!!Form::text('short_description',
                                            $product->short_description,array('class'=>'form-control','id'=>'title'))!!}
                                        </div>
                                     </div>
                                
                                  <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="desc">Product Description</label>
                                        {!!Form::textarea('desc',
                                               $product->desc,array('class'=>'form-control','id'=>'desc'))!!}
                                         @if($errors->has('desc'))
                                        <label class="alert alert-danger nopaddinng">{{ $errors->first('desc') }}</label>
                                        @endif
                                    </div>
                                 </div>
            						 <div class="form-group">
                                        <div class="col-sm-8">
                                        <label for="desc">Return policy </label>
                                        {!!Form::textarea('return_policy',
                                             $product->return_policy,array('class'=>'validate'))!!}
                                             @if($errors->has('return_policy'))
                                             <label class="alert alert-danger nopaddinng">{{ $errors->first('return_policy')}}</label>
                                             @endif
                                      </div>
                                  </div>
						      </div>
						   	   <div id="ar" class="tab-pane">
                                    <div class="form-group">
                                      <div class="col-sm-8">
                                         <label for="title"> Name arabic</label>
                                         {!!Form::text('name_ar',
                                             $product->name_ar ,array('class'=>'form-control','id'=>'title'))!!}
                                            @if($errors->has('name_ar'))
                                            <label class="alert alert-danger nopaddinng">{{ $errors->first('name_ar') }}</label>
                                            @endif
                                    </div>
                                </div>
                              <div class="form-group">
                                <div class="col-sm-8">
                                    <label for="title"> custom url arabic</label>
                                    {!!Form::text('custom_url_ar',
                                    null,array('class'=>'form-control','id'=>'title'))!!}
                                      @if($errors->has('cutom_url_ar'))
                                       <label class="alert alert-danger nopaddinng">{{ $errors->first('custom_url_ar') }}</label>
                                      @endif
                                  </div>
                               </div>
                                  <div class="form-group">
                                   <div class="col-sm-8">
                                    <label for="desc">Product Short Description</label>
                                        {!!Form::text('short_description_ar',
                                               $product->short_description_ar ,array('class'=>'form-control','id'=>'title'))!!}
        
                                  </div>
                              </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label for="desc">Product Arabic Description</label>
                                        {!!Form::textarea('desc_ar',
                                          $product->desc_ar ,array('class'=>'form-control','id'=>'desc_ar'))!!}
                                          @if($errors->has('desc_ar'))
                                           <label class="alert alert-danger nopaddinng">{{ $errors->first('desc_ar') }}</label>
                                          @endif
                                    </div>
                                  </div>
                                  
                                      <div class="form-group">
                                         <div class="col-sm-8">
                                            <label for="desc">Return Policy Arabic</label>
                                              {!!Form::textarea('return_policy_ar',
                                                 $product->return_policy_ar ,array('class'=>'validate'))!!}
                                               @if($errors->has('return_policy_ar'))
                                                  <label class="alert alert-danger nopaddinng">{{ $errors->first('return_policy_ar') }}</label>
                                              @endif
                                          </div>
                                       </div>
        							</div>
        					      <div id="seo" class="tab-pane">
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                                <label for="title">Meta title</label>
                                                {!!Form::text('meta_title', null,array('class'=>'form-control','id'=>'title'))!!}
                                            </div>
                                        </div>
                            
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                                <label for="title">Meta title arabic</label>
                                                {!!Form::text('meta_title_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                                <label for="title">Meta Description</label>
                                                {!!Form::textarea('meta_description',
                                                null,array('class'=>'form-control','id'=>'meta_description'))!!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                                <label for="title">Meta Description Arabic</label>
                                                {!!Form::textarea('meta_description_ar',
                                                null,array('class'=>'form-control','id'=>'meta_description_ar'))!!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                                <label for="title">Meta keyword </label>
                                                {!!Form::text('meta_keyword', null,array('class'=>'form-control','id'=>'meta_keyword'))!!}
                                            </div>
                                        </div>
                            
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                                <label for="title">Meta keyword </label>
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
                        
                            {!! Form::submit('submitbutton', array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
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

@endsection

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

 $(document).on('click', '.image-add-more', function (e) {
     e.preventDefault();
 $('#appendsize').append('<div class="row"><div class="col-sm-6"><input type="text" name="size[]" class="form-control" /></div> <div class="col-sm-6"><input type="text"  name="qu[]" class="form-control" /></div></div></br>')

 
     });
$(document).on('click', '.color', function (e) {
     e.preventDefault();
 $('#appendcolor').append('<input type="text" name="color[]" class="form-control" /></br>')
     }); 
    
 
</script> 
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