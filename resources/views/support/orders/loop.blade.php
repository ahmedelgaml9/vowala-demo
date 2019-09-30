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
    @elseif($row->status == 4)
        <td style="color:red" >Return </td>
    @elseif($row->status == 5)
        <td style="color:red" >{{trans('lang.cancelled')}}</td>    
    @else
        <td style="color:green">{{trans('lang.delivered')}}</td>
    @endif
    
    <td><strong><a href="{{ url('support/orders/'.$row->id ) }}">{{  date('d ,M Y',strtotime($row->created_at)) }}</a></strong></td>
 </tr>
@endforeach
