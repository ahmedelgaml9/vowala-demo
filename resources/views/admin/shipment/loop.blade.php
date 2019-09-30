
					<section class="content-with-menu content-with-menu-has-toolbar media-gallery">
						<div class="content-with-menu-container">

							<div class="inner-body mg-main" style="margin-left: 0 !important;">
								<div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
								@foreach($methods  as $row)

									<div class="isotope-item image col-sm-6 col-md-4 col-lg-4">
										<div class="thumbnail">
											<div class="thumb-preview">
												<a class="thumb-image" href="{{asset('admin-assets/images/shipments/'$row->photo)}}">
													<img src="{{asset('admin-assets/images/shipments/'$row->photo)}}" class="img-responsive" alt="Project">
												</a>
												<div class="mg-thumb-options">
													<div class="mg-zoom"><i class="fa fa-search"></i></div>
													<div class="mg-toolbar">
														<div class="mg-option checkbox-custom checkbox-inline">
															<input type="checkbox" id="file_8" value="1">
															<label for="file_8">SELECT</label>
														</div>
														<div class="mg-group pull-right">
                                                             <a   class="on-default edit-row"  href="{{ url('admin/shipments/'.$row->id.'/edit') }}" ><span class="fa fa-pencil"> Edit</span></a>
														</div>
													</div>
												</div>
											</div>
											<h5 class="mg-title text-weight-semibold">{{ $row->name}}</h5>
											<div class="mg-description">
												<small class="pull-left text-muted">{{ $row->name}}</small>
											</div>
										</div>
									</div>
								    	@endforeach
									
								</div>
							</div>
						</div>
					</section>
				





