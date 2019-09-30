@foreach($rows  as $row)
<tr id="trow_{{ $row->id }}">
    <td class="text-center">{{ $row->id }}</td>
    <td class="text-center">{{ $row->title}}</td>

    <td class="text-center"><strong><img src="{{ asset('admin-assets/images/adds/'.$row->photo)}}" style="height: 100px;width: 200px;"></strong></td>
     <td class="text-center">
        <a  class="on-default edit-row"   href="{{ url('admin/adds/'.$row->id.'/edit') }}" ><i class="fa fa-pencil"> </i></a>
 
     
    </td>
</tr>
@endforeach