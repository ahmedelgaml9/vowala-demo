@extends('site.template.index')
@section('content')

<?php
$data= App\Main::find(1);
$lang =$data->setlang;
$card= $_SESSION['cart'];
$main=App\Main::find(1);
$currency= App\Currencies::where('id',$main->default_currency)->first();
?>
       <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li> 
                    </ol>
                </div>
            </nav>

            <div class="container">
                 <ul class="checkout-progress-bar">
                     <li class="active">
                         <span>{{ trans('lang.payments')}}</span>
                     </li>
                 </ul>
                <div class="row">
                       <div class="col-lg-4">
                        <div class="order-summary">
                            <h3>{{ trans('lang.summary') }}</h3>
                            <h4>
                                <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="false" aria-controls="order-cart-section"><span class="cart-count" ></span> {{ trans('lang.productincart') }}</a>
                            </h4>
                             <div class="collapse" id="order-cart-section">
                                 <table class="table table-mini-cart">
                                     <tbody>
                                            @if(count($card)> 0)
                                            @foreach($card as $p)
                                            <?php
                                            
                                              $pro = App\Product::find($p['productid']);
                                              $data= App\Main::find(1);
                                              $lang =$data->setlang;
                                              $country =  Session::get('country');
                                              $city =  Session::get('city');
                                              $street = Session::get('street_name');
                                              $floor=  Session::get('floornumber');
                                              $flat =  Session::get('flat_number');
                                              $shipment = Session::get('shipment_company');

                                              ?>      
                                           <tr>
                                            <td class="product-col">
                                                <figure class="product-image-container">
                                                    <a  @if (Session::get('local')=='ar' ) href="{{ url('product').'/'.$pro->custom_url_ar }}" @else href="{{ url('product').'/'.$pro->custom_url }}"
                                                        @endif   class="product-image">
                                                        <img src="{{ asset('admin-assets/images/products').'/'.$pro->catalog->photo }}"  alt="product">
                                                    </a>
                                                </figure>
                                                <div>
                                                    <h2 class="product-title">
                                                        <a href="">@if (Session::get('local') == 'ar') {{ $pro->name_ar }} @else {{ $pro->name }} @endif</a>
                                                    </h2>
                                                 </div>
                                              </td>
                                                  @if($pro->offer != 0 )
                                             <td class="price-col">
                                                    @if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }}  @endif  
                                                    {{ $pro->price -($pro->price*($pro->offer/100))}}
                                               </td>
                                                   @else
                                                 <td class="price-col">
                                                   @if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }}  @endif    {{ $pro->price }}
                                                   <td> 
                                                     @endif
                                                     </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>    
                                                </table>
                                              <table class="table table-totals">
                                                   <tbody>
                                                     <tr>
                                                      <td>{{ trans('lang.subtotal')}}</td>
                                                       <td class="total"></td>
                                                      <td>@if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }}  @endif 
                                                       </td>  
                                                      </tr>
                                                     </tbody>
                                                     <tfoot>
                                                   </tfoot>
                                               </table>
                                           </div>
                                       </div>
                                     <div class="checkout-info-box">
                                            <h3 class="step-title">{{ trans('lang.ship')}}
                                            </h3>
                                            <address>
                                             {{$flat}} <br>
                                             {{$floor}} {{$street}}  <br>
                                             {{$city}} <br>
                                             {{$country}} <br>
                                      </address>
                                   </div>
                                </div>
                           <div class="col-lg-8 order-lg-first">
                             <div class="checkout-payment">
                                <div class="order-summary">
                                    <h3>{{ trans('lang.summary') }}</h3>
                                     <div>
                                        <table class="table table-totals">
                                                   <tbody>
                                                      <tr>
                                                      <td>{{ trans('lang.shippingprice')}}</td>
                                                       <td>{{$order->shipping_price}}</td>
                                                       </tr>
                                                     <tr>
                                                      <td>{{ trans('lang.shippingtax')}}</td>
                                                      <td>{{$order->shipping_tax}}</td>
                                                      </tr>
                                                     <tr>
                                                      <td>{{ trans('lang.paymentprice')}}</td>
                                                      <td>
                                                        {{$order->payment_price}}
                                                       </td>
                                                      </tr>
                                                     <tr>
                                                      <td>{{ trans('lang.salestax')}}</td>
                                                      <td>
                                                        {{$order->sales_tax}}
                                                       </td>
                                                     </tr>
                                                     <tr>
                                                      <td>{{ trans('lang.total')}}</td>
                                                       <td>{{$order->total_price}}</td>
                                                      </tr>
                                                      
                                                     </tbody>
                                                     <tfoot>
                                                   </tfoot>
                                               </table>
                                             </div>
                                         </div>
                                       @if($order->payment_method == 1)
                                    <form action="{{route('editorder',[$order->id])}}"  method="get" >
                                      <div class="col-sm-6"> 
                                        <div class="checkout-steps-action"> 
                                         <button class="btn btn-primary float-right">{{ trans('lang.confirm')}}</button>
                                        </div>
                                      </div>
                                      </form>
                                      @else
                                  <div class="col-sm-6">
                                    <div class="checkout-steps-action"> 
                                      <button   class="btn btn-primary float-right"   onclick="createWindow();" >{{ trans('lang.paymentbankmasr')}}</button>
                                 </div>
                              </div>
                              @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-6"></div>
        </main>
         @endsection
<script>

function createWindow() {
  var win = window.open('https://vowalaa.com/demo/bankmasrpage/{{$order->id}}','blank');
  win.document.write(content);
}

function calh()
{
    
document.form2.action = "{{route('editorder',[$order->id])}}"

}
</script> 
