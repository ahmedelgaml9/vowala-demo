@foreach($cats  as $row)
<tr id="trow_{{ $row->id }}">
    <td class="text-center">{{ $row->id }}</td>
    <td class="text-center">{{ $row->title}}</td>
    
    <td><strong><img src="{{ asset('admin-assets/images/blocks/'.$row->photo)}}" style="height: 100px;width: 200px;"></strong></td>

     <td class="text-center">
        <a  class="on-default edit-row" href="{{ url('admin/blocks/'.$row->id.'/edit') }}" ><span class="fa fa-pencil"> Edit</span></a>
       
    </td>
</tr>
@endforeach