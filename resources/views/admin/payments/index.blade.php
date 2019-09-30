@extends('admin.dashboard')
@section('content')
	<div class="row">
								


                      <header class="page-header">
      	                      <div class="col-sm-6">
										<div class="mb-md">
											<a href="{{ url('admin/payment/create')}}"><button id="addToTable" class="btn btn-primary">{{trans('lang.add')}}<i class="fa fa-plus"></i></button></a>
										</div>
									</div>
						            <h2>{{trans('lang.payments')}}</h2>
								</div>
						       
						  <div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>{{trans('lang.payments')}}</span></li>
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

								<h2 class="panel-title">{{trans('lang.payments')}}</h2>
							</header>
							<div class="panel-body">
							

								<table class="table table-bordered table-striped mb-none" id="datatable-editable">
                                    
                                    <tbody>
                                      @include('admin.payments.loop')

                                        
                                    </tbody>
                                </table>
                                   {!! $rows->render() !!}

                            </div>
                        </section>

@endsection