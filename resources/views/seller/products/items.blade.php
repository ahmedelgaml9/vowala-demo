@foreach($product->Specs  as $row)
<tr id="trow_{{ $row->id }}">
    <td><strong>{{  $row->spec }}</strong></td>
    <td><strong>{{  $row->value }}</strong></td>
    <td>
        <a class="btn btn-default btn-rounded btn-sm modal-trigger" href="#modal{{ $row->id}}" ><span class="fa fa-pencil"></span></a>
  <!--        <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('trow_{{ $row->id }}');"><span class="fa fa-times"></span></button>-->
        {!! Form::open(['action'=>['Seller\ProductController@delspec',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
        <button type="submit" class="btn btn-danger red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
        {!! Form::close() !!}
    </td>
<div id="modal{{ $row->id }}" class="modal">
    <div class="modal-content">
        <div class="message" >
        </div>
        {!! Form:: model($row,array('method' => 'PUT','action' => ['Seller\DetailsController@update',$row->id], 'files'=>true,'class' => 'ajax-form-request')) !!}
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <span class="card-title">Product Specifications</span><br>
                    <div class="input-field col s3">
                        {!!Form::text('spec', null,array('class'=>'validate','steps'=>'any'))!!}
                        <label for="meta_keyword">Spec Key</label>
                    </div>
                    <div class="input-field col s3">
                        {!!Form::text('value', null,array('class'=>'validate','steps'=>'any'))!!}
                        <label >Value</label>
                    </div>
                    <div class="input-field col s3">
                        {!!Form::text('ar_spec', null,array('class'=>'validate','steps'=>'any'))!!}
                        <label for="meta_keyword">Spec Arabic Key</label>
                    </div>
                    <div class="input-field col s3">
                        {!!Form::text('ar_value', null,array('class'=>'validate','steps'=>'any'))!!}
                        <label>Arabic Value</label>
                    </div>
                    <button class=" btn-large waves-effect waves-light green" type="submit"><i class="material-icons">mode_edit</i></button>
                </div></div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>
</tr>
@endforeach