@foreach($slider  as $row)
<tr id="trow_{{ $row->id }}">
    <td class="text-center">{{ $row->id }}</td>
    <td class="text-center"><img src="{{  asset('admin-assets/images/slider/'.$row->photo) }}" width="100" height="70"/></strong></td>
    <td class="text-center"><strong>{{  $row->title }}</strong></td>
            @if($row->status == 1)
    <td class="text-center">Active</td>
            @else
    <td class="text-center">Disactive</td>
            @endif
    <td class="text-center">
    <a  class="on-default edit-row"  href="{{ url('admin/slider/'.$row->id.'/edit') }}" ><span class="fa fa-pencil"> Edit</span></a>
     {!! Form::open(['action'=>['SliderController@destroy',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
         <button type="submit"   class="on-default remove-row" onclick='return confirm("Are You sure!!")' ><i class="fa fa-trash-o"></i></button>
        {!! Form::close() !!}
    </td>
</tr>
@endforeach