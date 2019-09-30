@extends('admin.dashboard')
@section('content')
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
            </select>  
            
              <button  class="btn btn-success">{{trans('lang.filter')}}</button>
              
             </form>
            </div>
          </div>
  
       
                        <section class="panel">
                            <header class="panel-heading">
                             
                               <h2 class="panel-title">Orders</h2>
                            </header>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="datatable-default">
                              <thead>
                                <tr>
                                    <th data-field="id">#</th>
                                    <th data-field="number">Customer Name</th>
                                    <th data-field="date">Phone</th>
                                    <th data-field="number">Email</th>
                                    <th data-field="number">Status</th>
                                    <th data-field="number">Date</th>
                                    <th data-field="date">Total</th>
                                    <th data-field="progress">Actions</th>
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