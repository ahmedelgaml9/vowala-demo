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
                <div class="wishlist-box">
                    @foreach($order->products as $det)
                    <?php $pro = $det->product; ?>
                    <div class="wishlist-header hidden-xs">
                        <div class=""><strong>Product Name : </strong>{{$pro->title}}</div>
                        @if($order->status == null && $order->status == 0)
                           <a href="{{ 'edit/'.$order->id }}"><button class="btn  btn-warning">Edit</button></a> 
                        @endif
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
                        </div>
                        <div class="wishlist-entry" id="wl{{$pro->id}}">
                        <div class="column-1">
                            <div class="traditional-cart-entry" >
                                <a class="image"  @if(Session::get('local') == 'ar') href="{{ url($pro->ar_custom_url) }}" @else href="{{ url($pro->custom_url) }}" @endif>
                                   <img src="{{asset('admin-assets/images/products/'.$pro->catalog->photo)}}" alt="{{ $pro->photo_alt }}" style="height: 126px;"/></a>
                                <div class="content">
                                    <div class="cell-view">
                                        <a class="tag" 
                                            @if(Session::get('local') == 'ar') 
                                                href="{{ url('shop/'.$pro->catar_custom_url) }}" 
                                            @else 
                                                href="{{ url('shop/'.$pro->custom_url) }}" 
                                            @endif
                                        >
                                            @if (Session::get('local') == 'ar') 
                                                {{ $pro->ar_name }} 
                                            @else 
                                                {{ $pro->name }}
                                            @endif
                                        </a>
                                        <a class="title" 
                                            @if(Session::get('local') == 'ar') 
                                                href="{{ url($pro->ar_custom_url) }}" 
                                            @else 
                                                href="{{ url($pro->custom_url) }}"
                                            @endif
                                        >
                                            @if (Session::get('local') == 'ar') 
                                                {{ $pro->ar_name }} 
                                            @else 
                                                {{ $pro->name }} 
                                            @endif
                                        </a>
                                        <div class="inline-description">
                                            @if (Session::get('local') == 'ar') 
                                                {{ $pro->ar_name }} 
                                            @else 
                                                {{ $pro->name }} 
                                            @endif 
                                            @if (Session::get('local') == 'ar') 
                                                {{ $pro->ar_name }} 
                                            @else 
                                                {{ $pro->name }} 
                                            @endif
                                        </div>

                                        @if(count($pro->Sizes)>1)
                                            <div class="inline-description"><b>Size :</b> 
                                                {{ $det->Size }}
                                            </div>
                                        @endif
                                        <div class="inline-description">
                                            <b>Quantity :</b> {{ $det->quntity }}
                                        </div>
                                    </div>

                                    <div class="price">
                                       <!--  @if($pro->offer != 0 )
                                        <div class="prev">{{ App\Currency::getprice($pro->price,Session::get('curr')) }}</div>
                                        <div class="current">{{ App\Currency::getprice($pro->price -($pro->price*($pro->offer/100)),Session::get('curr'))}}</div>
                                        @else 
                                        <div class="current">{{ App\Currency::getprice($pro->price,Session::get('curr')) }}</div>
                                        @endif -->
                                        @if(isset($order->total_price))

                                                <div class="current">The product  price +shipping {{$order->total_price}}</div>
                                        @else
                                               There  is  a  problem  Try  to  contact  us         
                                        @endif        
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="column-2">

                            <a class="button style-14" onclick="AddToCart({{ $pro->id }}, 'nosize')">add to cart</a>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="col-sm-3 col-sm-pull-9 blog-sidebar">
                <div class="information-blocks">
                    <div class="categories-list account-links">
                        <div class="block-title size-3">Client account</div>
                        <ul>
                            @include('site.template.profileheader')

                        </ul>
                    </div>
                    <div class="article-container">
                        <br/>Custom CMS block displayed below the one page account panel block. Put your own content here.
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--     @include('site.template.featured')
 -->    
</div>
@endsection