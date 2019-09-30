@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)
@include('site.template.header2')
@endif
<style>
    
 #session{
     
   display:none;
     
 }  

</style>
<?php
$data= App\Main::find(1);
$lang =$data->setlang;
$card= $_SESSION['cart'];
$main=App\Main::find(1);
$currency= App\Currencies::where('id',$main->default_currency)->first();

$country =  Session::get('country');
$city =  Session::get('city');
$order_id = Session::get('order_id');
$total_price =  Session::get('total_price');
$payment_price  =  Session::get('payment_price');
$shipping_tax = Session::get('shipping_tax');
$shipping_price =  Session::get('shipping_price');
$sales_tax  =  Session::get('salestax');


?>
       <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.checkout') }}</li> 
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
                          <div class="col-lg-8 order-lg-first">
                             <div class="checkout-payment">
                                  
                                       <div class="form-group required-field">
                                          <input type="hidden"  value="{{$city}}"  id="city" class="form-control" >
                                       </div>
                                    
                                   <div class="form-group">
                                      <input type="hidden"  name="total_price"  id="total_price"  value="{{$total_price}}"    class="form-control form-control-sm" required >
                                  </div>
                                  
                                   <div id="session"  ></div>
                                   <div class="form-group required-field">
                                      <input type="hidden"  id="order_id"   name="order_id" value="{{$order_id}}"  class="form-control" >
                                  </div>
                                   <div  style="display:none">
                                  <div id="session" >
                                      
                                  </div>
                                  </div>
                                     <script src="https://banquemisr.gateway.mastercard.com/checkout/version/52/checkout.js"
                                         data-cancel="cancelCallback"
                                          data-complete="completeCallback">
                                        
                                          </script>
                                              
                                        <script type="text/javascript" src="https://code.jquery.com/jquery-1.4.3.min.js" ></script>
                                           <script type="text/javascript">
                                              $(document).ready(function(){
                                                $("#pay").mousemove(function(){
                                                    price = $("#total_price").val();
                                                    session = $("#session").text();
                                                    city= $("#order_id").val();  
                                                 
                                                });
                                              });
                                        
                                                  cancelCallback = "https://waffarnaa.com/public/cancelpayment",
                                                  completeCallback= "https://waffarnaa.com/public/editorder/{{$order_id}}",
                                                  
                                                 Checkout.configure({
                                                  merchant:'WAFFARNA_EGP',
                                                  session: { 
                                                     id : session
                                                     },
                                                    order: {
                                                   amount: function() {
                                                    //Dynamic calculation of amount
                                                     return price ;
                                                    },
                                                 currency: 'EGP',
                                                 description: 'new online payment',
                                                 id: city 
                                                   },
                                                  
                                                  interaction: {
                                                  operation: 'PURCHASE',
                                                  merchant: {
                                                    name: 'Kreaz Techno Services',
                                                    address: {
                                                        line2:'cairo'      
                                                     }    
                                                   }
                                                  }
                                               });
                                              
                                       </script>
                                  <div class="col-sm-6">
                                    <div class="checkout-steps-action"> 
                                      <button   class="btn btn-primary float-right"  id="pay"   onclick="Checkout.showPaymentPage();" >{{ trans('lang.paypage') }}</button>
                                 </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-6"></div>
        </main>
       @if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif

         
  <script>
     var fullUrlLink = location.href;
   if (fullUrlLink.search("hc-action-complete") > 0) {
       window.location.href="{{url('editorder/'.$order->id)}}"
   }else{
         window.reload();
    }
      
  </script>