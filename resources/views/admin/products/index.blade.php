
@extends('admin.dashboard')
@section('content')
  <header class="page-header">
						<h2>{{trans('lang.products')}}</h2>
						  <div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>{{trans('lang.products')}}</span></li>
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

								<h2 class="panel-title">{{trans('lang.products')}}</h2>
							</header>
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="mb-md">
											<a href="{{ url('admin/cartproducts/create')}}"><button id="addToTable" class="btn btn-primary">{{trans('lang.add')}}<i class="fa fa-plus"></i></button></a>
										</div>
									</div>
								</div>
								<table class="table table-bordered table-striped mb-none" id="datatable-editable">
                         <thead>
                       <tr>
                           
                        <th  class="text-center" data-field="id"></th>
                        <th class="text-center" data-field="number"> {{trans('lang.name')}}</th>
                        <th class="text-center" data-field="date">{{trans('lang.cat')}}</th>
                        <th class="text-center" data-field="date">{{trans('lang.sellers')}}</th>
                        <th class="text-center" data-field="number">{{trans('lang.quantity')}}</th>
                        <th class="text-center" data-field="number">{{trans('lang.price')}}</th>
                        <th class="text-center" data-field="number">{{trans('lang.status')}}</th>
                        <th class="text-center" data-field="progress">{{trans('lang.actions')}}</th>     
                        
                    </tr>
                </thead>
                <tbody class="data">
                    @include('admin.products.loop')
                </tbody>
            </table>
                {!! $products->render() !!}
         </div>

      </section>
 @endsection
