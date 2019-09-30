
@section('stylescss')
   

@endsection

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
											    
												<div class="col-md-8">
												    <label class="control-label">{{trans('lang.photo')}}</label>
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fa fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists">Change</span>
																<span class="fileupload-new">Select file</span>
																<input type="file"  name="photo">
															</span>
														</div>
													</div>
												</div>
											</div>
                                     @if($errors->has('photo'))
                                      <label class="alert alert-danger nopaddinng">{{ $errors->first('photo') }}</label>
                                    @endif
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="title">{{trans('lang.name')}}</label>
                            {!!Form::text('title',
                            null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                               @if($errors->has('title'))
                                  <label class="alert alert-danger nopaddinng">{{ $errors->first('title') }}</label>
                                 @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="title">{{trans('lang.ar_name')}}</label>
                            {!!Form::text('title_ar', null,array('class'=>'form-control','id'=>'title'))!!}

                              @if($errors->has('title_ar'))
                              <label class="alert alert-danger nopaddinng">{{ $errors->first('title_ar') }}</label>
                             @endif

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
</div>


     @section('script')
	    	        	<script src="{{ asset('admin-assets')}}/assets/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script>

	  @endsection