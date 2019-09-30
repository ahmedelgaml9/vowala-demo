@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)
@include('site.template.header2')
@endif
<?php
$data= App\Main::find(1);
$lang =$data->setlang;
$countries= App\Country::all();
$shipments= App\Shipment::all();
$cities= App\Zone::all();
$sh_addresses= App\Shipmentaddress::where('user_id',auth()->user()->id)->get();
$payment_methods= App\Payment::where('active',1)->get();
$main=App\Main::find(1);
$currency= App\Currencies::where('id',$main->default_currency)->first();
?>
       <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
'                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.checkout')}}</li>
                    </ol>
                </div>
             </nav>
            <div class="container">
                <ul class="checkout-progress-bar">
                    <li>
                        <span>{{ trans('lang.shippingaddress')}}</span>
                    </li>
                     <li class="active">
                        <span>{{ trans('lang.payments')}}</span>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-lg-8">
                        <ul class="checkout-steps">
                                   <?php
                                      $country =  Session::get('country');
                                      $city =  Session::get('city');
                                      $street = Session::get('street_name');
                                      $floor=  Session::get('floornumber');
                                      $flat =  Session::get('flat_number');
                                      $shipment = Session::get('shipment_company');
                                      $area= Session::get('area');
                                      $builds=  Session::get('building_number'); 
                                      
                                     ?>
                                     
                                  <li>
                                  <h2 class="step-title">{{ trans('lang.shippingaddress')}}</h2>
                                   <form   action="{{route('submitForm')}}" method="post" >
                                        @csrf
                                    <div class="form-group required-field">
                                        <label>{{ trans('lang.name') }}</label>
                                        <input type="text"     name="name"  id="tt" value="{{auth()->user()->name}}"  class="form-control" required>
                                    </div>
                                   <div class="form-group">
                                        <label>{{ trans('lang.email') }}</label>
                                        <input type="email"  name="email"  value="{{auth()->user()->email}}"  class="form-control form-control-sm" required >
                                    </div>
                                    
                                   
                                    
                                   <div class="form-group required-field">
                                        <input type="hidden"  name="area"  value="{{$area}}"  class="form-control" required   readonly>
                                    </div>
                                     <div class="form-group required-field">
                                        <label>{{ trans('lang.streetnumber')}}</label>
                                        <input type="text"  name="street_name"  value="{{$street}}"  id="street_name"  class="form-control" required>
                                    </div>
                                    
                                     <div class="form-group required-field">
                                        <label>{{ trans('lang.floornumber')}}</label>
                                        
                                        <input type="text"  name="floor_number" value="{{$floor}}" id="floor_number"  class="form-control" required>
                                    </div>
                                        <div class="form-group required-field">
                                        <input type="hidden"  name="building_number" value="{{$builds}}" class="form-control" >
                                    </div>
                                   
                                    <div class="form-group required-field">
                                        <label>{{ trans('lang.flatnumber')}}</label>
                                        <input type="text"   name="flat_number"  value="{{$floor}}"  id="flat_number" class="form-control" required>
                                    </div>
                                     <div class="form-group required-field">
                                            @foreach($card as $p)
                                            <?php
                                            
                                             $pro = App\Product::find($p['productid']);
                                             $data= App\Main::find(1);
                                             $lang =$data->setlang;
                                             $o =$pro->price ;
                                             
                                             ?>  
                                              <input type="text"   name="price_t"  id="pp"  class="form-control" >
                                           </div>  
                                           @endforeach
                                 
                                       <div class="form-group required-field">
                                          <label>{{ trans('lang.city')}} </label>
                                          <input type="text"  name='city'   value="{{$city}}"  id="city" class="form-control" required   readonly>
                                       </div>
                                    
                                    
                                    <div class="form-group required-field">
                                        <label>{{ trans('lang.country')}}</label>
                                        <input type="text"  name="country"  value="{{$country}}"  class="form-control" required   readonly>
                                    </div>
                                    
                                      <div class="form-group required-field">
                                        <input type="hidden"  name="shipment_id"  value="{{$shipment}}"   class="form-control" >
                                    </div>
                                   
                                    <div class="form-group required-field">
                                        <label>{{ trans('lang.phone')}}  </label>
                                        <div class="form-control-tooltip">
                                            <input type="tel" class="form-control"   name="phone"   value="{{auth()->user()->phone}}"  required>
                                            <span class="input-tooltip" data-toggle="tooltip" title="For delivery questions." data-placement="right"><i class="icon-question-circle"></i></span>
                                        </div>
                                    </div>

                                          @if(count($payment_methods ) > 0)
                                        <div class="checkout-step-shipping">
                                            <h2 class="step-title">{{ trans('lang.payments')}}</h2>
                                              <table class="table table-step-shipping">
                                                <tbody>
                                                         @foreach($payment_methods as $payment)  
                                                     <tr>
                                                        <td><input type="radio"  name="payment_method" value="{{$payment->id}}"   required></td>
                                                        <td>@if($lang ==0)  {{$payment->name_ar}}   @else  {{$payment->name}}   @endif     </td>
                                                      </tr>
                                                         @endforeach
                                                 </tbody>
                                               </table>
                                            </div>
                                              @endif
                                              
                                               <div class="row">
                                                  <div class="col-lg-8">
                                                      <div class="checkout-steps-action"> 
                                                         <button class="btn btn-primary float-right" id="dd">{{ trans('lang.placeorder')}}</button>
                                                     </div>
                                                </div>
                                            </div>
                                      </form>
                                    </li>
                                </ul>
                            </div>

                      <div class="col-lg-4">
                        <div class="order-summary">
                            <h3>{{ trans('lang.summary') }}</h3>
                            <h4>
                                <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="false" aria-controls="order-cart-section"><span class="cart-count" ></span>{{ trans('lang.productincart') }}</a>
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
                                             
                                             ?>  
                                                        
                                           <tr>
                                              <td class="product-col">
                                                  <figure class="product-image-container">
                                                      <a    @if (Session::get('local')=='ar' ) href="{{ url('product').'/'.$pro->custom_url_ar }}" @else href="{{ url('product').'/'.$pro->custom_url }}"
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
                                               @if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }}  @endif  {{ $pro->price -($pro->price*($pro->offer/100))}}
                                               </td>
                                                @else
                                               <td class="price-col">
                                                  @if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }}  @endif   {{ $pro->price -($pro->price*($pro->offer/100))}}
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
                                                
                                                  <?php
                                                 
                                                    $b =   Session::get('country');
                                                    $c =   Session::get('city');
                                                    $e =   Session::get('street_name');
                                                    $d =   Session::get('floornumber');
                                                    $g =   Session::get('flat_number');
                                                    
                                                  ?>
                                            
                                                <table class="table table-totals">
                                                     <tbody>
                                                    
                                                     </tbody>
                                                     <tfoot>
                                                   </tfoot>
                                             </table>
                                         </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                       <div class="mb-6"></div>
                    </main>
                    
          @section('scripts')
          <script>
    
          $(document).ready(function(){
             $("#dd").click(function(){
             f=$("#tt").val();

              $("#pp").val(f)

            });
           });
           
          $(".cart-count").load("{{ url('quantity') }}");
          $("#cont").load("{{ url('cartcontent') }}");
          $(".total").load("{{ url('total') }}");
          $(".shipping").load("{{ url('shipments')}}");

            function Remove_cart(id)
               {
                $.ajax({
                    type: 'Get',
                    url: "{{URL::to('removfromcart')}}" + '/' + id,
                    data: "itemid=" + id,
                    success: function (data) {
                        $("#smallcard").load("{{ url('smallcartcontent') }}");
                        $("#total").load("{{ url('total') }}");
                        $("#cont").load("{{ url('cartcontent') }}");
                       }
                  });
               }
    
            </script>
        
  
@endsection

<!--  <script>
function calA()
{
 document.form1.action ="{{route('submitForm')}}";
}
function calB()
{
document.form1.action = "{{route('checkoutpayment')}}";
}
</script> -->
  @if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif
    
    
    
