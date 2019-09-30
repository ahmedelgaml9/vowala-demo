@foreach($rows as $row)
<tr id="trow_{{ $row->id }}">
    <td class="text-center">{{ $row->id }}</td>
    <td class="text-center">{{ $row->name}}</td>

    <td class="text-center"><strong><img src="{{ asset('admin-assets/images/blogs/'.$row->photo)}}" style="height: 100px;width: 200px;"></strong></td>
    <td class="text-center">
        <a class="on-default edit-row" href="{{ url('admin/blog/'.$row->id.'/edit') }}"><span class="fa fa-pencil"> Edit</span></a>
       {!! Form::open(['action'=>['BlogController@destroy',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
    <button type="submit"   class="on-default remove-row" onclick='return confirm("Are You sure!!")' ><i class="fa fa-trash-o"></i></button>
        {!! Form::close() !!}
    </td>
</tr>
@endforeach