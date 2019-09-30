
@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)
@include('site.template.header2')
@endif

@inject('cat',App\Block) 
@inject('product',App\Product) 
@inject('feature',App\Benefits) 
        
             <?php
                 $data= App\Main::find(1);
                 $lang =$data->setlang;
                 $features = $feature::all();
                 $main=App\Main::find(1);
                 $currency= App\Currencies::where('id',$main->default_currency)->first();
             
               ?>
               
               
             @if($main->chosetemplate == 1)
          <main class="main">
              <div class="home-slider-container">
                  <div class="home-slider owl-carousel owl-theme owl-theme-light">
                      @foreach($slider as $s)
                    <div class="home-slide">
                        <div class="slide-bg owl-lazy"  data-src="{{ asset('admin-assets/images/slider/'.$s->photo)}}"></div><!-- End .slide-bg -->
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-8 col-md-6 text-center slide-content-right">
                                    <div class="home-slide-content">
                                        <h3>@if ($lang == 0)  {{ $s->name_ar }} @else {{ $s->name }} @endif</h3>
                                        <h1>@if ($lang == 0)  {{ $s->title_ar }} @else {{ $s->title }} @endif</h1>
                                        <a href="{{ $s->link }}" class="btn btn-primary">@if ($lang == 0)  {{ $s->button_title_ar }} @else {{ $s->button_title }} @endif</a>
                                    </div><!-- End .home-slide-content -->
                                </div><!-- End .col-lg-5 -->
                            </div><!-- End .row -->
                        </div><!-- End .container -->
                    </div><!-- End .home-slide -->
                    
                      @endforeach
                </div><!-- End .home-slider -->
            </div><!-- End .home-slider-container -->

            <div class="info-boxes-container">
                <div class="container">
                        @foreach($features as $p)
                    <div class="info-box">
                        <i class="icon-{{$p->icon}}"></i>
                        <div class="info-box-content">
                            <h4>@if ($lang == 0)   {{$p->name_ar}}  @else{{$p->name}}  @endif</h4>
                            <p>@if ($lang == 0)    {{$p->desc_ar}}  @else{{$p->desc}}  @endif</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->
                     @endforeach       
                </div><!-- End .container -->
            </div><!-- End .info-boxes-container -->

            <div class="banners-group">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="banner banner-image">
                                <a href="{{$adds[1]->link}}">
                                    <img src="{{ asset('admin-assets/images/adds/'.$adds[0]->photo)}}" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="banner banner-image">
                                <a href="{{$adds[2]->link}}">
                                    <img src="{{ asset('admin-assets/images/adds/'.$adds[1]->photo)}}" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="banner banner-image">
                                <a href="{{$adds[2]->link}}">
                                    <img src="{{ asset('admin-assets/images/adds/'.$adds[2]->photo)}}" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .banneers-group -->

            <div class="featured-products-section carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">{{ trans('lang.popular')}}</h2>
                        @if(isset($popular))
                     <div class="new-products owl-carousel owl-theme">
                           @foreach($popular  as $pro)
                        <div class="product">
                            <figure class="product-image-container">
                                 <a @if ($lang == 0)  href="{{ url('product').'/'.$pro->custom_url_ar }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif  class="product-image">
                                    <img src="{{asset('admin-assets/images/products/'.$pro->catalog->photo)}}"  style="width:100%; height:200px;" alt="product">
                                  </a>
                                  @if($pro->type  != null) <span class="product-label label-{{$pro->type}}">{{$pro->type}}</span>  @endif
                               </figure>
                                  <div class="product-details">
                                      <h2 class="product-title">
                                       <a  @if ($lang == 0 )  href="{{ url('product').'/'.$pro->custom_url_ar }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif  >@if ($lang == 0)  {{ $pro->name_ar }} @else {{ $pro->name }} @endif</a>
                                      </h2>
                                    <div class="price-box">
                                        @if($pro->offer != 0 )
                                        <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }} {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }}  @endif  {{ $pro->price -($pro->price*($pro->offer/100))}}</span>
                                          @else 
                                        <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }}  @endif  {{ $pro->price }}</span>
                                          @endif
                                      </div>
                                      <div class="product-action">
                                               @if(Auth::check())
                                               @if(!Auth::user()->iswashed($pro->id))
                                                  <a href="{{url('mywishlist')}}"  id="like{{$pro->id}}"  onclick="Like({{
                                                       $pro->id}}, 'like')" class="paction add-wishlist" title="Add to Wishlist">
                                                        <span>Add to Wishlist</span>
                                                   </a>
                                                    @endif
                                                    @endif
                                                 @if($pro->Quantity() > 0)
                                                <a href="#"   onclick="AddToCart({{ $pro->id }})"  class="paction add-cart"  title="Add to Cart">
                                                   <span>{{ trans('lang.tocart')}}</span>
                                               </a>
                                                 @else
                                               <a href="#" class="paction add-cart"  title="Add to Cart">
                                                <span>{{ trans('lang.outofstock')}} </span>
                                                </a>
                                                @endif
                                          </div>
                                       </div>
                                   </div>
                                  @endforeach
                              </div>
                              @endif
                            </div><!-- End .container -->
                       </div><!-- End .featured-proucts-section -->
               <div class="mb-5"></div><!-- margin -->
                 <div class="carousel-section">
                   <div class="container">
                      <h2 class="h3 title mb-4 text-center">{{ trans('lang.rnew')}}</h2>
                         @if(isset($newest))
                        <div class="new-products owl-carousel owl-theme">
                             @foreach($newest  as $pro)
                            <div class="product">
                              <figure class="product-image-container">
                                 <a @if ($lang == 0)  href="{{ url('product').'/'.$pro->custom_url_ar }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif  class="product-image">
                                    <img src="{{asset('admin-assets/images/products/'.$pro->catalog->photo)}}"   style="width:100%; height:200px;" alt="product">

                                  </a>
                                   @if($pro->type  != null) <span class="product-label label-{{$pro->type}}">{{$pro->type}}</span>  @endif
                               </figure>
                             <div class="product-details">
                                  <h2 class="product-title">
                                      <a  @if ($lang == 0 )  href="{{ url('product').'/'.$pro->custom_url_ar }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif  >@if ($lang == 0) {{ $pro->name_ar }} @else {{ $pro->name }} @endif</a>
                                  </h2>
                                 <div class="price-box">
                                        @if($pro->offer != 0 )
                                       <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }} @else {{ $currency->name }}   {{ $currency->value }} @endif{{ $pro->price -($pro->price*($pro->offer/100))}}</span>
                                          @else 
                                      <span class="product-price">@if ($lang == 0) {{ $currency->name_ar }} {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }} @endif{{ $pro->price }}</span>
                                            @endif
                                       </div>
                                       <div class="product-action">
                                               @if(Auth::check())
                                               @if(!Auth::user()->iswashed($pro->id))
                                               <a href="{{url('mywishlist')}}"  id="like{{$pro->id}}"  onclick="Like({{
                                                   $pro->id}}, 'like')" class="paction add-wishlist" title="Add to Wishlist">
                                                  <span>Add to Wishlist</span>
                                               </a>
                                                 @endif
                                                 @endif
                                               @if($pro->Quantity() > 0)
                                                <a href="#"   onclick="AddToCart({{ $pro->id }})"  class="paction add-cart"  title="Add to Cart">
                                                   <span>{{ trans('lang.tocart')}}</span>
                                               </a>
                                                 @else
                                               <a href="#" class="paction add-cart"  title="Add to Cart">
                                                <span>{{ trans('lang.outofstock')}} </span>
                                                </a>
                                                @endif
                                       
                                            </div>
                                        </div><!-- End .product-details -->
                                    </div><!-- End .product -->
                                      @endforeach
                                </div><!-- End .news-proucts -->
                                @endif
                            </div><!-- End .container -->
                        </div><!-- End .carousel-section -->

            <div class="mb-5"></div>
            <div class="promo-section" style="background-image: url({{ asset('adminstyle/assets/images/gallery/'.$main->homebanner)}})">
                <div class="container">
                    <h3>@if ($lang == 0)  {{$main->home_title_ar}}  @else {{$main->home_title}}  @endif</h3>
                    <a href="{{$main->home_link}}"class="btn btn-dark">{{ trans('lang.shop')}}</a>
                </div>
            </div>

            <div class="partners-container">
                <div class="container">
                    <h2 class="h3 title text-center">{{trans('lang.brands')}}</h2>
                    <div class="partners-carousel owl-carousel owl-theme">
                           @foreach($brands as $b)
                             <a href="{{url('brand/'.$b->custom_url)}}" class="partner">
                            <img src="{{asset('admin-assets/images/brands/'.$b->photo)}}"   style="width:100%; height:50px;" alt="">
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="blog-section">
                <div class="container">
                    <h2 class="h3 title text-center">{{trans('lang.recent_blogs')}}</h2>
                    <div class="blog-carousel owl-carousel owl-theme">
                          @foreach($blogs as $blog)
                        <article class="entry">
                            <div class="entry-media">
                                <a href="{{ url('blog/'.$blog->custom_url)}}">
                                    <img src="{{asset('admin-assets/images/blogs/'.$blog->photo)}}" alt="Post">
                                </a>
                                <div class="entry-date">{{ date('d-m',strtotime($blog->created_at))}} </div><!-- End .entry-date -->
                            </div>
                            <div class="entry-body">
                                <h3 class="entry-title">
                                    <a href="{{ url('blog/'.$blog->custom_url)}}"> @if ($lang == 0)  {{$blog->title_ar }}  @else {{ $blog->title }}  @endif</a>
                                </h3>
                                <div class="entry-content">
                                    <p> @if ($lang == 0)  {!! $blog->desc_ar !!}  @else  {!! $blog->desc !!}  @endif</p>
 
                                    <a href="{{ url('blog/'.$blog->custom_url)}}" class="btn btn-dark">{{ trans('lang.more')}}</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->
                             @endforeach
                    </div><!-- End .blog-carousel -->
                </div><!-- End .container -->
            </div><!-- End .blog-section -->
        </main><!-- End .main -->
