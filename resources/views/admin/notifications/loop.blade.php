@foreach($orders  as $row)
<tr id="trow_{{ $row->id }}">
    <td class="text-center">{{ $row->id }}
<!--        <input type="checkbox" id="home{{ $row->id }}" name="id" value="{{ $row->id }}">
          <label for="home{{ $row->id }}"> </label>	-->
    </td>
    <td><strong>{{  $row->name }}</strong></td>
    <td><strong>{{  $row->email }}</strong></td>
    <td><strong><a href="{{ url('controll/notifications/'.$row->id ) }}">{{  date('d ,M Y',strtotime($row->created_at)) }}</a></strong></td>
    <td>
        {!! Form::open(['action'=>['NotificationsController@destroy',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
        <button type="submit" class="btn btn-danger red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
        {!! Form::close() !!}
    </td>
</tr>
@endforeach
