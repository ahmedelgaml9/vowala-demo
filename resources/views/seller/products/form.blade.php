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
                    <div class="form-group">
                        <div class="col-sm-6">
                            <div class="btn teal lighten-1">
                                <span>Main Photo</span>
                                {!!Form::file('photo', null,array('id'=>'image','required'=>'required'))!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-sm-6">
                            <div class="btn teal lighten-1">
                                <span></span>
                                <input type="file" name="gallary[]" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="title"> Name</label>
                            {!!Form::text('name',
                            null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="title"> Name arabic</label>

                            {!!Form::text('name_ar',
                            null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                            @if($errors->has('name_ar'))
                            <label class="alert alert-danger nopaddinng">{{ $errors->first('name_ar') }}</label>
                            @endif

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="title"> custom url</label>
                            {!!Form::text('custom_url',
                            null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                            @if($errors->has('custom_url'))
                            <label class="alert alert-danger nopaddinng">{{ $errors->first('custom_url') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="title"> custom url arabic</label>
                            {!!Form::text('custom_url_ar',
                            null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                            @if($errors->has('cutom_url_ar'))
                            <label class="alert alert-danger nopaddinng">{{ $errors->first('custom_url_ar') }}</label>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="title">Product Preparing Duration</label>
                            {!!Form::number('duration',
                            null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="blog">categories</label>
                            {!!Form::select('cat_id', $cats,null,array('class'=>'form-control','id'=>'cat_id'))!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="blog">Product Status</label>
                            {!!Form::select('status', array('1'=>'Publish','0'=>'Publish as
                            Sold','2'=>'Hidden'),null,array('class'=>'form-control','id'=>'section_id'))!!}

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="blog">Product Price</label>
                            {!!Form::number('price',
                            null,array('class'=>'form-control','id'=>'address','required'=>'required','step'=>'any'))!!}

                            @if($errors->has('price'))
                            <label class="alert alert-danger nopaddinng">{{ $errors->first('price') }}</label>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="blog">Product tax</label>
                            {!!Form::number('tax',
                            null,array('class'=>'form-control','id'=>'address_ar','required'=>'required'))!!}

                        </div>
                    </div>

                  <div class="form-group">
                        <div class="col-sm-6">
                            <label for="blog">Product Quantity</label>
                            {!!Form::number('quantity', null,array('class'=>'form-control','required'=>'required'))!!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="blog">Product Sku</label>
                            {!!Form::text('sku',
                            null,array('class'=>'form-control','id'=>'address_ar','required'=>'required'))!!}
                            @if($errors->has('sku'))
                            <label class="alert alert-danger nopaddinng">{{ $errors->first('sku') }}</label>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="blog">Product Model</label>
                            {!!Form::text('model', null,array('class'=>'form-control','required'=>'required'))!!}

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="blog">Product Offer %</label>
                            {!!Form::number('offer', null,array('class'=>'form-control'))!!}

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="blog">Product Weight in gs</label>
                            {!!Form::number('weight', null,array('class'=>'form-control','required'=>'required','step'=>'any'))!!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            {!!Form::select('block_id', $blocks,null,array('class'=>'form-control','id'=>'brand_id'))!!}
                            <label for="name">Blocks</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            {!!Form::select('brand_id', $brands,null,array('class'=>'form-control','id'=>'brand_id'))!!}
                            <label for="name">Brand</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="desc">Product Description</label>
                            {!!Form::textarea('desc',
                            null,array('class'=>'validate','id'=>'desc','placeholder'=>'Product
                            Description','style'=>'padding-top:20px','required'=>'required'))!!}

                            @if($errors->has('desc'))
                            <label class="alert alert-danger nopaddinng">{{ $errors->first('desc') }}</label>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="desc">Product Arabic Description</label>
                            {!!Form::textarea('desc_ar',
                            null,array('class'=>'validate','id'=>'desc_ar','placeholder'=>'Product
                            Description','style'=>'padding-top:20px','required'=>'required'))!!}
                            @if($errors->has('desc_ar'))
                            <label class="alert alert-danger nopaddinng">{{ $errors->first('desc_ar') }}</label>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <br>
    </div>
</div>
</div>
</div>
<div class="col-md-12">
    <section class="panel">
        <h2 class="panel-title"></h2>
        </header>
        <div class="panel-body">
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
            @if(!isset($row))
            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
            @endif

          </section>
       <div class="col-md-12">
             <section class="panel">
               <h2 class="panel-title">Product Specifications</h2>
                 </header>
                 <div class="panel-body">
                 <div class="row">
                   <div class="col-sm-3">
                     {!!Form::text('spec[]', null,array('class'=>'form-control','steps'=>'any'))!!}
                       <label for="meta_keyword">Spec Key</label>
                        </div>
                   
                        <div class="col-sm-3">
                           {!!Form::text('value[]', null,array('class'=>'form-control','steps'=>'any'))!!}
                            <label >Value</label>
                        </div>
                  
                        <div class="col-sm-3">
                             {!!Form::text('spec_ar[]', null,array('class'=>'form-control','steps'=>'any'))!!}
                            <label for="meta_keyword">Spec Arabic Key</label>
                        </div>
                
                    <div class="col-sm-3">
                          {!!Form::text('value_ar[]', null,array('class'=>'form-control','steps'=>'any'))!!}
                           <label>Arabic Value</label>
                        </div>
                  
                        </div>
                         </div>
                     </section>
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
    {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
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
    CKEDITOR.replace('meta_description', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    CKEDITOR.replace('meta_description_ar', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
</script>