@endif
@if($main->chosetemplate == 1)

@include('site.template.footer')

@endif
       @if($main->chosetemplate ==2)

         <main class="main">
            <div class="home-slider-container">
                <div class="home-slider owl-carousel owl-theme owl-theme-light">
                        @foreach($slider as $s)
                    <div class="home-slide">
                        <div class="slide-bg owl-lazy"  data-src="{{ asset('admin-assets/images/slider/'.$s->photo)}}"></div><!-- End .slide-bg -->
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-8 col-md-6 text-center slide-content-right">
                                    <div class="home-slide-content">
                                        <h3>@if ($lang == 0)  {{ $s->name_ar }} @else {{ $s->name }} @endif</h3>
                                        <h1>@if ($lang == 0)  {{ $s->title_ar }} @else {{ $s->title }} @endif</h1>
                                        <a href="{{ $s->link }}" class="btn btn-primary">@if ($lang == 0)  {{ $s->button_title_ar }} @else {{ $s->button_title }} @endif</a>
                                    </div><!-- End .home-slide-content -->
                                </div><!-- End .col-lg-5 -->
                            </div><!-- End .row -->
                        </div><!-- End .container -->
                    </div><!-- End .home-slide -->
                    
                      @endforeach

                
                </div><!-- End .home-slider -->
            </div><!-- End .home-slider-container -->

            <div class="banners-container mb-4 mb-lg-6 mb-xl-8">
                <div class="container">
                    <div class="row no-gutters">
                       <div class="col-md-4">
                            <div class="banner banner-image">
                                <a href="{{$adds[1]->link}}">
                                    <img src="{{ asset('admin-assets/images/adds/'.$adds[0]->photo)}}" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="banner banner-image">
                                <a href="{{$adds[2]->link}}">
                                    <img src="{{ asset('admin-assets/images/adds/'.$adds[1]->photo)}}" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="banner banner-image">
                                <a href="{{$adds[2]->link}}">
                                    <img src="{{ asset('admin-assets/images/adds/'.$adds[2]->photo)}}" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .banners-container -->

            <div class="container mb-2 mb-lg-4 mb-xl-5">
                <h2 class="title text-center mb-3"></h2>
                <div class="owl-carousel owl-theme featured-products">
                            @if(isset($popular))
                           @foreach($popular as $pro)
                            <div class="product">
                              <figure class="product-image-container">
                                 <a @if ($lang == 0)  href="{{ url('product').'/'.$pro->custom_url_ar }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif  class="product-image">
                                    <img src="{{asset('admin-assets/images/products/'.$pro->catalog->photo)}}"   style="width:100%; height:200px;" alt="product">
                                    <img src="{{asset('admin-assets/images/products/'.$pro->catalog->photo)}}" class="hover-image" alt="product">

                                  </a>
                                   @if($pro->type  != null) <span class="product-label label-{{$pro->type}}">{{$pro->type}}</span>  @endif
                               </figure>
                             <div class="product-details">
                                  <h2 class="product-title">
                                      <a  @if ($lang == 0 )  href="{{ url('product').'/'.$pro->custom_url_ar }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif  >@if ($lang == 0) {{ $pro->name_ar }} @else {{ $pro->name }} @endif</a>
                                  </h2>
                                 <div class="price-box">
                                        @if($pro->offer != 0 )
                                       <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }} @else {{ $currency->name }}   {{ $currency->value }} @endif{{ $pro->price -($pro->price*($pro->offer/100))}}</span>
                                          @else 
                                      <span class="product-price">@if ($lang == 0) {{ $currency->name_ar }} {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }} @endif{{ $pro->price }}</span>
                                            @endif
                                       </div>
                                     <div class="product-details-inner">
                                       <div class="product-action">
                                               @if(Auth::check())
                                               @if(!Auth::user()->iswashed($pro->id))
                                               <a href="{{url('mywishlist')}}"  id="like{{$pro->id}}"  onclick="Like({{
                                                   $pro->id}}, 'like')" class="paction add-wishlist" title="Add to Wishlist">
                                                  <span>Add to Wishlist</span>
                                               </a>
                                                 @endif
                                                 @endif
                                               @if($pro->Quantity() > 0)
                                                <a href="#"   onclick="AddToCart({{ $pro->id }})"  class="paction add-cart"  title="Add to Cart">
                                                   <span>{{ trans('lang.tocart')}}</span>
                                               </a>
                                                 @else
                                               <a href="#" class="paction add-cart"  title="Add to Cart">
                                                <span>{{ trans('lang.outofstock')}} </span>
                                                </a>
                                                @endif
                                       
                                            </div>
                                          </div>
                                        </div><!-- End .product-details -->
                                    </div><!-- End .product -->
                                      @endforeach
                                @endif


                </div><!-- End .featured-products -->
            </div><!-- End .container -->

            <div class="promo-section" style="background-image: url(assets/images/Demo2/400.jpg)">
                <div class="container">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="promo-slider owl-carousel owl-theme owl-theme-light">
                                    <div class="promo-content">
                                        <h3>Up to <span>40%</span> Off<br> <strong>Special Promo</strong></h3>
                                        <a href="#" class="btn btn-primary">Purchase Now</a>
                                    </div><!-- Endd .promo-content -->

                                  
                                </div><!-- End .promo-slider -->
                            </div><!-- End .col-lg-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .container -->
            </div><!-- End .promo-section -->

            <div class="container mb-2 mb-lg-4 mb-xl-5">
                <h2 class="title text-center mb-3">New Arrivals</h2>
                <div class="owl-carousel owl-theme new-products">
                       @if(isset($newest))
                             @foreach($newest  as $pro)
                            <div class="product">
                              <figure class="product-image-container">
                                 <a @if ($lang == 0)  href="{{ url('product').'/'.$pro->custom_url_ar }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif  class="product-image">
                                    <img src="{{asset('admin-assets/images/products/'.$pro->catalog->photo)}}"   style="width:100%; height:200px;" alt="product">
                                    <img src="{{asset('admin-assets/images/products/'.$pro->catalog->photo)}}" class="hover-image" alt="product">

                                  </a>
                                   @if($pro->type  != null) <span class="product-label label-{{$pro->type}}">{{$pro->type}}</span>  @endif
                               </figure>
                             <div class="product-details">
                                  <h2 class="product-title">
                                      <a  @if ($lang == 0 )  href="{{ url('product').'/'.$pro->custom_url_ar }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif  >@if ($lang == 0) {{ $pro->name_ar }} @else {{ $pro->name }} @endif</a>
                                  </h2>
                                 <div class="price-box">
                                        @if($pro->offer != 0 )
                                       <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }} @else {{ $currency->name }}   {{ $currency->value }} @endif{{ $pro->price -($pro->price*($pro->offer/100))}}</span>
                                          @else 
                                      <span class="product-price">@if ($lang == 0) {{ $currency->name_ar }} {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }} @endif{{ $pro->price }}</span>
                                            @endif
                                       </div>
                                     <div class="product-details-inner">
                                       <div class="product-action">
                                               @if(Auth::check())
                                               @if(!Auth::user()->iswashed($pro->id))
                                               <a href="{{url('mywishlist')}}"  id="like{{$pro->id}}"  onclick="Like({{
                                                   $pro->id}}, 'like')" class="paction add-wishlist" title="Add to Wishlist">
                                                  <span>Add to Wishlist</span>
                                               </a>
                                                 @endif
                                                 @endif
                                               @if($pro->Quantity() > 0)
                                                <a href="#"   onclick="AddToCart({{ $pro->id }})"  class="paction add-cart"  title="Add to Cart">
                                                   <span>{{ trans('lang.tocart')}}</span>
                                               </a>
                                                 @else
                                               <a href="#" class="paction add-cart"  title="Add to Cart">
                                                <span>{{ trans('lang.outofstock')}} </span>
                                                </a>
                                                @endif
                                       
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                      @endforeach
                                      @endif
                                </div>
                           </div>  
                
            <div class="blog-section">
                <div class="container">
                    <h2 class="title text-center mb-3">From the Blog</h2>

                    <div class="blog-carousel owl-carousel owl-theme">

                          @foreach($blogs as $blog)
                        <article class="entry">
                            <div class="entry-media">
                                <a href="{{ url('blog/'.$blog->custom_url)}}">
                                    <img src="{{asset('admin-assets/images/blogs/'.$blog->photo)}}" alt="Post">
                                </a>
                                <div class="entry-date">{{ date('d-m',strtotime($blog->created_at))}} </div><!-- End .entry-date -->
                            </div>
                            <div class="entry-body">
                                <h3 class="entry-title">
                                    <a href="{{ url('blog/'.$blog->custom_url)}}"> @if ($lang == 0)  {{$blog->title_ar }}  @else {{ $blog->title }}  @endif</a>
                                </h3>
                                <div class="entry-content">
                                    <p> @if ($lang == 0)  {!! $blog->desc_ar !!}  @else  {!! $blog->desc !!}  @endif</p>
 
                                    <a href="{{ url('blog/'.$blog->custom_url)}}" class="btn btn-dark">{{ trans('lang.more')}}</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->
                             @endforeach
                    </div>
                </div>
            </div>
        </main>
         
 @endif
@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif