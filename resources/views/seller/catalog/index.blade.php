
@extends('seller.dashboard')
@section('content')
@if(Session::has('flash_message'))
<div class="alert alert-success text-center"><em> {!! session('flash_message') !!}</em></div>
@endif

<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <div class="fixed-action-btn">
    
    
            </div>
        </div>
        <h2 class="panel-title">catalog</h2>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
        <thead>
                  <tr>
                    <th data-field="id">ID</th>
                    <th data-field="company">Image</th>
                    <th data-field="number"> Name</th>
                    <th data-field="date">Category</th>
                    <th data-field="progress">Actions</th>
                </tr>
              </thead>
              <tbody class="data">
                  @include('seller.catalog.loop')
              </tbody>
            </table>
              {!! $rows->render() !!}
        </div>
     </section>
@endsection
