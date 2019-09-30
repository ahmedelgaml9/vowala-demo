@foreach($users  as $row)
<tr id="trow_{{ $row->id }}">
    <td class="text-center">{{ $row->id }}</td>
    <td><strong>{{  $row->name }}</strong></td>
    <td><strong>{{  $row->email }}</strong></td>
    <td>{{ date('d ,M Y',strtotime($row->created_at)) }}</td>

     <td>
        @if($row->id != 1 || Auth::user()->id == 1)
        <a   class="on-default edit-row" href="{{ url('admin/users/'.$row->id.'/edit') }}" ><span class="fa fa-pencil"> Edit</span></a>
        @if($row->id != 1 )
        {!! Form::open(['action'=>['UsersController@destroy',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
         <button type="submit"   class="on-default remove-row" onclick='return confirm("Are You sure!!")' ><i class="fa fa-trash-o"></i></button>
        {!! Form::close() !!}
        @endif        
        @endif
    </td>
</tr>
@endforeach