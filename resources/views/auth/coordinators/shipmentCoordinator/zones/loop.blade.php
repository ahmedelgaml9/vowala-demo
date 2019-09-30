@foreach($zones as $row)
<tr id="trow_{{ $row->id }}">
    <td class="text-center">{{ $row->id }}</td>
    <td><strong><a href="{{ url('shipmentCoordinator/zones/'.$row->id)}}">{{  $row->name }}</a></strong></td>
    <td>
        <a class="btn btn-default btn-rounded btn-sm waves-effect waves-light btn modal-trigger" href="{{ url('shipmentCoordinator/zones/'.$row->id.'/edit') }}" ><span class="fa fa-pencil"></span></a>
         {!! Form::open(['action'=>['Coordinators\shipmentCoordinator\ZoneController@destroy',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
        <button type="submit" class="btn btn-danger red waves-effect waves-light" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
        {!! Form::close() !!}
    </td>
</tr>
@endforeach
