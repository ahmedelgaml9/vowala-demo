@extends('admin.dashboard')
@section('content')
@if(Session::has('flash_message'))
        <div class="alert alert-success text-center"><em> {!! session('flash_message') !!}</em></div>
    @endif

                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                        <div class="fixed-action-btn">
                                            <a class="btn-floating btn-large red"  href="{{ url('controll/units/create')}}">
                                                <i class="btn btn-success" >add</i>
                                            </a>
                                        </div>
                                </div>
                        
                               <h2 class="panel-title">Units</h2>
                            </header>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                    <thead>
                                        <tr>
                                            <th data-field="id">ID</th>
                                            <th data-field="company"> Name</th>
                                            <th data-field="company">Location</th>
                                            <th data-field="company">image</th>

                                            <th data-field="progress">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @include('admin.units.loop')

                                        
                                    </tbody>
                                </table>
                                   {!! $rows->render() !!}

                            </div>
                        </section>

@endsection