@extends('coordinators.shipmentCoordinator.dashboard')
@section('content')
<div class="row">
    <div class="col s6">
        <div class="card invoices-card">
            <div class="card-content">
                <table class="responsive-table bordered">
                    <thead>
                        <tr>
                            <th data-field="company">From</th>
                            <th data-field="company">To</th>
                            <th data-field="company">Value</th>
                            <th data-field="progress">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="data">
                    @foreach($all_zones_shipment_price as $shipment_price )
                        <tr id="trow_{{ $shipment_price->id }}">
                            <td class="text-center">{{ $shipment_price->id }}</td>              
                            <td><strong>{{  $shipment_price->fromZone->name}}</strong></td>
                            <td><strong>{{  $shipment_price->toZone->name }}</strong></td>
                            <td><strong>{{  $shipment_price->value }}</strong></td>
                            <td>
                                {!! Form::open(['method' => 'DELETE','action' => ['ShipmentController@destroyShipmentPrice', "shipment_price_id" => $shipment_price->id, "shipment_method_id" => $method->id]]) !!}
                                <button type="submit" class="btn btn-danger red waves-effect waves-light" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!--    ----------------------------------------------->
    <div class="col s6">
        <div class="card invoices-card">
            <div class="card-content">
                <table class="responsive-table bordered">
                    <thead>
                        <tr>
                            <th data-field="company">Zone</th>
                            <th data-field="progress">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="data">
                        @foreach($method->zones as $row)
                        <tr id="trow_{{ $row->id }}">
                            <td><strong>{{  $row->zone->name }}</strong></td>
                            <td>
                                {!! Form::open(['action'=>['Coordinators\shipmentCoordinator\ShipmentController@delzone',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
                                <button type="submit" class="btn btn-danger red waves-effect waves-light" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection