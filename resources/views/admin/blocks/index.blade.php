@extends('admin.dashboard')
@section('content')
@if(Session::has('flash_message'))
        <div class="alert alert-success text-center"><em> {!! session('flash_message') !!}</em></div>@endif
                        <section class="panel">
                            <header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									
								</div>

								<h2 class="panel-title">{{trans('lang.blocks')}}</h2>
							</header>
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="mb-md">
											<a href="{{ url('admin/blocks/create')}}"><button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button></a>
										</div>
									</div>
								</div>
								<table class="table table-bordered table-striped mb-none" id="datatable-editable">
                                    <thead >
                                        <tr>
                                            <th class="text-center" data-field="id"></th>
                                            <th class="text-center" data-field="company"> {{trans('lang.photo')}}</th>
                                            <th class="text-center" data-field="company">{{trans('lang.name')}}</th>
                                            <th class="text-center" data-field="progress">{{trans('lang.actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @include('admin.blocks.loop')
                                    </tbody>
                                </table>
                                   {!! $cats->render() !!}
                            </div>
                        </section>

@endsection