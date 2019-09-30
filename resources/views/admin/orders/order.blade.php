
  <?php
          
              $data= App\Main::find(1);
              $lang =$data->setlang;
              $main=App\Main::find(1);
              $currency= App\Currencies::where('id',$main->default_currency)->first();
            ?>
          
@extends('admin.dashboard')
@section('content')
   <h2>{{trans('lang.number')}}: {{$order->id}}</h2>


   {!! Form::open(['action'=>['OrderController@update', $order->id], 'method'=>'PUT']) !!}
              <div class="row">
                <div class="col-sm-6">
                <select id="status" name="status" class="form-control">
                    <option <?php if ($order->status == 0 ) echo 'selected' ; ?> value="0">Ordered</option>
                    <option <?php if ($order->status == 1 ) echo 'selected' ; ?> value="1">Confirm This Order</option>
                    <option <?php if ($order->status == 2 ) echo 'selected' ; ?> value="2">Ship This Order</option>
                    <option <?php if ($order->status == 3 ) echo 'selected' ; ?> value="3">Deliver</option>
                    <option <?php if ($order->status == 4) echo 'selected' ; ?>  value="4">Return</option>
                    <option <?php if ($order->status == 5 ) echo 'selected' ; ?> value="5">{{trans('lang.cancelled')}}</option>
                </select>
                </div>
              
                <div class="col-sm-6"  id="comments" style="display:none" >
                <div  class="form-group" >
                    <input type="text" name="comments"  class="form-control"  placeholder="write reason ">
                </div>
                </div>
                    <div class="col-sm-6">
                     {!! Form::submit('submit',array('class'=>'btn btn-success','onclick'=>'return confirm("Are You sure!!")')) !!}
                         {!! Form::close() !!}
                      @if(isset($order->comments) && $order->status == 4 || $order->status == 5 )
                    <p>
                        Comments  : {{$order->comments}}</p>
                     @endif 
                     </div>
                 </div>
                     
                    @if (Session::has('error'))
                    <div  class=" alert alert-warning" style="font-size: 18px;">
                         <strong>Warning!</strong>Order Not Confirmed Please Check Your Order Details and Product Quantity
                    </div>
                    @endif
                 <div class="row">
                    <div class="col-md-6">
                            <section class="panel">
                               <header class="panel-heading">
                                <div class="panel-actions">
                                        <div class="fixed-action-btn">
                                        </div>
                                   </div>
                                  <h2 class="panel-title">{{trans('lang.product')}}</h2>
                                  </header>
                                 <div class="panel-body">
                                 <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                     @if($order->status != 3 && $order->status != 4)
                                        <!--<a href="{{route('orders.edit', $order->id)}}" class="btn pull-right">Edit  order</a>-->
                                       @endif
                                  <thead>
                                   <tr>
                                    <th> {{trans('lang.name')}}</th>
                                    <th>Sn /code</th>
                                    <th>{{trans('lang.sold')}}</th>
                                    <th> {{trans('lang.price')}}</th>
                                    <th> {{trans('lang.sale')}}</th>
                                    <th> {{trans('lang.quantity')}}</th>
                                    <th> {{trans('lang.total')}}</th>
                                    
                                </tr>
                              </thead>
                             <tbody class="data">
                                 @foreach ($order->products as $det)
                                <tr>
                                    <td>{{ $det->product->name }} </td>
                                    <td>{{ $det->id }}</td>
                                    <td>{{ $det->product->seller->name }}</td>

                                 <td>{{ $det->price }}</td>
                                 <td>{{ $det->product->offer }}</td>
                                 <td>{{ $det->quantity }}</td>
                                 <td>{{$order->total_price }}</td>
                                 <td><a   class="btn btn-success" href="{{url('product/'.$det->product->custom_url)}}" target="_blank">View</a>
                                   <a   class="btn btn-success" href="{{ url('admin/cartproducts/'.$det->product->id.'/edit') }}" target="_blank">Edit</a>
                                </td>

                               <!-- <td>
                                          @if($det->status == 0)
                                          @if($det->product->Seller->permission == 2)
                                             {!! Form::open(['url'=> ['admin/sendToSeller'] ,'method'=>'get','style'=>'display: inline']) !!}
                                                <input type="hidden" value="1" name="status">
                                                <input type="hidden" value="{{$det->id}}" name="id">
                                              {!! Form::submit('Send to Seller',array('class'=>'btn btn-info btn-info btn-sm','onclick'=>'return confirm("Are You sure!!")')) !!}
                                              {!! Form::close() !!}
                                       @endif
                                   @endif
                                </td>-->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
         </section>
        </div>
                <div class="col-md-6">
                    <section class="panel">
                        <header class="panel-heading">
                        <div class="panel-actions">
                                       
                            </div>
                               <h2 class="panel-title">{{trans('lang.customerinfo')}}</h2>
                            </header>
                            <div class="panel-body">
                               <table class="table table-bordered table-striped mb-none" id="datatable-default">
                            <thead>
                           <tr>
                            <th>{{trans('lang.name')}}</th>
                            <th>{{trans('lang.email')}}</th>
                            <th>{{trans('lang.phone')}}</th>
                            <th>{{trans('lang.account')}}</th>

                           </tr>
                          </thead>
                    
                             <tbody class="data">
                                  <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{$order->email}}</td>
                                     <td>{{$order->phone}}</td>
                                    <td>  <a   class="on-default edit-row" href="{{ url('admin/users/'.Auth::user()->id.'/edit') }}" ><span class="fa fa-pencil"> Edit</span></a></td>

                                </tr>
                             </tbody>
                           </table>
                          </div>
                         </section>
                      </div>
                    </div>
                 <div class="row">
                     <div class="col-md-6">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                       
                                </div>
                                 <h2 class="panel-title">{{trans('lang.shippingaddress')}}</h2>
                               </header>
                            <div class="panel-body">
                               <table class="table table-bordered table-striped mb-none" id="datatable-default">
                             <h2 class="panel-title">{{trans('lang.from')}}</h2>

                            <thead>
                           <tr>
                            <th>{{trans('lang.country')}}</th>
                            <th>{{trans('lang.area')}}</th>
                            <th>{{trans('lang.streetnumber')}}</th>
                            <th>{{trans('lang.buildingnumber')}}</th>
                           </tr>
                          </thead>
                            @foreach ($order->products as $det)
                         <tbody class="data">
                            <tr>
                              <td>{{ $det->product->seller->country }}</td>
                              <td>{{$det->product->seller->area}}</td>
                                 <td>{{ $det->product->seller->street_name}}</td>
                              <td>{{$det->product->seller->building_number}}</td>
                            </tr>
                            @endforeach
                     </tbody>
                   </table>
                    <h2 class="panel-title">{{trans('lang.to')}}</h2>
                    </br>
                          
                        <table class="table table-bordered table-striped mb-none" id="datatable-default">
                              
                            <thead>
                           <tr>
                             <th>{{trans('lang.country')}}</th>
                            <th>{{trans('lang.area')}}</th>
                            <th>{{trans('lang.streetnumber')}}</th>
                            <th>{{trans('lang.buildingnumber')}}</th>
                          
                           </tr>
                          </thead>

                         <tbody class="data">
                             <tr>
                              <td>{{ $order->country }}</td>
                              <td>{{$order->area}}</td>
                                 <td>{{ $order->street_name}}</td>
                              <td>{{$order->building_number}}</td>
                            </tr>
                             
                     </tbody>
                   </table>
                   
                    <h2 class="panel-title">{{trans('lang.courier')}}</h2>
                    </br>
                        <table class="table table-bordered table-striped mb-none" id="datatable-default">
                              
                            <thead>
                           <tr>
                           <th>{{trans('lang.courier')}}</th>
                          <th>{{trans('lang.weight')}}</th>
                            <th>{{trans('lang.shippingprice')}}</th>
                           </tr>
                          </thead>

                            @foreach ($order->products as $det)
                         <tbody class="data">
                            <tr>
                               <td>{{ $order->shipmentmethod->name }}</td>
                               <td>{{$det->product->weight}}</td>
                                <td>{{$order->shipping_price}} {{$currency->name}}</td>
                            </tr>
                            @endforeach
                     </tbody>
                   </table>
                  </div>
                 </section>
              </div>
                  <div class="col-md-6">
                    <section class="panel">
                            <header class="panel-heading">
                               <h2 class="panel-title">{{trans('lang.payments')}}</h2>
                            </header>
                            <div class="panel-body">
                           <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                
                            <thead>
                           <tr>
                               <th> {{trans('lang.tax')}}   %</th>
                               <th>{{trans('lang.totaltax')}}</th>
                              <th>{{trans('lang.shippingmethods')}}</th>
                               <th>Cdo</th>
                             <th>{{trans('lang.price')}}</th>
                            <th>{{trans('lang.name')}}</th>
                          </tr>
                       </thead>
                       <tbody class="data">
                            <tr>
                                 <td>14 %</td>
                                <td>{{ $order->sales_tax}} {{$currency->name}} </td>
                                <td>{{ $order->shipping_price}}{{$currency->name}}  </td>
                                @if($order->payment_method ==1) <td>  yes {{  $order->payment_price}} </td>@else   no @endif
                                 <td>{{ $order->total_price}}{{$currency->name}} </td>
                                <td>{{ $order->paymentmethod->name}}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
         </section>
        </div>
    </div>
    
                <div class="row">
                  <div class="col-md-8">
                      <h2>{{trans('lang.actions')}}</h2>
                    @foreach($useractions as $p)   
                   @if($p->status ==0)
                   <h2>   {{trans('lang.Ordered')}}:
                    </h2>
                    </br>
                    @endif
                      @if($p->status ==1) <h2>Confirmed  By  {{$p->date}}   </h2>
                        </br>
                          By  : {{Auth::user()->name}}
                          </br>
                        @endif
                       @if($p->status ==2) <h2> Picked By:{{$p->date}} 
                     </h2>
                     </br>
                      By:  {{Auth::user()->name}}
                      @endif
                    
                     @if($p->status ==3)   <h2>
                   {{trans('lang.delivered')}}:{{$p->date}}
                   
                        </h2>
                          </br>
                         By :  {{Auth::user()->name}}
                        </br>
                        @endif
                      
                      @if($p->status==4)   <h2>
                    {{trans('lang.Return')}} :{{$p->date}}
                     </h2>
                    </br>
                        By :  {{Auth::user()->name}}
                       </br>
                         @endif
                         @if($p->status  ==5) 
                       {{trans('lang.cancelled')}} : {{$p->date}}  
                         </br>
                         By : {{Auth::user()->name}}  
                       @endif
                       @endforeach
                </div>
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
