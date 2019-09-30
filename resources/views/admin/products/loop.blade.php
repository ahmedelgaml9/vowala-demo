@foreach($products  as $row)
<tr id="trow_{{ $row->id }}">
    <td> <strong><a data-toggle="tooltip" title="{{ $row->catalog->name }}"> @if($row->catalog != null){{ str_limit( $row->catalog->name,20 )  }}  @endif</a></strong> </td>
    <td> {{  $row->name}}</td>

  <td><strong>  @if($row->cat != null)  {{  $row->cat->name }}  @endif </strong></td>
    <td><strong>{{  $row->Seller->name }}</strong></td>
    <td><strong>{{  $row->Quantity() }}</strong></td>
    <td> <a class="modal-trigger" data-toggle="modal" > {{ $row->price }} </a> </td>
    <td><strong>@if($row->active  ==1) Active  @else Inactive  @endif</strong></td>

    <td>
        <a class="btn btn-success" href="{{ url('admin/cartproducts/'.$row->id) }}" ><span class="fa fa-eye"> View</span></a>
        <a class="btn btn-sm btn-primary  edit" href="{{ url('admin/cartproducts/'.$row->id.'/edit') }}" ><span class="fa fa-pencil"> Edit</span></a>
         <a class="btn btn-sm btn-primary  edit" href="{{ url('admin/copyproducts/'.$row->id) }}" ><span class="fa fa-pencil">Duplicate </span></a>

       {!! Form::open(['action'=>['ProductController@destroy',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
        <button type="submit" class="btn btn-danger red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span> Delete</button>
        {!! Form::close() !!}
    </td>
</tr>

<div id="modal-{{ $row->id }}" class="modal">
    <div class="modal-cont ent">
        {!! Form::open(['method' => 'PATCH', 'class' => 'ajax-form-request', 'action' => ['ProductController@update',$row->id] ]) !!}
        {{-- {!! Form:: model($row,array('method' => 'PATCH','action' => ['ProductController@update',$row->id], 'files'=>true,'class' => 'ajax-form-request')) !!} --}}
        <div class="message" style="padding-top: 20px">
        </div><!-- div to display message after insert -->
        <div class="card">
            <div class="card-content">
              <div class="input-field col s6">
                {!!Form::number('price', $row->price,array('class'=>'validate','id'=>'price','steps'=>'any'))!!}
                <label for="price">Product Price</label>
                <label class="error">{{ $errors->first('price') }}</label>
              </div>

              <br>
                <span class="card-title">Product Quantity</span>
                <div class="row" id="othersize">
                    <div id='onelinesize'>
                        <div class="input-field col s6">
                            {!!Form::text('size[]', null,array('class'=>'validate','steps'=>'any'))!!}
                            <label for="meta_keyword">Product  Size</label>
                        </div>
                        <div class="input-field col s6">
                            {!!Form::text('qu[]', null,array('class'=>'validate','steps'=>'any'))!!}
                            <label >Value</label>
                        </div>
                    </div>
                </div>
                <a class="btn-floating btn-large waves-effect waves-light red add-othersize" ><i class="material-icons">add</i></a>
            </div>
        </div>
          <input type="submit" name="submit" value="Update" class="btn btn-success">
        {!! Form::close() !!}

    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>

@endforeach
