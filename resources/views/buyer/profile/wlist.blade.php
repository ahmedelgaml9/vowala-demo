@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)
@include('site.template.header2')
@endif
       
         <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('')}}">{{ trans('lang.home')}} </a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.dashboard')}}</li>
                    </ol>
                </div>
            </nav>
                 
            <div class="container mt-2">
                <div class="row">
                    <div class="col-lg-9 order-lg-last dashboard-content">

                        @foreach(Auth::user()->wishlist() as $w)
                     <?php $pro = $w->product($w->product_id) ?>
             
                      <div class="col-md-4">
                        <div class="product">
                            <figure class="product-image-container">
                                <a @if(Session::get('local') == 'ar') href="{{ url('product').'/'.$pro->custom_url }}"@else href="{{ url('product').'/'.$pro->custom_url }}" @endif  class="product-image">
                                    <img src="{{asset('admin-assets/images/products/'.$pro->catalog->photo)}}" alt="product">
                                </a>
                            </figure>
                            <div class="product-details">
                                
                                <h2 class="product-title">
                                    <a href="">@if (Session::get('local') == 'ar') {{$pro ->ar_name }} @else {{ $pro->name }} @endif</a>
                                </h2>
                                <div class="price-box">
                                    <span class="product-price">${{ $pro->price }}</span>
                                </div>
                                 <div class="product-action">
                                    <a class="paction add-cart"   onclick="AddToCart({{ $pro->id }})"  title="Add to Cart">
                                        <span>{{ trans('lang.tocart')}}</span>
                                    </a>
                                      <div style="margin:20px;">
                                         <a href="#" title="Remove product"  onclick="removefromwlist({{ $pro->id }});"   class="btn-remove"><span class="sr-only"></span></a>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>

                       @endforeach
                    <nav class="toolbox toolbox-pagination">
                        <div class="toolbox-item toolbox-show">
                        </div>
                  </nav>
                </div>
              
                    <aside class="sidebar col-lg-3">
                        <div class="widget widget-dashboard">
                            <h3 class="widget-title">{{ trans('lang.account')}}</h3>
                            <ul class="list">
                                <li><a href="{{url('profile')}}">{{ trans('lang.profile')}}</a></li>
                                <li><a href="{{url('mywishlist')}}">{{ trans('lang.wlist')}}</a></li>
                                <li><a href="{{url('myorders')}}">{{ trans('lang.myorders')}}</a></li>
                                <li><a href="{{url('addressbook')}}">{{trans('lang.addressbook')}}</a></li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        <div class="mb-5"></div>
      </main>


@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif     <script>
        function removefromwlist(id)
           {
            $.ajax({
                type: 'Get',
                url: "{{URL::to('removefromwlist')}}" + '/' + id,
                data: "itemid=" + id,
                success: function (data) {
                   swal({
                   title: "Success!",
                   text: "Product removed from wishlist.",
                   timer: 1000
                  });
                  
                    location.reload();

                  }
               });
           }
    </script>  

    