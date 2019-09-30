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
                    <div class="col-lg-6">
                    <div class="form-group">
                            <div class="btn teal lighten-1">
                                <span>{{trans('lang.photo')}}</span>
                                {!!Form::file('photo', null,array('id'=>'image'))!!}
                            </div>
                    </div>
                </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                            <div class="btn teal lighten-1">
                                <span></span>
                                <input type="file" name="gallary[]" multiple>
                            </div>
                        </div>
                    </div>
                </div>
                    
                    <div class="form-group">
                            <label for="title">{{trans('lang.title')}}</label>
                            {!!Form::text('title',
                            null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                    </div>

                    <div class="form-group">
                            <label for="title">{{trans('lang.ar_title')}}</label>
                                 {!!Form::text('title_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                    </div>
                
                    <div class="form-group">
                            <label for="blog">{{trans('lang.cats')}}</label>
                            {!!Form::select('cat_id', $cats,null,array('class'=>'form-control','id'=>'cat_id'))!!}
                    </div>
                
                
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                            <label for="blog">{{trans('lang.description')}}</label>
                            {!!Form::textarea('desc', null,array('class'=>'form-control','id'=>'desc'))!!}
                    </div>
                </div>
            
                <div class="col-lg-6">
                    <div class="form-group">
                            <label for="blog">{{trans('lang.ar_description')}}</label>
                            {!!Form::textarea('desc_ar', null,array('class'=>'form-control','id'=>'desc_ar'))!!}
                            <label class="error">{{ $errors->first('desc') }}</label>
                    </div>
                </div>
            </div>
           
           <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                            <label for="blog">{{trans('lang.blog')}}</label>
                            {!!Form::textarea('blog', null,array('class'=>'form-control','id'=>'blog'))!!}
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="blog">{{trans('lang.blog')}}</label>
                        {!!Form::textarea('blog_ar', null,array('class'=>'form-control','id'=>'blog_ar'))!!}
                    </div>
                </div>
            </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="title">{{trans('lang.custom_url')}}</label>
                              {!!Form::text('custom_url',
                                   null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="title">{{trans('lang.ar_custom_url')}} </label>
                            {!!Form::text('custom_url_ar',
                            null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                        </div>
                    </div>
                  
                      
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="blog">{{trans('lang.photo_alt')}}</label>
                            {!!Form::text('photo_alt', null,array('class'=>'form-control'))!!}
                          
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="blog">{{trans('lang.ar_photo_alt')}}</label>
                             {!!Form::text('photo_alt_ar', null,array('class'=>'form-control'))!!}
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
               </section>
           </div>
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
    CKEDITOR.replace('blog', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    CKEDITOR.replace('blog_ar', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
</script>