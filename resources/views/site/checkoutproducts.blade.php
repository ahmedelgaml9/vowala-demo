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
$areas= App\Area::all();
$address_default = App\Shipmentaddress::where('user_id',auth()->user()->id)->first();
if($address_default ){
    
$sh_addresses= App\Shipmentaddress::where('user_id',auth()->user()->id)->where('id','<>',$address_default->id)->get();

}
else{

$sh_addresses= App\Shipmentaddress::where('user_id',auth()->user()->id)->get();

    
}

$main=App\Main::find(1);   
$currency= App\Currencies::where('id',$main->default_currency)->first();
?> 

<style>
    .shipping-address-box {
        padding-right:20px;
        width:50%;
        height:200px;
    }

</style>

<main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('')}}"><i class="icon-home"></i><</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.checkout')}}</li>
                    </ol>
                </div>
            </nav>

            <div class="container">
                <ul class="checkout-progress-bar">
                    <li class="active">
                        <span>{{ trans('lang.shippingaddress')}}</span>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-lg-8">
                        <ul class="checkout-steps">
                              <li>
                                   @if (Session::has('message'))
                                <div  class=" alert alert-success" style="font-size: 18px;">
                                      You Must Add Shipping Address
                                </div>
                                  @endif
                                  
                                <h2 class="step-title">{{ trans('lang.shippingaddress')}}</h2>
                                    <div class="shipping-step-addresses ">
                                     <form  action="{{route('submitshipment')}}" method="POST">
                                           @csrf
                                     <div class="shipping-address-box active ">
                                              @if(isset($address_default)) <input type="radio"  value="{{$address_default->id}}"  name="check_address"   checked  required> @endif
                                          <address>
                                            <br>
                                          @if(isset($address_default))  {{$address_default->title}} <br>@endif
                                              
                                              @if(isset($address_default))  {{$address_default->street_name}}  @endif
                                               @if(isset($address_default)) {{$address_default->building_number}}   @endif
                                               @if(isset($address_default)) {{$address_default->floor_number}} @endif
                                              @if(isset($address_default))  {{$address_default->flat_num}}  @endif
                                             <br>
                                               @if(isset($address_default))  {{$address_default->city}}    @endif
                                             <br>
                                               @if(isset($address_default))  {{$address_default->country}}   @endif
                                             <br>
                                           </address>
                                          <div class="address-box-action clearfix">
                                               @if(isset($address_default)) <a href="{{url('editaddress/'.$address_default->id)}}" class="btn btn-sm btn-link">
                                                Edit
                                             </a> @endif
                                           </div>
                                         </div>
                                           
                                        @foreach($sh_addresses  as $s)
                                     <div class="shipping-address-box  ">
                                        <input type="radio"  value="{{$s->id}}"  name="check_address"  required>
                                         <address>
                                           <br>
                                             {{$s->title}} <br>
                                             {{$s->street_name}} 
                                             {{$s->building_number}}  
                                             {{$s->floor_number}}
                                             {{$s->flat_num}} 
                                            <br>
                                               {{$s->city}}   
                                             <br>
                                               {{$s->country}}  
                                             <br>
                                           </address>
                                        
                                          <div class="address-box-action clearfix">
                                             <a href="{{url('editaddress/'.$s->id)}}" class="btn btn-sm btn-link">
                                                Edit
                                             </a>
                                           </div>
                                         </div>
                                         @endforeach
                                       </div>
                                            @if(auth()->user()->permission != 2)
                                             <a href="#" class="btn btn-sm btn-outline-secondary btn-new-address" data-toggle="modal" data-target="#addressModal">+ {{ trans('lang.newaddress')}}</a>
                                            @endif
                                            </li>
                                         <li>
                                          <div class="checkout-step-shipping">
                                            <h2 class="step-title">{{ trans('lang.shippingmethods')}}</h2>
                                              <table class="table table-step-shipping">
                                                <tbody>
                                                        @foreach($shipments as $s) 
                                                       <tr>
                                                        <td><input type="radio"   name="shipment_id" value="{{$s->id}}" required></td>
                                                        <td>@if($lang ==0)  {{$s->name_ar}}   @else  {{$s->name}}   @endif  </td>
                                                        <td>@if($lang ==0)  {{$s->desc_ar}}   @else  {{$s->desc}}   @endif </td>
                                                      </tr>
                                                        @endforeach
                                                     
                                                 </tbody>
                                               </table>
                                            </div>
                                        </li>
                                     <div class="row">
                                            <div class="col-lg-8">
                                                <div class="checkout-steps-action">
                                                   <button class="btn btn-primary float-right">{{ trans('lang.next')}}</button>
                                               </div>
                                            </div>
                                          </div>
                                      </form>
                            
                               <form   action="{{route('submitaddress')}}" method="POST">
                                    @csrf
                                <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                       <form action="#">
                                           <div class="modal-header">
                                            <h3 class="modal-title" id="addressModalLabel">{{ trans('lang.shippingaddress')}}</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                       </div>
                                   @if (Session::has('message'))
                               <div  class=" alert alert-success" style="font-size: 18px;">
                                     <strong>Done!</strong>  {{ trans('lang.addaddress')}}
                               </div>
                                   @endif
                            <div class="modal-body">
                                <div class="form-group required-field"  style="display:none;">
                                    <label> </label>
                                    <input type="hidden" class="form-control form-control-sm"   name="user_id" required>
                                 </div>
                                 <div class="form-group required-field">
                                       <label>{{ trans('lang.title')}}</label>
                                    <input type="text" class="form-control"   name="title"  required>
                                </div>
                    
                            <div class="form-group required-field">
                                <label>{{ trans('lang.address')}}</label>
                                  <input type="text" class="form-control form-control-sm"   name="address"  required>
                              </div> 
                            <div class="form-group required-field">
                                <label>{{ trans('lang.streetnumber')}}</label>
                                <input type="text" class="form-control form-control-sm"  name="street_name"  required>
                            </div>

                               <div class="form-group required-field">
                                  <label>{{ trans('lang.buildingnumber')}} </label>
                                   <input type="text" class="form-control form-control-sm"  name="building_number"  required>
                              </div>

                            <div class="form-group required-field">
                                <label>{{ trans('lang.floornumber')}} </label>
                                <input type="text" class="form-control form-control-sm"  name="floor_number"  required>
                            </div>

                           <div class="form-group required-field">
                                <label> {{ trans('lang.flatnumber')}} </label>
                                <input type="text" class="form-control form-control-sm"  name="flat_num"  required>
                             </div>
                            <div class="form-group required-field">
                                <label>{{ trans('lang.city')}} </label>
                                  <select class="form-control"   name="city">
                                     @foreach($cities as $city  )
                                       <option value="{{$city->name}}">{{$city->name}}</option>
                                      @endforeach
                                 </select>
                               </div>
                               
                            <div class="form-group">
                                <label>{{ trans('lang.area')}}</label>
                                  <select class="form-control"  name="area">
                                      @foreach($areas as $area )
                                       <option value="{{$area->name}}">{{$area->name}}</option>
                                      @endforeach
                                 </select>
                              </div>

                             <div class="form-group">
                                <label>{{ trans('lang.country')}}</label>
                               
                                  <select class="form-control"  name="country">
                                      @foreach($countries as $country  )
                                       <option value="{{$country->name}}">{{$country->name}}</option>
                                      @endforeach
                                 </select>
                             
                                  </div>
                                    <div class="form-group required-field">
                                        <label>{{ trans('lang.code')}}</label>
                                        <input type="text" class="form-control"   name="code"  required>
                                    </div>
                              </div>
                         </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link btn-sm" data-dismiss="modal">{{ trans('lang.cancel')}}</button>
                            <button type="submit" class="btn btn-primary btn-sm">{{ trans('lang.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </ul>
    </div>

                    <div class="col-lg-4">
                        <div class="order-summary">
                            <h3>{{ trans('lang.summary') }}</h3>
                            <h4>
                                <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="false" aria-controls="order-cart-section"><span class="cart-count" ></span>  {{ trans('lang.productincart') }}</a>
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
                                                  @if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }}  @endif   {{ $pro->price -($pro->price*($pro->offer/100))}}
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
                                </div>
                            </div>
                        </div>
                        <div class="mb-6"></div><!-- margin -->
                    </main><!-- End .main -->

@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif
@section('scripts')
    <script>
    
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
    
    
    
