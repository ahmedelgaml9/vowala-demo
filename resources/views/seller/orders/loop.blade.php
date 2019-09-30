@foreach($orders  as $row)
<tr id="trow_{{ $row->id }}">
    <td class="text-center">{{ $row->id }}</td>
    <td><strong>{{  $row->product->name }}</strong></td>
    <td><strong>{{  $row->quantity }}</strong></td>
    <td><strong>{{  $row->price }}</strong></td>
     @if($row->status == 1)
    <td>Pending</td>
    @else 
    <td>Confirmed</td>
    @endif
     <td>
         @if($row->status == 1)
        {!! Form::open(['action'=>['Seller\OrderController@update',$row->id],'method'=>'PUT' ,'style'=>'display: inline']) !!}
          <button type="submit" class="btn btn-danger red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-check"></span> Confirm</button>
        {!! Form::close() !!}
        @endif
    </td>
</tr>
@endforeach