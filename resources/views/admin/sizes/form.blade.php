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
										<a href="#main" data-toggle="tab"><i class="fa fa-star"></i>Main </a>
									</li>
							      </ul>
    						<div class="tab-content col-sm-12">
    							<div id="main" class="tab-pane active">
                                   <div class="col-sm-8">
                                        <label for="title"> {{trans('lang.size')}}</label>
                                        {!!Form::text('size',
                                           null,array('class'=>'form-control','id'=>'title'))!!}
                                       
                                      </div>
                                 </div>
                        
                                 {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
        
                            </div>
                        </div>
                       </div>
                     </div>
                 </section>
         
   <script>
  

    CKEDITOR.replace('meta_description', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    CKEDITOR.replace('meta_description_ar', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
</script>


