@extends('coordinators.shipmentCoordinator.dashboard')
@section('content')
@if (Session::has('error'))
<div  class=" alert alert-warning" style="font-size: 18px;">
     <strong>Warning!</strong>Order Not Confirmed Please Check Your Order Details and Product Quantity
</div>
@endif
<div class="row">
    <div class="col s12">
        <div class="card invoices-card">
            <div class="card-content">
                <span class="card-title"> Details</span>
                <table class="responsive-table bordered">
                    <thead>
                        <tr>
                            <th>Products Name</th>
                            <th>Size </th>
                            <th>Price </th>
                            <th>Quantity</th>
                            <th>sku</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="data">
                        @foreach ($order->products as $det)
                            <tr>
                                <td><a href="{{url($det->product->custom_url)}}" target="_blank">{{ $det->product->title }} </a></td>
                                <td>{{ $det->Size }}</td>
                                <td>{{ $det->price }}</td>
                                <td>{{ $det->quntity }}</td>
                                <td>{{ $det->product->sku }}</td>
                                <td>
                                    @if($det->status == 0)
                                    @if($det->product->Seller->permission == 2)
                                    {!! Form::open(['action'=>['OrderController@edit',$det->id],'method'=>'get','style'=>'display: inline']) !!}
                                    <input type="hidden" value="1" name="status">
                                    {!! Form::submit('Send to Seller',array('class'=>'btn btn-info btn-info btn-sm','onclick'=>'return confirm("Are You sure!!")')) !!}
                                    {!! Form::close() !!}
                                    @endif
                                    {!! Form::open(['action'=>['OrderController@edit',$det->id],'method'=>'get','style'=>'display: inline']) !!}
                                    <input type="hidden" value="2" name="status">
                                    {!! Form::submit('Confirm',array('class'=>'btn btn-info btn-info btn-sm','onclick'=>'return confirm("Are You sure!!")')) !!}
                                    {!! Form::close() !!}
                                    @else

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col s12">
        <div class="card invoices-card" style="font-size:  20px">
            <div class="card-content">
                <span class="card-title"> More Details</span>

                @if($order->delivered == 1)
                <div class="orange">Delivered Order On {{ date('d M, Y', strtotime($order->deliver_date)) }}</div>
                @endif
                <div class="row">
                    <label class="col s4 green-text text-darken-2">Orderd At :</label>
                    <label class="col s8 const">{{ date('d M, Y H:i', strtotime($order->created_at)) }} </label><br />
                    <label class="col s4 green-text text-darken-2"> Customer Name</label>
                    <label class="col s8 const"><a href='{{ url('controll/users/'.$order->user->id.'/edit')}}'>{{$order->first_name}}</a></label><br />
                    <label class="col s4 green-text text-darken-2"> Customer Email</label>

                    @if(isset($order->email))

                    <label class="col s8 const">{{$order->email}}</label><br />
                    @endif
                    <label class="col s4 green-text text-darken-2">Phone Number </label>
                    @if(isset($order->phone))
                    <label class="col s8 const">{{$order->phone}}</label><br/>
                    @endif
                    <label class="col s4 green-text text-darken-2"> Order Address </label>
                    <label class="col s8 const">{{$order->address}}</label><br/>
                    <label class="col s8 const">
                        Country :  {{ $order->country }}<br/>
                        City :  {{ $order->city }}<br/>
                        Address : {{ $order->address  }}<br/>
                    </label>
                    <br />     <br />

                    <label class="col s4 green-text text-darken-2">Shipment Method </label>
                    <label class="col s8 const">{{$order->shipmentmethod->name}}</label><br/>
                    <label class="col s4 green-text text-darken-2"> Total Price  </label>
                    <label class="col s8 const">
                        Oder Price :  {{$order->total_price}}<br/>
                        
                        <!-- Shipment Price :  {{ $order->shipment }}<br/>
                        @if($order->discount > 0)
                        Discount  : {{ $order->discount  }} %  For pormotion Code ( $order->promocode )<br/>
                        @endif
                        -------------------------------------------------<br/>
                        Total :  {{ $order->total_price }}<br/> -->

                    </label>
                    <br/>

                </div>
            </div>
        </div>
    </div>
    <!-- here  the  drop  box for  the  order  status  -->
    @if($order->status != 3)
    {!! Form::open(['action'=>['Coordinators\shipmentCoordinator\OrderController@update',$order->id],'method'=>'PUT']) !!}
    @if($order->status == 0)
    <h3> Need Action</h3>
    @elseif($order->status == 1)
        <h5>Confirmed</h5>
    @elseif($order->status == 2)
        <h5>Shiped</h5>
    @endif
    <select id="status" name="status">
        <option <?php if ($order->status == 1 ) echo 'selected' ; ?> value="1">Confirm This Order</option>
        <option <?php if ($order->status == 2 ) echo 'selected' ; ?> value="2">Ship This Order</option>
        <option <?php if ($order->status == 3 ) echo 'selected' ; ?> value="3">Deliver</option>
    </select>
    {!! Form::submit('submit',array('class'=>'btn btn-info btn-info btn-sm','onclick'=>'return confirm("Are You sure!!")')) !!}
    {!! Form::close() !!}
    @endif
</div>
@endsection
