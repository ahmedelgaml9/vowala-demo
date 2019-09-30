@extends('coordinators.shipmentCoordinator.dashboard')
@section('content')
@if(Session::has('flash_message'))
        <div class="alert alert-success text-center"><em> {!! session('flash_message') !!}</em></div>
    @endif
                        <section class="panel">
                            <header class="panel-heading">
                             
                               <h2 class="panel-title">Orders</h2>
                            </header>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="datatable-default">
                              <thead>
                                <tr>
                                    <th data-field="id">#</th>
                                    <th data-field="number">name</th>
                                    <th data-field="date">phone</th>
                                    <th data-field="number">email</th>
                                    <th data-field="number">status</th>
                                    <th data-field="number">sent_on</th>
                                    <th data-field="progress">Actions</th>
                                  </tr>
                              </thead>
                                    <tbody>
                @include('coordinators.shipmentCoordinator.orders.loop')
            </tbody>
        </table>
        {!! $orders->render() !!}
    </div>
</div>
@endsection
