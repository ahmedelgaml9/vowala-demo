@extends('seller.dashboard')
@section('content')
<div class="row">
    <div id="test1" class="col s12">
         
        <div class="col s12">
            <div class="card invoices-card">
                <div class="card-content">
                    <span class="card-title">{{ $product->name }} Sizes</span>
                    <table class="responsive-table bordered">
                        <thead>
                            <tr>
                                <th data-field="company">Size</th>
                                <th data-field="company">Quantity</th>
                                <th data-field="progress">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="data">
                            @foreach($product->sizes  as $row)
                            <tr id="trow_{{ $row->id }}">
                                <td><strong>{{  $row->size }}</strong></td>
                                <td><strong>{{  $row->qu }}</strong></td>
                                <td>
                                    <a class="btn btn-default btn-rounded btn-sm modal-trigger" href="#size{{ $row->id}}" ><span class="fa fa-pencil"></span></a>

                                    {!! Form::open(['action'=>['Seller\ProductController@delsize',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
                                    <button type="submit" class="btn btn-danger red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        <div id="size{{ $row->id }}" class="modal">
                            <div class="modal-content">
                                {!! Form:: model($row,array('method' => 'POST','action' => ['Seller\DetailsController@edit',$row->id], 'files'=>true,'class' => 'ajax-form-request')) !!}
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <span class="card-title">Product Details</span><br>
                                            <div class="input-field col s6">
                                                {!!Form::text('size', null,array('class'=>'validate','steps'=>'any'))!!}
                                                <label for="meta_keyword">Product  Size</label>
                                            </div>
                                            <div class="input-field col s6">
                                                {!!Form::number('qu', null,array('class'=>'validate','steps'=>'any'))!!}
                                                <label >Quantity</label>
                                            </div>
                                            <button class=" btn-large waves-effect waves-light green" type="submit"><i class="material-icons">mode_edit</i></button>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
