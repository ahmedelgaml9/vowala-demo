@extends('admin.dashboard')
@section('content')
            <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                        <div class="fixed-action-btn">
                                           
                                        </div>
                                </div>
                        
                               <h2 class="panel-title">Seo</h2>
                            </header>
                            <div class="panel-body">
                        <table class="table table-bordered table-striped mb-none" id="datatable-default">
                           <thead>
                          <tr>
                    <th data-field="id">#</th>
                    <th data-field="company">Page Name</th>
                    <th data-field="progress">Actions</th>
                </tr>
            </thead>
            <tbody class="data">
                @foreach($rows  as $row)
                <tr id="trow_{{ $row->id }}">
                    <td class="text-center">{{ $row->id }}</td>
                    <td>{{ $row->page }}</td>
                    <td>
                        <a class="btn btn-default btn-rounded btn-sm" href="{{ url('controll/meta/'.$row->id.'/edit') }}" ><span class="fa fa-pencil"></span></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $rows->render() !!}
    
</section>
@stop