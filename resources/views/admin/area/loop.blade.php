@foreach($c  as $row)
<tr id="trow_{{ $row->id }}">
    <td class="text-center">{{ $row->id }}</td>
<td><strong>{{  $row->name }}</strong></td>
<td>
    <a class="on-default edit-row" href="{{ url('admin/area/'.$row->id.'/edit') }}" ><i class="fa fa-pencil"></i></a>
    {!! Form::open(['action'=>['AreasController@destroy',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
    <button type="submit"   class="on-default remove-row" onclick='return confirm("Are You sure!!")' ><i class="fa fa-trash-o"></i></button>
    {!! Form::close() !!}

</td>
</tr>
@endforeach