@if(count($card)> 0)
@foreach($card as $p)
<?php
$pro = App\Product ::find($p['productid']);
$data= App\Main::find(1);
$lang =$data->setlang;
$main=App\Main::find(1);
$currency= App\Currencies::where('id',$main->default_currency)->first();
?> 
</style>
<tr class="product-row">
    <td class="product-col">
        <figure class="product-image-container">
            <a @if (Session::get('local')=='ar' ) href="{{ url('product').'/'.$pro->custom_url_ar }}" @else href="{{ url('product').'/'.$pro->custom_url }}"
                @endif class="product-image">
                <img src="{{ asset('admin-assets/images/products').'/'.$pro->catalog->photo }}" alt="product">
            </a>
        </figure>
        <h2 class="product-title">
            <a href="">@if (Session::get('local') == 'ar') {{ $pro->name_ar }} @else {{ $pro->name }} @endif</a>
        </h2>
    </td>
    <td>   
             @if($pro->offer != 0 )
              <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }} @endif{{ $pro->price -($pro->price*($pro->offer/100))}}</span>
                  @else 
            <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }}    {{ $currency->value }}@else {{ $currency->name }}  {{ $currency->value }} @endif{{ $pro->price }}</span>
             @endif  
             </td>
          <td>
              
         <div onclick="plus({{ $pro->id }});"   id="plus">+</div>
         <div class="horizontal-quantity form-control" name="quantity" id="qu{{ $pro->id }}">{{$p['quantity']}}</div>
         <div onclick="minus({{ $pro->id }} );"  id="minus">-</div>
      <td>
   </tr>
   
<tr class="product-action-row">
    <td colspan="4" class="clearfix">
        <div class="float-left">
                  @if(Auth::check())
                  @if(!Auth::user()->iswashed($pro->id))
               <a href="#" id="like{{$pro->id}}" onclick="Like({{$pro->id}}, 'like')"  class="btn-move" title="Add to Wishlist">
                  <span>{{ trans('lang.towishlist')}}</span>
              </a>
                @endif
                @endif
        </div>
        <div class="float-right">
            <a href="#" onclick="UpdateCart('{{ $pro->id }}');" class="btn btn-outline-secondary btn-update-cart">{{ trans('lang.updatecart')}}</a>
            <a href="#" onclick="Remove_cart({{ $pro->id }});" class="btn btn-outline-secondary btn-clear-cart">{{ trans('lang.removecart')}}</a>
        </div>
    </td>
</tr>
            @endforeach
            @else
<center>
    <h1>{{ trans('lang.noitem')}}</h1>
</center>
<br>
<br />
<br />
<br>
@endif