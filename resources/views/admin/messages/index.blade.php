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
                        
                               <h2 class="panel-title">Messages</h2>
                            </header>
                            <div class="panel-body">
                  <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>
                                <th data-field="id">#</th>
                                <th data-field="number">Name</th>
                                <th data-field="number">Email</th>
                                <th data-field="number">Sent On</th>
                                <th data-field="progress">Action</th>
                            </tr>
                        </thead>
            <tbody class="data">
                @include('admin.messages.loop')
            </tbody>
        </table>
        {!! $orders->render() !!}
    </div>
</div>
</section>


@endsection