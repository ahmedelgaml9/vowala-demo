@foreach($orders  as $row)
@php
   $user = \App\User::where('id', $row->user_id)->first();
@endphp

<tr id="trow_{{ $row->id }}">

    <td class="text-center">{{ $row->id }}</td>
    <td> <a href="{{ route('productCoordinator.products-request.show',['id'=>$row->id]) }}"> {{ str_limit($row->title,20) }} </a> </td>
    <td> {{ $user->name }} </td>
    @if($row->status == 1)
    <td style="color:green">Approved</td>
    @elseif($row->status == 2)
    <td style="color:red">Holding</td>
    @else
      <td style="color:orange">Pending</td>
    @endif
    <td>
        {!! Form::open(['action'=>['Coordinators\productCoordinator\CoordinatorController@destroy',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
        <button type="submit" class="btn btn-danger btn-rounded btn-sm red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
        {!! Form::close() !!}
    </td>


</tr>

@endforeach
