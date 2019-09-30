@foreach($rows  as $row)
<tr id="trow_{{ $row->id }}">
    <td class="text-center">{{ $row->id }}</td>
    <td><strong><img src="{{ asset('admin-assets/images/products/'.$row->photo)}}" style="height: 100px;width: 200px;"></strong></td>
    <td><strong><a href="{{ url('seller/catalog/'.$row->id)}}">{{  $row->name }}</a></strong></td>
    <td><strong>{{  $row->name_ar }}</strong></td>
    <td><strong>{{  $row->cat->name }}</strong></td>
      
</tr>
@endforeach