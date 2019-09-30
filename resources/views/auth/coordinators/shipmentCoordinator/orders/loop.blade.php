@foreach($orders  as $row)
<tr id="trow_{{ $row->id }}">
    <td class="text-center">{{ $row->id }}</td>
    <td><strong>{{  $row->first_name }}</strong></td>
    <td><strong>{{  $row->phone }}</strong></td>
    <td><strong>{{  $row->email }}</strong></td>
    @if($row->status == 0)
        <td style="color:red" >{{trans('lang.unconfirmed')}}</td>
    @elseif($row->status == 1)
        <td style="color:blue" >{{trans('lang.unshiped')}}</td>
    @elseif($row->status == 2)
        <td style="color:green" >{{trans('lang.shiped')}}</td>
    @elseif($row->status == 3)
        <td style="color:green" >{{trans('lang.delivered')}}</td>    
    @else
        <td style="color:green">{{trans('lang.delivered')}}</td>
    @endif
    <td><strong><a href="{{ url('shipmentCoordinator/orders/'.$row->id ) }}">{{  date('d ,M Y',strtotime($row->created_at)) }}</a></strong></td>
    <td>
        {!! Form::open(['action'=>['Coordinators\shipmentCoordinator\OrderController@destroy',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
        <button type="submit" class="btn btn-danger red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
        {!! Form::close() !!}
    </td>
</tr>
@endforeach
