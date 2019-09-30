<div class="col-md-3 col-sm-4 shop-grid-item">
    <div class="product-slide-entry shift-image">
        <div class="product-image">
            <img src="{{asset('admin-assets/images/products/'.$pro->photo)}}" alt="{{ $pro->photo_alt }}"  style="height: 269px;"/>
            <img src="{{asset('admin-assets/images/products/'.$pro->photo)}}" alt="{{ $pro->photo_alt }}"  style="height: 269px;"/>
            <div class="bottom-line left-attached">
                <a class="bottom-line-a square" onclick="AddToCart({{ $pro->id }})"><i class="fa fa-shopping-cart"></i></a>
                @if(Auth::check())
                @if(!Auth::user()->iswashed($pro->id))
                <a class="bottom-line-a square"  id="like{{$pro->id}}"  onclick="Like({{$pro->id}}, 'like')"> <i class="fa fa-heart-o"></i> </a>
                @else
                <a  class="bottom-line-a square"  id="like{{$pro->id}}" onclick="like({{$pro->id}}, 'pro')"><i class="fa fa-heart"></i></a>
                @endif
                @endif
                <a class="bottom-line-a square" @if (Session::get('local') == 'ar') href="{{ url('product').'/'.$pro->ar_custom_url }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif ><i class="fa fa-retweet"></i></a>
                <a class="bottom-line-a square"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <a class="tag" >@if (Session::get('local') == 'ar') {{ $pro->cat->ar_name }} @else {{ $pro->cat->name }} @endif</a>
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
        <div class="article-container style-1">
            <p>
                @if (Session::get('local') == 'ar')
                {!! substr($pro->ar_desc,0,200) !!}..
                @else
                {!! substr($pro->desc,0,200) !!}..
                @endif
            </p>
        </div>
         <div class="price">
                @if($pro->offer>0)
                <div class="prev">${{ $pro->price }}</div>
                <div class="current">${{ $pro->price-(($pro->offer*$pro->price)/100)}}</div>
                 @else
                <div class="current">${{ $pro->price }}</div>
                @endif
            </div>

        <div class="list-buttons">
            <a class="button style-10" onclick="AddToCart({{ $pro->id }})">{{ trans('lang.tocart')}}</a>
         </div>
    </div>
    <div class="clear"></div>
</div>