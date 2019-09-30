        @extends('admin.dashboard')
        @section('content')
          <header class="page-header">
						<h2>{{trans('lang.orders')}}</h2>
						  <div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>{{trans('lang.orders')}}</span></li>
							</ol>

							<a class="sidebar-right-toggle"></a>
						</div>
					</header>

                     @if(Session::has('flash_message'))
                         <div class="alert alert-success text-center"><em> {!! session('flash_message') !!}</em></div>
                     @endif
        <div class="row">
            <div class="col-sm-6">
             <form  action="sortorders"  method="get"  class="form-inline">
              <select  name="status" class="form-control">
                  
             <option  value="0">{{trans('lang.ordered')}}</option>
             <option  value="1">{{trans('lang.unshiped')}}</option>
             <option  value="2">{{trans('lang.shiped')}}</option>
             <option  value="3">{{trans('lang.delivered')}}</option>
             <option  value="4">{{trans('lang.return')}}</option>
             <option  value="5">{{trans('lang.cancelled')}}</option>
            </select>  
            
              <button  class="btn btn-success">{{trans('lang.filter')}}</button>
              
             </form>
            </div>
          </div>
  
                        <section class="panel" style=" padding: 10px;">
                            <header class="panel-heading">
                               <h2 class="panel-title">{{trans('lang.orders')}}</h2>
                            </header>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center;">
                              <thead>
                                <tr>
                                    <th data-field="id" style="text-align: center;"></th>
                                    <th data-field="number" style="text-align: center;">{{trans('lang.name')}}</th>
                                    <th data-field="date" style="text-align: center;">{{trans('lang.phone')}}</th>
                                    <th data-field="number" style="text-align: center;">{{trans('lang.email')}}</th>
                                    <th data-field="number" style="text-align: center;">{{trans('lang.status')}}</th>
                                    <th data-field="number" style="text-align: center;">{{trans('lang.date')}}</th>
                                    <th data-field="date" style="text-align: center;">{{trans('lang.total')}}</th>
                                    <th data-field="progress" style="text-align: center;">{{trans('lang.actions')}}</th>
                                   </tr>
                                  </thead>
                                    <tbody>
                                      @include('admin.orders.loop')
                                    </tbody>
                                </table>
                                   {!! $orders->render() !!}
                            </div>
                        </section>
                     @endsection