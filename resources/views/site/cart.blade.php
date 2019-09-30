@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)

@include('site.template.header2')

@endif

<style>
   {
      float: left;
    }

    </style>
    
   
       <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.cart')}}</li>
                    </ol>
                </div>
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-table-container">
                            <table class="table table-cart">
                                <thead>
                                    <tr>
                                        <th class="product-col">{{ trans('lang.product')}}</th>
                                        <th class="price-col">{{ trans('lang.price')}}</th>
                                        <th class="qty-col">{{ trans('lang.quantity')}}</th>
                                    </tr>
                                </thead>
                                <tbody  id="cont">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="clearfix">
                                            <div class="float-left">
                                                <a href="{{url('/')}}" class="btn btn-outline-secondary">{{ trans('lang.c-shopping')}}</a>
                                            </div><!-- End .float-left -->

                                            <div class="float-right">
                                                <a href="#"   onclick="Removeall();"  class="btn btn-outline-secondary btn-clear-cart">{{ trans('lang.clear')}}</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h3>{{ trans('lang.summary') }}</h3>
                            
                                           @if(count($card)> 0)
                                            @foreach($card as $p)
                                            <?php
                                            
                                             $pro = App\Product::find($p['productid']);
                                             $data= App\Main::find(1);
                                             $lang =$data->setlang;
                                             $taxes=($data->sales_tax /100 * $pro->price);
                                             $final_price = $pro->price + $taxes;
                                        
                                             ?>  
                                  <table class="table table-totals">
                                   <tbody>
                                      <tr>
                                      <td>{{ trans('lang.subtotal')}}</td>
                                       <td>{{$pro->price}}
                                       </td>
                                      </tr>
                                    <tr>
                                      <td>{{ trans('lang.salestax')}}</td>
                                        <td>{{$taxes }}
                                         </td>
                                      </tr>
                                    <tfoot>
                                    <tr>
                                       <td>{{ trans('lang.total')}}</td>
                                         <td >  {{$final_price}}
                                          </td>
                                      </tr>
                                     </tfoot>
                                     </tbody>
                                     <tfoot>
                                   </tfoot>
                                </table>
                                   @endforeach
                                   @endif
                                 <div class="checkout-methods">
                                    <a href="{{url('/checkout')}}" class="btn btn-block btn-sm btn-primary">{{ trans('lang.checkout')}} </a>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-6"></div>
        </main>
@if($main->chosetemplate == 1)
@include('site.template.footer')

@endif

@if($main->chosetemplate   ==2)

@include('site.template.footer2')

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

       function  Removeall(){
        
            $.ajax({
                type: 'Get',
                url: "{{URL::to('removeall')}}",
               data: "" ,
                success: function (data) {
                    $("#smallcard").load("{{ url('smallcartcontent') }}");
                    $("#total").load("{{ url('total') }}");
                    $("#cont").load("{{ url('cartcontent') }}");
                }
            });
        }


        function plus(id)
        {
            document.getElementById('qu' + id).innerHTML = parseInt(document.getElementById('qu' + id).innerHTML) + 1;
        }
        function minus(id)
        {
            if (parseInt(document.getElementById('qu' + id).innerHTML) > 1) {
                document.getElementById('qu' + id).innerHTML = parseInt(document.getElementById('qu' + id).innerHTML) - 1;
            }
        }
                 function UpdateCart(id)
                {
                var newq = document.getElementById('qu' + id).innerHTML;
                newq = parseInt(newq);
                if (newq > 0)
                {
            $.ajax({
                type: 'Get',
                url: "{{URL::to('updatecart')}}" + '/' + id + '/' + newq,
                data: "itemid=" + id,
                success: function (data) {
                    if (data == "done") {
                        //  document.getElementById('messagebox').style.display = "block";
                        // document.getElementById('message').innerHTML = "There are onle " + data + " From Product";
                    } else
                    {
                        swal({
                            title: "Required Quantity Not avail!",
                            text: "Sorry",
                            timer: 2000,
                            showConfirmButton: false
                        });
                        //   document.getElementById('messagebox').style.display = "block";
                        //  document.getElementById('message').innerHTML = "There are onle " + data + " From Product";
                    }
                    $("#smallcard").load("{{ url('smallcartcontent') }}");
                    $(".total").load("{{ url('total') }}");

                }
            });
        }
    }

    </script>
    

