@extends('admin.dashboard')
@section('content')
  <header class="page-header">
						<h2>{{trans('lang.area')}}</h2>
						  <div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>{{trans('lang.area')}}</span></li>
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
                                        <div class="fixed-action-btn">
                                            <a class="btn-floating btn-large red"  href="{{ url('admin/area/create')}}">
                                                 <i class="btn btn-success fa fa-plus-square-o" > {{trans('lang.add')}}</i>
                                            </a>
                                        </div>
                                </div>
                               <h2 class="panel-title">{{trans('lang.area')}}</h2>
                            </header>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="datatable-default">
                               <thead>
                                    <tr>
                                        <th class="text-center" data-field="id"></th>
                                        <th class="text-center" data-field="company">{{trans('lang.name')}}</th>
                                        <th class="text-center" data-field="progress">{{trans('lang.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="data">
                                     @include('admin.area.loop')
                                </tbody>
                            </table>
                                  {!! $c->render() !!}
                            </div>
                         </section>
                @stop