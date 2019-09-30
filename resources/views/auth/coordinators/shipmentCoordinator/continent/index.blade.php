@extends('coordinators.shipmentCoordinator.dashboard')
@section('content')
@if(Session::has('flash_message'))
        <div class="alert alert-success text-center"><em> {!! session('flash_message') !!}</em></div>
    @endif

                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                        <div class="fixed-action-btn">
                                            <a class="btn-floating btn-large red"  href="{{ url('admin/continents/create')}}">
                                                <i class="btn btn-success" >add</i>
                                            </a>
                                        </div>
                                </div>
                               <h2 class="panel-title">Continents</h2>
                            </header>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                    <thead>
                                        <tr>
                                            <th data-field="id">ID</th>
                                            <th data-field="company"> Name</th>
                                            <th data-field="progress">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @include('coordinators.shipmentCoordinator.continent.loop')
                                    </tbody>
                                </table>
                                   {!! $c->render() !!}

                            </div>
                        </section>

@endsection