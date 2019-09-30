@extends('coordinators.productCoordinator.dashboard')
@section('content')

<div class="card invoices-card">
    <div class="card-content">
        <div class="card-options">
            {!! Form::open(['method' => 'get', 'class' => 'searchForm']) !!}
            <input type="text" name="value" class="expand-search searchInput " placeholder="Search" autocomplete="off" >
            {!! Form::close() !!}
        </div>
        <span class="card-title">Orders</span>
        <table class="responsive-table bordered">
            <thead>
                <tr>
                    <th data-field="id">#</th>
                    <th data-field="company">Order</th>
                    <th data-field="company">Quantity</th>
                    <th data-field="company">Status</th>
                    <th data-field="company">action</th>
                </tr>
            </thead>
            <tbody class="data">
                @include('coordinators.productCoordinator.products.loop')
            </tbody>
        </table>
        {!! $orders->render() !!}
    </div>
</div>
@stop
