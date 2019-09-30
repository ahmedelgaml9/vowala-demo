<div class="swiper-slide"> 
    <div class="paddings-container">
        <div class="product-slide-entry">
            <div class="product-image">
                <img src="{{asset('admin-assets/images/products/'.$pro->photo)}}"  alt="@if (Session::get('local') == 'ar') {{ $pro->ar_photo_alt }} @else {{ $pro->photo_alt }} @endif"style="height: 260px;"/>
                <a class="top-line-a right open-product" href="#pro{{ $pro->id }}"><i class="fa fa-expand"></i> <span>Quick View</span></a>
                <div class="bottom-line">
                    <div class="right-align">
                        <a class="bottom-line-a square" @if (Session::get('local') == 'ar') href="{{ url('product').'/'.$pro->ar_custom_url }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif><i class="fa fa-retweet"></i></a>
                        @if(Auth::check())
                        @if(!Auth::user()->iswashed($pro->id))
                        <a class="bottom-line-a square"  id="q{{$pro->id}}"  onclick="Like({{$pro->id}}, 'q')"> <i class="fa fa-heart-o"></i> </a>
                        @else
                        <a  class="bottom-line-a square"  id="q{{$pro->id}}" onclick="Like({{$pro->id}}, 'q')"><i class="fa fa-heart"></i></a>
                        @endif
                        @endif
                    </div>
                    <div class="left-align">
                        <a class="bottom-line-a" onclick="AddToCart({{ $pro->id }})"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div>
            </div>
            <a class="tag" href="{{ url('category/'.$pro->cat->custom_url) }}">@if (Session::get('local') == 'ar') {{ $pro->cat->ar_name }} @else {{ $pro->cat->name }} @endif</a>
            <a class="title" @if (Session::get('local') == 'ar') href="{{ url('product').'/'.$pro->ar_custom_url }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif>@if (Session::get('local') == 'ar') {{ $pro->ar_name }} @else {{ $pro->name }} @endif</a>
            @if(Auth::check())
            <div class="rating-box"  id="star-rating">
                @for($i=0;$i <intval($pro->rate($pro->id));$i++)
                    <div class="star selected"><i class="fa fa-star" onclick="Rate({{ $pro->id }},{{ $i+1 }})"></i></div>
                    @if($i==5)
                    @break
                    @endif
                    @endfor 
                    @for($j=$i ;$j<5 ;$j++)
                    <div class="star"><i class="fa fa-star" onclick="Rate({{ $pro->id }},{{ $j+1 }})"></i></div>
                    @endfor
            </div>
            @else 
            <div class="rating-box">
                @for($i=0;$i <intval($pro->rate($pro->id));$i++)
                    <div class="star selected"><i class="fa fa-star"></i></div>
                    @if($i==5)
                    @break
                    @endif
                    @endfor 
                    @for($j=$i ;$j<5 ;$j++)
                    <div class="star"><i class="fa fa-star"></i></div>
                    @endfor
            </div>
            @endif
            <div class="price">
                @if($pro->offer>0)
                <div class="prev">${{ $pro->price }}</div>
                <div class="current">${{ $pro->price-(($pro->offer*$pro->price)/100)}}</div>
                 @else
                <div class="current">${{ $pro->price }}</div>
                @endif
            </div>

        </div>
    </div>
</div>




