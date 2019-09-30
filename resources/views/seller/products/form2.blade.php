
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
                    {!!Form::select('catalog_id', $cats,null,array('class'=>'form-control','id'=>'cat_id','required'))!!}
                </div>
                </div>
               
                <div class="form-group">
                <div class="col-sm-6">
                <label for="title">Product Preparing Duration</label>

                    {!!Form::number('duration', null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                </div>
                </div>
               
                <div class="form-group">
                <div class="col-sm-6">
                 <label for="blog">categories</label>
                  {!!Form::select('status', array('1'=>'Publish','0'=>'Publish as Sold','2'=>'Hidden'),null,array('class'=>'form-control','id'=>'section_id','required'))!!}
     
                </select>
                </div>
                </div>
                <div class="form-group">
                <div class="col-sm-6">
                    <label for="blog">Product Price</label>
                    {!!Form::number('price', null,array('class'=>'form-control','id'=>'address','required'=>'required'))!!}
                </div>
                </div>

             <div class="form-group">
                <div class="col-sm-6">
                    <label for="blog">Product tax</label>
                    {!!Form::number('tax', null,array('class'=>'form-control','id'=>'address_ar'))!!}
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
                    {!!Form::number('weight', null,array('class'=>'form-control'))!!}
                    <label class="error">{{ $errors->first('desc') }}</label>
                </div>
                 </div>
              <div class="form-group">
                 <div class="col-sm-6">
                    <label for="blog">Product Sku</label>
                    {!!Form::text('sku', null,array('class'=>'form-control','id'=>'address_ar'))!!}
                    
                    </div>
                    </div>
                <div class="form-group">
                 <div class="col-sm-6">
                    <label for="blog">Product Model</label>
                    {!!Form::text('model', null,array('class'=>'form-control','id'=>'address_ar'))!!}
                    
                </div>
                </div>

              <div class="form-group">
                <div class="col-sm-6">
                <label for="title"> custom url</label>
                  {!!Form::text('custom_url', null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                </div>
                </div>
                <div class="form-group">
                <div class="col-sm-6">
                  <label for="title"> custom url arabic</label>
                    {!!Form::text('custom_url_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
                </div>

               </div>
              </div>
              <br>
               </section>
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
                            null,array('class'=>'form-control','id'=>'title'))!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="title">Meta Description Arabic</label>
                            {!!Form::textarea('meta_description_ar',
                            null,array('class'=>'form-control','id'=>'title'))!!}
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-sm-6">
                            <label for="title">Meta keyword </label>
                            {!!Form::text('meta_keyword', null,array('class'=>'form-control','id'=>'title'))!!}
                        </div>
                    </div>
                   
              <div class="form-group">
                  <div class="col-sm-6">
                      <label for="title">Meta keyword </label>
                       {!!Form::text('meta_keyword_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                  </div>
              </div>
           </section>
       </div>
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
              {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
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
