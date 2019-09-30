<div class="menu-slider-entry">
    <div class="product-slide-entry">
        <div class="product-image">
            <img src="{{asset('admin-assets/images/products/'.$pro->photo)}}" alt="{{ $pro->photo_alt }}" style="height: 200px;"/>
            <div class="bottom-line left-attached">
                <a class="bottom-line-a square" onclick="AddToCart({{ $pro->id }})"><i class="fa fa-shopping-cart"></i></a>
                @if(Auth::check())
                @if(!Auth::user()->iswashed($pro->id))
                <a class="bottom-line-a square"  id="nor{{$pro->id}}"  onclick="Like({{$pro->id}}, 'nor')"> <i class="fa fa-heart-o"></i> </a>
                @else
                <a class="bottom-line-a square"  id="nor{{$pro->id}}"  onclick="Like({{$pro->id}}, 'nor')"><i class="fa fa-heart"></i></a>
                @endif
                @endif

                <a class="bottom-line-a square" @if (Session::get('local') == 'ar') href="{{ url('product').'/'.$pro->ar_custom_url }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif><i class="fa fa-retweet"></i></a>
            </div>
        </div>
        <a  class="title" @if (Session::get('local') == 'ar') href="{{ url('product').'/'.$pro->ar_custom_url }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif >@if (Session::get('local') == 'ar') {{ $pro->ar_name }} @else {{ $pro->name }} @endif</a>
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
