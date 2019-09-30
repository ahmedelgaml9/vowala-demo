@extends('coordinators.shipmentCoordinator.dashboard')
@section('content')
<div class="card invoices-card">
    <div class="card-content">
        <div class="card-options">
            {!! Form::open(['method' => 'get', 'class' => 'searchForm']) !!}
            <input type="text" name="value" class="expand-search searchInput " placeholder="Search" autocomplete="off" >
            {!! Form::close() !!}

        </div>
        <span class="card-title">{{ trans('lang.orders') }}</span>
        <table class="responsive-table bordered">
            <thead>
                <tr>
                    <th data-field="id">#</th>
                    <th data-field="number">{{ trans('lang.name') }}</th>
                    <th data-field="date">{{ trans('lang.phone')}}</th>
                    <th data-field="number">{{ trans('lang.email')}}</th>
                    <th data-field="number">{{ trans('lang.status')}}</th>
                    <th data-field="number">{{ trans('lang.sent_on')}}</th>
                    <th data-field="progress">{{ trans('lang.actions')}}</th>
                </tr>
            </thead>
            <tbody class="data">
                @include('coordinators.shipmentCoordinator.orders.loop')
            </tbody>
        </table>
        {!! $orders->render() !!}
    </div>
</div>
@endsection
