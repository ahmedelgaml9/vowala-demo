@foreach($products  as $row)
<tr id="trow_{{ $row->id }}">
    <td class="text-center">{{ $row->id }}</td>
    <td><strong><img src="{{ asset('admin-assets/images/products/'.$row->catalog->photo)}}" style="height: 100px;width: 200px;"></strong></td>
    <td><strong>{{  $row->name }}</strong></td>
    <td><strong>{{  $row->catalog->cat->name }}</strong></td>
    <td><strong>{{  $row->Seller->name }}</strong></td>
    <td>{{  $row->quantity }}</td>
    <td>
        <a class="btn btn-default btn-rounded btn-sm" href="{{ url('seller/ourproducts/'.$row->id.'/edit') }}" ><span class="fa fa-pencil"></span></a>
       
        {!! Form::open(['action'=>['Seller\ProductController@destroy',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
        <button type="submit" class="btn btn-danger red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
        {!! Form::close() !!}
    </td>
</tr>
@endforeach