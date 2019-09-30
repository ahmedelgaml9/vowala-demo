@extends('admin.dashboard')
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
        <span class="card-title">All Faqs</span>
        <table class="responsive-table bordered">
            <thead>
                <tr>
                    <th data-field="id"></th>
                    <th data-field="company">Question</th>
                    <th data-field="company">Question In Arabic</th>
                    <th data-field="progress">Actions</th>
                </tr>
            </thead>
            <tbody class="data">
                @include('admin.faqs.loop')
            </tbody>
        </table>
        {!! $cats->render() !!}
    </div>
</div>
<div id="create" class="modal">
    <div class="modal-content">
        {!! Form::open(array('route' =>'controll.faqs.store','files'=>true,'class' => 'ajax-form-request')) !!}
        <div class="message">
        </div><!-- div to display message after insert -->
        @include ('admin.faqs.form',['submitButton' => 'Create'])
        {!! Form::close() !!} 
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>
@endsection