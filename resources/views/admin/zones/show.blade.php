@extends('admin.dashboard')
@section('content')
<div class="row">
    <div class="col s6">
        <div class="card invoices-card">
            <div class="card-content">
                <table class="responsive-table bordered">
                    <thead>
                        <tr>
                             <th data-field="company">name</th>
                            <th data-field="progress">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="data">
                        @foreach($zone->content as $row)
                        <tr id="trow_{{ $row->id }}">
                            <td><strong>{{  $row->name }}</strong></td>
                            <td>
                                {!! Form::open(['action'=>['ZoneController@delcont',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
                                <button type="submit" class="btn btn-danger red waves-effect waves-light" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
             </div>
        </div>
    </div>
</div>
@endsection