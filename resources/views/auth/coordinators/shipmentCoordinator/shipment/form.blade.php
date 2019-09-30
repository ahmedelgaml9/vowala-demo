<div class="input-field col s12">
    {!!Form::text('name', null,array('class'=>'validate','id'=>'name' , 'required' => 'required'))!!}
    <label for="name">Shipment Method Name</label>
</div>
<div class="input-field col s12">
    {!!Form::text('desc', null,array('class'=>'validate','id'=>'desc'))!!}
    <label for="name">Shipment Method Description</label>
</div>
<div class="input-field col s12">
    {!!Form::text('ar_desc', null,array('class'=>'validate','id'=>'ar_desc'))!!}
    <label for="name">Arabic Method Description</label>
</div>

<input type="hidden" id="froms"  name='froms' value='{{ Request::old('froms') }}' />
<input type="hidden" id="tos"  name='tos' value='{{ Request::old('tos') }}' />
<input type="hidden" id="values"  name='values' value='{{ Request::old('values') }}' />
@foreach($zones as $zone)
<p class="p-v-xs" style="padding-left: 30px;"><input type="checkbox" id="zone{{$zone->id}}"  name="zones[]" value="{{ $zone->id }}"><label for="zone{{$zone->id}}">{{ $zone->name }}</label> </p>
@endforeach
@if(isset($allZones)&&count($allZones) > 0)
            <!-- Shippment  Price   -->
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                        <div class="pull-right"><a  href="{{url('shipmentCoordinator/shipment', $method->id)}}" class="btn btn-primary" >See all shipment Price and  zones</a> </div>  
                            <span class="card-title">Shipment Price</span><br>
                            <div style="color: red" id='errorhh'></div>
                            <div style="color: green ;font-size: x-large" id='don'></div>
                            <div class="input-field col s3">
                                {{ Form::select('from', $allZones, null, ['class'=>'validate', 'id'=>'from', 'steps'=>'any', 'required' => 'required' ]) }}
                                <label for="from">From</label>
                                <label class="error">{{ $errors->first('from') }}</label>
                            </div>
                            <div class="input-field col s3">
                                {{ Form::select('to', $allZones, null, ['class'=>'validate','id'=>'to','steps'=>'any']) }}
                                <label for="width">To</label>
                                <label class="error">{{ $errors->first('to') }}</label>
                            </div>
                            <div class="input-field col s3">
                                {!!Form::number('value', null,array('class'=>'validate', 'id'=>'value', 'steps'=>'any'))!!}
                                <label for="value">Value</label>
                                <label class="error">{{ $errors->first('value') }}</label>
                            </div>
                            <a class="btn-floating btn-large waves-effect waves-light red" onclick="appendShipmentPrice()"><i class="material-icons">add</i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
@endif
{!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
