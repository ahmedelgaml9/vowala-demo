@foreach($rows  as $row)
  <tr id="trow_{{ $row->id }}">
    <td class="text-center">{{ $row->id }}</td>
    <td class="text-center"><strong><img src="{{ asset('admin-assets/images/products/'.$row->photo)}}" style="height: 100px;width: 200px;"></strong></td>
    <td class="text-center"><strong><a>{{  $row->name }}</a></strong></td>
       @if($row->cat != null) <td class="text-center"><strong>{{  $row->cat->name }}</strong></td>@endif
      <td class="text-center">
        <a class="btn btn-sm btn-primary  edit" href="{{ url('admin/ourcatalog/'.$row->id.'/edit') }}" ><span class="fa fa-pencil"> </span></a>
     </td>
 </tr>
  @endforeach