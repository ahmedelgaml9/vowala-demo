@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)
@include('site.template.header2')
@endif
     <main  class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Search</a></li>
                    </ol>
                </div>
            </nav>

            <div class="container">
                <div class="row row-sm">
                 @if(count($products)>0) 
                  @foreach($products  as $p)
                    <div class="col-6 col-md-4 col-xl-5col">
                        <div class="product">
                            <figure class="product-image-container">
                                <a @if(Session::get('local') == 'ar') href="{{ url('product').'/'.$p->ar_custom_url }}"@else href="{{ url('product').'/'.$p->custom_url }}" @endif  class="product-image">
                                    <img src="{{asset('admin-assets/images/products/'.$p->catalog->photo)}}" alt="product">
                                </a>
                            
                            </figure>
                            <div class="product-details">
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:80%"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <h2 class="product-title">
                                    <a href="">@if (Session::get('local') == 'ar') {{$p ->ar_name }} @else {{ $p->name }} @endif</a>
                                </h2>
                                <div class="price-box">
                                    <span class="product-price">${{ $p->price }}</span>
                                </div><!-- End .price-box -->

                                <div class="product-action">
                                           @if(Auth::check())
                                           @if(!Auth::user()->iswashed($p->id))
                                         <a href="#"  id="like{{$p->id}}"  onclick="Like({{
                                                  $p->id}}, 'like')" class="paction add-wishlist" title="Add to Wishlist">
                                                  <span>Add to Wishlist</span>
                                            </a>
                                             @endif
                                              @endif

                                    <a href="#" class="paction add-cart"   onclick="AddToCart({{ $p->id }})"  title="Add to Cart">
                                        <span>Add to Cart</span>
                                    </a>
                                    <a href="#" class="paction add-compare" title="Add to Compare">
                                        <span>Add to Compare</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                    </div><!-- End .col-md-4 -->
                        @endforeach
                         @else
                      <center> <h1 style="font-size: x-large;font-weight: bold;">No Results</h1></center>
                       @endif
                <nav class="toolbox toolbox-pagination">
                    <div class="toolbox-item toolbox-show">
                        
                    </div>
                </nav>
            </div><!-- End .container-fluid -->
        </main><!-- End .main -->





@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif