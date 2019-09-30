@extends('coordinators.shipmentCoordinator.dashboard')
@section('content')

<div class="fixed-action-btn">
    <a class="btn-floating btn-large red  modal-trigger" href="#create">
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
        <span class="card-title">All Continents</span>
        <table class="responsive-table bordered">
            <thead>
                <tr>
                    <th data-field="id">ID</th>
                    <th data-field="company">name</th>
                    <th data-field="progress">Actions</th>
                </tr>
            </thead>
            <tbody class="data">
                @include('coordinators.shipmentCoordinator.continent.loop')
            </tbody>
        </table>
        {!! $c->render() !!}
    </div>
</div>
<div id="create" class="modal">
    <div class="modal-content">
        {!! Form::open(array('route' =>'shipmentCoordinator.continents.store','files'=>true)) !!}
        <div class="message" style=" ">
        </div><!-- div to display message after insert -->
        @include ('coordinators.shipmentCoordinator.continent.form',['submitButton' =>'Submit Data'])
        {!! Form::close() !!}
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>
@endsection
