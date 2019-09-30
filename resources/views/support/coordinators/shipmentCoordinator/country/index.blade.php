@extends('coordinators.shipmentCoordinator.dashboard')
@section('content')
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves-effect waves-light red waves-light btn modal-trigger" href="#create"><i class="material-icons">add</i></a>
</div>
<div class="card invoices-card">
    <div class="card-content">
        <div class="card-options">
            {!! Form::open(['method' => 'get', 'class' => 'searchForm']) !!}
            <input type="text" name="value" class="expand-search searchInput " placeholder="Search" autocomplete="off" >
            {!! Form::close() !!}
        </div>
        <span class="card-title">Countries</span>
        <table class="responsive-table bordered">
            <thead>
                <tr>
                    <th data-field="id">ID</th>
                    <th data-field="company">name</th>
                     <th data-field="company">Continent</th>
                    <th data-field="progress">Actions</th>
                </tr>
            </thead>
            <tbody class="data">
                @include('coordinators.shipmentCoordinator.country.loop')
            </tbody>
        </table>
        {!! $c->render() !!}
    </div>
</div>
<div id="create" class="modal">
    <div class="modal-content">
        {!! Form::open(array('route' =>'shipmentCoordinator.countries.store','files'=>true)) !!}
        <div class="message">
        </div><!-- div to display message after insert -->
        @include ('coordinators.shipmentCoordinator.country.form',['submitButton' =>'Submit Data'])
        {!! Form::close() !!}
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>
@endsection
