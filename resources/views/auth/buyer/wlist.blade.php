@extends('site.template.index')
@section('content')
<div class="content-push">
    <div class="breadcrumb-box">
        <a href="{{ url('/') }}">{{ trans('lang.home') }}</a>
        <a href="{{ url('mywishlist') }}">{{ trans('lang.account') }}</a>
        <a >{{ trans('lang.wlist') }}</a>
    </div>
    <div class="information-blocks">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3">
                <div class="wishlist-header hidden-xs">
                    <div class="title-1">{{ trans('lang.product') }}</div>
                    <div class="title-2"></div>
                </div>
                <div class="wishlist-box">
                    @foreach(Auth::user()->wishlist() as $w)
                    <?php $pro = $w->product($w->product_id); ?>
                    <div class="wishlist-entry" id="wl{{$pro->id}}">
                        <div class="column-1">
                            <div class="traditional-cart-entry" >
                                <a class="image"  @if(Session::get('local') == 'ar') href="{{ url($pro->ar_custom_url) }}" @else href="{{ url($pro->custom_url) }}" @endif>
                                   <img src="{{asset('admin-assets/images/products/'.$pro->catalog->photo)}}" alt="{{ $pro->catalog->photo_alt }}" style="height: 126px;"/></a>
                                <div class="content">
                                    <div class="cell-view">
                                        @if(isset($pro->cat->cat))
                                        <a class="tag" @if(Session::get('local') == 'ar') href="{{ url('shop/'.$pro->catalog->cat->cat->ar_custom_url) }}" @else href="{{ url('shop/'.$pro->catalog->cat->cat->custom_url) }}" @endif>@if (Session::get('local') == 'ar') {{ $pro->catalog->cat->cat->ar_name }} @else {{ $pro->catalog->cat->cat->name }} @endif</a>
                                        @endif
                                        <a class="title" @if(Session::get('local') == 'ar') href="{{ url($pro->ar_custom_url) }}" @else href="{{ url($pro->custom_url) }}"@endif>@if (Session::get('local') == 'ar') {{ $pro->catalog->ar_name }} @else {{ $pro->catalog->name }} @endif</a>
                                        <div class="inline-description">@if (Session::get('local') == 'ar') {{ $pro->catalog->cat->ar_name }} @else {{ $pro->catalog->cat->name }} @endif</div>
                                        <div class="inline-description">@if (Session::get('local') == 'ar') {{ $pro->catalog->brand->ar_name }} @else {{ $pro->catalog->brand->name }} @endif</div>
                                    </div>
                                    <div class="price">
                                        @if($pro->offer != 0 )
                                        <div class="prev">{{ App\Currency::getprice($pro->price,Session::get('curr')) }}</div>
                                        <div class="current">{{ App\Currency::getprice($pro->price -($pro->price*($pro->offer/100)),Session::get('curr'))}}</div>
                                        @else 
                                        <div class="current">{{ App\Currency::getprice($pro->price,Session::get('curr')) }}</div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="column-2">
                            @if($pro->Quantity()>0 && $pro->status != 0)
                            <a class="button style-14" onclick="AddToCart({{ $pro->id }}, 'nosize')">{{ trans('lang.tocart')}}</a>
                            @else
                            <a class="button style-14">{{ trans('lang.sold')}}</a>
                            @endif
                            <a class="remove-button" id="wl{{$pro->id}}"  onclick="Like({{$pro->id}}, 'wl')"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-3 col-sm-pull-9 blog-sidebar">
                <div class="information-blocks">
                    <div class="categories-list account-links">
                        <div class="block-title size-3">{{ trans('lang.account') }}</div>
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




    @endsection