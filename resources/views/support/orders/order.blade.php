@extends('support.dashboard')
@section('content')
@if (Session::has('error'))
<div  class=" alert alert-warning" style="font-size: 18px;">
     <strong>Warning!</strong>Order Not Confirmed Please Check Your Order Details and Product Quantity
</div>
@endif
<div class="row">
    <div class="col s12">
                  <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                        <div class="fixed-action-btn">
                                        </div>
                                   </div>
                               <h2 class="panel-title"></h2>
                            </header>
                            <div class="panel-body">
                           <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                 @if($order->status != 3 && $order->status != 4)
                                  <!--<a href="{{route('orders.edit', $order->id)}}" class="btn pull-right">Edit  order</a>-->
                                 @endif
                            <thead>
                           <tr>
                            <th>Products Name</th>
                            <th>Price </th>
                            <th>Quantity</th>
                            <th>sku</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="data">
                            @foreach ($order->products as $det)
                            <tr>
                                <td><a href="{{url('product/'.$det->product->custom_url)}}" target="_blank">{{ $det->product->name }} </a></td>
                                <td>{{ $det->price }}</td>
                                <td>{{ $det->quantity }}</td>
                                <td>{{ $det->product->sku }}</td>
                                <td>
                                    @if($det->status == 0)
                                        @if($det->product->Seller->permission == 2)
                                            {!! Form::open(['url'=> ['admin/sendToSeller'] ,'method'=>'get','style'=>'display: inline']) !!}
                                                <input type="hidden" value="1" name="status">
                                                <input type="hidden" value="{{$det->id}}" name="id">
                                                {!! Form::submit('Send to Seller',array('class'=>'btn btn-info btn-info btn-sm','onclick'=>'return confirm("Are You sure!!")')) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
         </section>
        </div>
    </div>
                 <div class="row">
                    <section class="panel">
                        <header class="panel-heading">
                        <div class="panel-actions">
                                       
                            </div>
                               <h2 class="panel-title"> More Details</h2>
                            </header>
                            <div class="panel-body">

                            @if($order->delivered == 1)
                            <div class="orange">Delivered Order On {{ date('d M, Y', strtotime($order->deliver_date)) }}</div>
                            @endif
                
                        <h4>Orderd At :</h4>
                        <p>{{ date('d M, Y H:i', strtotime($order->created_at)) }} </p><br />
                        <h4> Customer Name</h4>
                        <label >{{$order->first_name}}</label><br />
                        <h4> Customer Email</h4>
    
                        @if(isset($order->email))
                        <p >{{$order->email}}</p><br />
                        @endif
                        <h4>Phone Number </h4>
                        @if(isset($order->phone))
                        <label >{{$order->phone}}</label><br/>
                        @endif
                        <h4> Order Address </h4>
                        <label >{{$order->address}}</label><br/>
                        <label >
                            Country :  {{ $order->country }}<br/>
                            City :  {{ $order->city }}<br/>
                            Address : {{ $order->address  }}<br/>
                        </label>
                       <br/> <br/>

                    <h4>Shipment Method </h4>
                    <h4 > Total Price  </h4>
                    <label >
                         Order Price : {{$order->total_price}}<br/>
                    </label>
                    <br/>
                   {!! Form::open(['action'=>['Support\OrderController@update', $order->id], 'method'=>'PUT']) !!}
              
                <div class="col-sm-6">
                <select id="status" name="status" class="form-control">
                    <option <?php if ($order->status == 0 ) echo 'selected' ; ?> value="0">{{trans('lang.unconfirmed')}}</option>
                    <option <?php if ($order->status == 1 ) echo 'selected' ; ?> value="1">Confirm This Order</option>
                    <option <?php if ($order->status == 2 ) echo 'selected' ; ?> value="2">Ship This Order</option>
                    <option <?php if ($order->status == 3 ) echo 'selected' ; ?> value="3">Deliver</option>
                    <option <?php if ($order->status == 4) echo 'selected' ; ?>  value="4">Return</option>
                    <option <?php if ($order->status == 5 ) echo 'selected' ; ?> value="5">{{trans('lang.cancelled')}}</option>
                </select>
                </div>
             
                <div class="col-sm-6"  id="comments" style="display:none" >
                <div  class="form-group" >
                    <input type="text" name="comments"  class="form-control"  placeholder="Why you want to cancel">
                </div>
                 </div>

                        {!! Form::submit('submit',array('class'=>'btn btn-success','onclick'=>'return confirm("Are You sure!!")')) !!}
                         {!! Form::close() !!}
                   @if(isset($order->comments) && $order->status == 4 || $order->status == 5 )
                    <p>
                      Comments  :  {{$order->comments}}</p>
                   @endif 
            </div>
         </section>   
      </div>
        @endsection
        
        @section('script')
    <script>
    
        $(document).ready(function(){
        $('#status').on('change', function() {
        
       if (this.value == '4' || this.value == '5' ){
        $("#comments").show(); 
        $("[name='comments']").prop('required',true);
        
       }
      
      else{
        
         $("#coments").hide();

      }
      
    });
});
    </script>
@endsection
