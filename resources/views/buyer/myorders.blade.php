@extends('site.template.index')
@section('content')
<div class="content-push">
    <div class="breadcrumb-box">
         <a href="{{ url('/') }}">{{ trans('lang.home') }}</a>
        <a href="{{ url('myorders') }}">{{ trans('lang.account') }}</a>
        <a >{{ trans('lang.orders') }}</a>
    </div>
    @if(Session::has('message'))
        <p dir="rtl" class="alert {{ Session::get('alert-class', 'alert-success')}} text-center">{{ Session::get('message') }}
        </p>
    @endif
    <div class="information-blocks">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3">
                <div class="accordeon size-1">
                    <?php $n = 1; ?>
                    @foreach($orders as $order)
                    <div class="accordeon-title @if($n==1) active @endif"><span class="number">{{ $n }}</span>{{ date('d M, Y',strtotime($order->created_at)) }}</div>
                    <div @if($n==1)  style="display: block;" @endif class="accordeon-entry">
                          <div class="article-container style-1">
                            <div class="share-box"><div class="title"><b>Orderd At : </b>{{ date('d M, Y H:i', strtotime($order->created_at)) }} </div></div>
                            <div class="share-box"><div class="title"><b>Ordered By  Name :</b>{{$order->first_name}}</div></div>
                            <div class="share-box"><div class="title"><b>Ordered By  Email :</b>{{$order->email}}</div></div>
                            <div class="share-box"><div class="title"><b>Ordered By  Phone :</b>{{$order->phone}}</div></div>
                            <div class="share-box"><div class="title"><b> Ordered On Address</b><br/>
<!--                                     Country :  {{ $order->country }}<br/>
 -->                                    City :  {{ $order->city }}<br/>
                                    Address : {{ $order->address  }}<br/>
                                </div>
                            </div>

                            <div class="share-box">
                              <div class="title">

                                <b>status :</b>
                                @if($order->status==null)
                                    still not conformed
                                @elseif($order->status==1)
                                     conformed
                                @elseif($order->status==2)
                                     shipped  
                                @elseif($order->status==3)
                                     delivered   
                                @elseif($order->status == 4)
                                    {{trans('lang.cancelled')}}
                                    @if(isset($order->comments))
                                        <p style="color:red">{{$order->comments}}</p>
                                    @endif    
                                @else
                                    something wrong with your order try to contact us                                
                                @endif
                              </div>
                            </div>

                            <div class="share-box">
                              <div class="title">
                                <b>Shipment Method :</b>{{$order->shipmentmethod->name}}
                              </div>
                            </div>
                            <div class="share-box">
                                <div class="title">
                                    <b> Total Price  :</b><br/>
                                    Oder Price :{{ $order->total_price }}<br/>
                                    <!-- Shipment Price :  {{ $order->shipment }}<br/> -->
                                    @if($order->discount > 0)
                                    Discount  : {{ $order->discount  }} %  For pormotion Code ( $order->promocode )<br/>
                                    @endif 
                                    -------------------------------------------------
                                    <br/>
                                    Total :  {{ $order->total_price }}<br/>
                                </div>
                            </div>
                            @if(!empty($order->delivery_date))
                            <div class="share-box">
                              <div class="title">
                                <b>Delivery Date : With  in  7 days of  work: </b>{{date('d M, Y',strtotime($order->delivery_date))}}
                              </div>
                            </div>
                            @endif
                            <!-- <div class="share-box"><div class="title"><b>Order Status :</b>{{$order->getstatus()}}</div></div>
 -->
                            <a href="{{ 'order/'.$order->id }}">{{ trans('lang.more') }}</a>
                        </div>
                    </div>
                    <?php $n++; ?>
                    @endforeach
                </div>

            </div>
            <div class="col-sm-3 col-sm-pull-9 blog-sidebar">
                <div class="information-blocks">
                    <div class="categories-list account-links">
                        <div class="block-title size-3">{{ trans('lang.account') }} </div>
                        <ul>
                                                    @include('site.template.profileheader')

                        </ul>
                    </div>
                    <div class="article-container">
                     </div>
                </div>
            </div>
        </div>
    </div>

    @include('site.template.featured')
</div>

@endsection
