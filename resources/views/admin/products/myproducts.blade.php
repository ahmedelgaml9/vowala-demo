
@extends('admin.dashboard')
@section('content')
@if(Session::has('flash_message'))
<div class="alert alert-success text-center"><em> {!! session('flash_message') !!}</em></div>
@endif



<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
          
        </div>
            <h2 class="panel-title">My Products</h2>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
            <thead>
                <tr>
                    <th data-field="number">Product Name</th>
                    <th data-field="date">Category</th>
                    <th data-field="date">Seller</th>
                    <th data-field="number">Inventory</th>
                    <th data-field="number">Price</th>
                    <th data-field="number">Status</th>
                    <th data-field="progress">Actions</th>
                </tr>
            </thead>
            <tbody class="data">
                @include('admin.products.loop')
            </tbody>
        </table>
        {!! $products->render() !!}
    </div>

    </section>
@endsection
