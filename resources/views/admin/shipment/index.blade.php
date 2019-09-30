@extends('admin.dashboard')
@section('content')
                         <header class="page-header">
                           	<div class="col-sm-6">
										<div class="mb-md">
											<a   class="btn btn-primary" href="{{ url('admin/shipments/create')}}">{{trans('lang.add')}}<i class="fa fa-plus"></i></a>
										</div>
									</div>
						<h2>{{trans('lang.shippingmethods')}}</h2>
						  <div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>{{trans('lang.shippingmethods')}}</span></li>
							</ol>
							<a class="sidebar-right-toggle"></a>
						</div>
					</header>
                     @if(Session::has('flash_message'))
                        <div class="alert alert-success text-center"><em> {!! session('flash_message') !!}</em></div>
                     @endif

                        <section class="panel">
                            <header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
								</div>

								<h2 class="panel-title">{{trans('lang.shippingmethods')}}</h2>
							</header>
							<div class="panel-body">
								
                                    
                                      @include('admin.shipment.loop')
                                     {!! $methods->render() !!}
                                 </div>
                            </section>
                          @endsection