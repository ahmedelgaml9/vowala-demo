
@extends('seller.dashboard')
@section('content')
@if(Session::has('flash_message'))
<div class="alert alert-success text-center"><em> {!! session('flash_message') !!}</em></div>
@endif

<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <div class="fixed-action-btn">
                <a class="btn-floating btn-large red" href="{{ url('seller/ourproducts/create')}}">
                    <i class="btn btn-success">Add Product</i>
                </a>
            </div>
        </div>
        <h2 class="panel-title">products</h2>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
            <thead>
                <tr>
                    <th data-field="number">#</th>
                    <th data-field="date">Photo</th>
                    <th data-field="number">Product Name</th>
                    <th data-field="date">Category</th>
                    <th data-field="date">Seller</th>
                    <th data-field="number">Product Quantity</th>
                    <th data-field="progress">Actions</th>
                </tr>
            </thead>
            <tbody class="data">
                @include('seller.products.loop')
            </tbody>
        </table>
        {!! $products->render() !!}
    </div>

    </section>
@endsection
