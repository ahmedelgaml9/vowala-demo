@extends('coordinators.shipmentCoordinator.dashboard')
@section('content')
<div class="fixed-action-btn">
    <a class="btn-floating btn-large red  " href="{{ url('shipmentCoordinator/zones/create')}}">
        <i class="large material-icons" >add</i>
    </a>
</div>
 <div class="card invoices-card">
    <div class="card-content">
        <div class="card-options">
            {!! Form::open(['method' => 'get', 'class' => 'searchForm']) !!}
            <input type="text" name="value" class="expand-search searchInput " placeholder="Search" autocomplete="off" >
            {!! Form::close() !!}
        </div>
        <span class="card-title">Zones</span>
        <table class="responsive-table bordered">
            <thead>
                <tr>
                    <th data-field="id">ID</th>
                    <th data-field="company">name</th>
                     <th data-field="progress">Actions</th>
                </tr>
            </thead>
            <tbody class="data">
                @include('coordinators.shipmentCoordinator.zones.loop')
            </tbody>
        </table>
        {!! $zones->render() !!}
    </div>
</div>
 @endsection
