
@extends('admin.dashboard')
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
                    <th data-field="id">Code</th>
                    <th data-field="company">Image</th>
                    <th data-field="number"> Name</th>
                    <th data-field="date">Category</th>
                </tr>
            </thead>
            <tbody class="data">
                @foreach($rows  as $row)
               <tr id="trow_{{ $row->id }}">
                <td class="text-center">{{ $row->id }}</td>
                <td><strong><img src="{{ asset('admin-assets/images/products/'.$row->photo)}}" style="height: 100px;width: 200px;"></strong></td>
                <td><strong><a>{{  $row->name }}</a></strong></td>
                <td><strong>{{  $row->cat->name }}</strong></td>
              </tr>
                @endforeach
             </tbody>
         </table>
      </div>
    </section>
@endsection
