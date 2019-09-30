
<?php

$data= App\Main::find(1);
$lang =$data->setlang;
$main=App\Main::find(1);
$currency= App\Currencies::where('id',$main->default_currency)->first();

?>
@if(count($card)>0)
<div class="dropdown-cart-products">
    @foreach($card as $p)
    <?php $pro = App\Product::find($p['productid']); ?>
    <div class="product">
        <div class="product-details">
              <h4 class="product-title">
                  <a @if ($lang == 0) href="{{ url('product').'/'.$pro->custom_url_ar}}" @else href="{{ url('product').'/'.$pro->custom_url }}"
                    @endif>@if ($lang == 0)  {{ $pro->name_ar }} @else {{ $pro->name }} @endif</a>
               </h4>
            <span class="cart-product-info">
                <span class="cart-product-qty">{{ $p['quantity'] }} × </span>
                    @if($pro->offer != 0 )
                   @if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }} @else {{ $currency->name }}    {{ $currency->value }}@endif  {{ $pro->price -($pro->price*($pro->offer/100))}}
                    @else
                   @if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }}  @else {{ $currency->name }}  {{ $currency->value }} @endif  {{ $pro->price }}
                    @endif
                   <br>
                 @if(isset( $p['sizename']))  Size <span class="cart-product-qty">{{ $p['sizename'] }}  </span> @endif <br>
                 @if(isset( $p['colorname'])) Color <span class="cart-product-qty">{{ $p['colorname'] }}  </span> @endif

             </span>
          </div>
        <figure class="product-image-container">
            <a   @if ($lang == 0) href="{{ url('product').'/'.$pro->custom_url_ar }}" @else href="{{ url('product').'/'.$pro->custom_url }}"
                @endif class="product-image">
                <img src="{{ asset('admin-assets/images/products').'/'.$pro->catalog->photo }}" alt="product">
            </a>
            <a href="#" onclick="Remove_cart({{ $pro->id }});" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
        </figure>
    </div><!-- End .product -->
    @endforeach
</div><!-- End .cart-product -->
@if($pro->offer != 0 )
<?php

  $total=0;
 $total+=($pro->price - ($pro->price * ($pro->offer / 100))) * $p['quantity']   ; ?>
@else

<?php 
$total=0;
$total+=$pro->price * $p['quantity']; ?>
@endif

<div class="dropdown-cart-total">
    <span>{{ trans('lang.total')}}</span>&nbsp; &nbsp;
    <span class="cart-total-price">
    </span>
</div>

<div class="dropdown-cart-action">
    <a href="{{url('Cart')}}" class="btn btn-primary">{{ trans('lang.viewcart')}}</a>

    @if(Auth::check())
    <a href="{{url('checkout')}}" class="btn">{{ trans('lang.checkout')}}</a>
    @else
    <a href="#"  data-toggle="modal" data-target="#loginModel"class="btn">{{ trans('lang.login')}}</a>
    @endif
</div>

@else
{{ trans('lang.noitem') }}
@endif

<script>
    $(".cart-count").load("{{ url('quantity') }}");
    $(".cart-total-price").load("{{ url('total') }}");

    function Remove_cart(id) {
        $.ajax({
            type: 'Get',
            url: "{{URL::to('removfromcart')}}" + '/' + id,
            data: "itemid=" + id,
            success: function(data) {
                $("#smallcard").load("{{ url('smallcartcontent') }}");
                $("#total").load("{{ url('total') }}");
                $("#cont").load("{{ url('cartcontent') }}");
            }
        });
    }
</script>