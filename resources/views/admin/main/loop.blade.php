 @foreach($subscribers  as $row)
                <tr id="trow_{{ $row->id }}">
                    <td class="text-center">{{ $row->id }}</td>
                     <td><strong>{{  $row->email }}</strong></td>
                     <td>{{  date('d ,M Y',strtotime($row->created_at)) }}</td>
                    <td>
                        {!! Form::open(['action'=>['MainController@delsubs',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
                        <button type="submit" class="btn btn-danger btn-sm red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span> Delete</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach