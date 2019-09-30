@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)
@include('site.template.header2')
@endif
             <?php
              $sections = App\Section::all();
              $features = \App\Benefits::all();
              $data= App\Main::find(1);
              $lang =$data->setlang;
              $main=App\Main::find(1);
              $currency= App\Currencies::where('id',$main->default_currency)->first();
              $product= App\Product::where('custom_url',$product->custom_url)->first();
            ?>
          
        <meta property="og:url"       content="{{ url('/') }}" />
    	<meta property="og:type"      content="website" />
    	<meta property="og:title"     content="{{ $product->title }}" />
        <meta property="og:image"      content="{{ asset('admin-assets/images/products/'.$product->catalog->photo)}}" />
        <meta property="fb:app_id" content="835595309920900"/>
        <meta name="twitter:card" content="summary_large_image"/>
        <meta name="twitter:site" content="@nytimes">
        <meta name="twitter:title" content="{{ $product->title }}"/>
        <meta name="twitter:image" content="{{ asset('admin-assets/images/products/'.$product->catalog->photo)}}"/>
         
         
         <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                 <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="icon-home"></i></a></li>
                       @if($product->cat != "")<li class="breadcrumb-item"><a href="#">{{$product->cat->name}}</a></li>@endif
                        <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
                      </ol>
                  </div>
               </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-single-container product-single-default">
                            <div class="row">
                                <div class="col-lg-7 col-md-6 product-single-gallery">
                                    <div class="product-slider-container product-item">
                                        <div class="product-single-carousel owl-carousel owl-theme">
                                           @foreach($product->catalog->photoes as $photo)
                                        <div class="col-3 owl-dot">
                                            <img src="{{ asset('admin-assets/images/products/'.$photo->photo)}}"   data-zoom-image="{{ asset('admin-assets/images/products/'.$photo->photo)}}"   style="width:470px;height:470px; " />
                                       </div>
                                          @endforeach
                                        </div>
                                        <span class="prod-full-screen">
                                            <i class="icon-plus"></i>
                                        </span>
                                    </div>
                                    <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
										  @foreach($product->catalog->photoes as $photo)
                                        <div class="col-3 owl-dot">
                                            <img src="{{ asset('admin-assets/images/products/'.$photo->photo)}}"  style="height:100px; " />
                                       </div>
                                           @endforeach
                                       </div>
                                    </div>

                                  <div class="col-lg-5 col-md-6">
                                    <div class="product-single-details">
                                        <h1 class="product-title">@if ($lang == 0)  {{ $product->name_ar }} @else {{ $product->name }} @endif</h1>
                                        
                                          <div class="price-box">
                                             @if($product->offer == 0 )
                                            <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }}  @else {{ $currency->name }}  {{ $currency->value }} @endif {{ $product->price }}</span>
                                              @else 
                                               <span class="old-price">@if ($lang == 0)  {{ $currency->name_ar }} {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }}  @endif {{ $product->price }}</span>
                                               <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }} {{ $currency->value }} @else {{ $currency->name }} {{ $currency->value }}   @endif {{ $product->price -($product->price*($product->offer/100))}}</span>
                                              @endif
                                            </div>

                                            <div class="product-desc" style="word-break:break-all;" >
                                            <p>@if ($lang == 0) 
                                               {!! substr($product->desc_ar,0,450) !!}
                                                 @else
                                                  {!! substr($product->desc,0,400) !!}
                                              @endif</p>
                                            </div>

                                             <div class="product-filters-container">
                                                    @if(count($product->colors) > 0)
                                                <div class="col-sm-6">
                                                   <label>Colors:</label>
                                                  <select id="color"  class="form-control">
                                                   @foreach($product->colors as $color)
                                                    <option  value="{{$color->id}}">{{ $color->color }}</option>
                                                      @endforeach 
                                                    </select>
                                               </div>
                                                   @endif
                                                  @if(count($product->Sizes) > 0)
                                                <div class="col-sm-6">
                                                  <label>Sizes:</label>
                                                  <select id="size"  class="form-control">
                                                 @foreach($product->Sizes as $size)
                                                <option  value="{{$size->id}}">{{$size->size }}</option>
                                                 @endforeach 
                                                 </select>
                                                 </div>
                                               @endif
                                           </div>
                                         <div class="sticky-header">
                                           <div class="container">
                                                 <div class="sticky-img">
                                                    <img src="{{ asset('admin-assets/images/products/'.$product->catalog->photo)}}" />
                                                 </div>
                                               <div class="sticky-detail">
                                                    <div class="sticky-product-name">
                                                        <h2 class="product-title">@if ($lang == 0) 
                                                            {!! $product->name_ar !!} @else  {!! $product->name !!}  @endif</h2>
                                                           <div class="price-box">
                                                         @if($product->offer == 0 )
                                                        <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }}  @else {{ $currency->name }}  {{ $currency->value }} @endif {{ $product->price }}</span>
                                                          @else 
                                                           <span class="old-price">@if ($lang == 0)  {{ $currency->name_ar }} {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }}  @endif {{ $product->price }}</span>
                                                           <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }} {{ $currency->value }} @else {{ $currency->name }} {{ $currency->value }}   @endif {{ $product->price -($product->price*($product->offer/100))}}</span>
                                                          @endif
                                                        </div>
                                                        </div>
                                                     </div>
                                                       @if($product->Quantity() >0)
                                                   <a href="#"   onclick="AddToCartmore({{ $product->id }})"  class="paction add-cart"  title="Add to Cart">
                                                      <span>{{ trans('lang.tocart')}}</span>
                                                   </a>
                                                       @else
                                                   <a href="#" class="paction add-cart"  title="Add to Cart">
                                                         <span>{{ trans('lang.outofstock')}}</span>
                                                    </a>
                                                      @endif
                                                </div>
                                            </div>

                                            <div class="product-action product-all-icons">
                                                    @if(Auth::check())
                                                    @if(!Auth::user()->iswashed($product->id))
                                                    <a href="{{url('mywishlist')}}"  id="like{{$product->id}}"  onclick="Like({{
                                                               $product->id}}, 'like')" class="paction add-wishlist" title="Add to Wishlist">
                                                        <span>Add to Wishlist</span>
                                                     </a>
                                                    @endif
                                                    @endif
                                            <div class="product-single-qty">
                                               <input class="horizontal-quantity form-control"  type="text">
                                            </div>
                                            
                                               @if($product->Quantity() > 0 )
                                            <a href="#"    onclick="AddToCartmore({{ $product->id }})"  class="paction add-cart"  title="Add to Cart">
                                               <span>{{ trans('lang.tocart')}}</span>
                                            </a>
                                                 @else
                                               <a href="#" class="paction add-cart"  title="Add to Cart">
                                                <span>Out of Stock </span>
                                                </a>
                                                    @endif
                                              </div>
                                        <div class="product-single-share">
                                            <label>Share:</label>
                                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url('product/'.$product->custom_url) }}" class="social-icon" ><i class="icon-facebook"></i></a>
                                                <a target="_blank" href="https://twitter.com/intent/tweet?text={{ url('product/'.$product->custom_url)}}"  class="social-icon"><i class="icon-twitter"></i></a>
                                        </div><!-- End .product single-share -->
                                    </div><!-- End .product-single-details -->
                                </div><!-- End .col-lg-5 -->
                            </div><!-- End .row -->
                        </div><!-- End .product-single-container -->

                        <div class="product-single-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">{{ trans('lang.desc')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">{{ trans('lang.return_policy') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                                    <div class="product-desc-content">
                                        <p>@if ($lang == 0) 
                                          {!! $product->desc_ar !!} @else  {!! $product->desc !!}  @endif</p>
                                      </div>
                                    </div>
                                  <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                                      <div class="product-reviews-content">
                                          @if ($lang == 0)  {!! $product->return_policy_ar !!} @else  {!!  $product->return_policy !!}  @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-overlay"></div>
                    <div class="sidebar-toggle"><i class="icon-sliders"></i></div>
                    <aside class="sidebar-product col-lg-3 padding-left-lg mobile-sidebar">
                        <div class="sidebar-wrapper">
                            <div class="widget widget-brand">
                                <a href="{{url('brand/'.$product->brand->custom_url)}}">
                                 @if($product->brand != "") <img src="{{ asset('admin-assets/images/brands/'.$product->brand->photo)}}" style="width:100%; height:50px;" alt="brand name"> @endif
                                </a>
                            </div>
                             <div class="widget widget-info">
                                     <ul>
                                        @foreach($features as $p)  
                                       <li> <i class="icon-{{$p->icon}}"></i>
                                        @if ($lang == 0)  {{$p->name_ar}}  @else{{$p->name}}  @endif</li>
                                          @endforeach       
                                       </ul>
                                     
                                    </div>
                               <div class="widget widget-featured">
                                   <h3 class="widget-title">{{ trans('lang.related') }}</h3>
                                      <div class="widget-body">
                                         <div class="owl-carousel widget-featured-products">
                                            <div class="featured-col">
                                                @foreach($related as $pro)
                                              <div class="product product-sm">
                                                <figure class="product-image-container">
                                                    <a @if (Session::get('local') == 'ar') href="{{ url('product').'/'.$pro->custom_url_ar}}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif class="product-image">
                                                        <img src="{{asset('admin-assets/images/products/'.$pro->catalog->photo)}}"  style="height:100px;" alt="product">
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h2 class="product-title">
                                                        <a @if (Session::get('local') == 'ar') href="{{ url('product').'/'.$pro->custom_url_ar}}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif >@if ($lang == 0)  {{ $pro->name_ar }} @else {{ $pro->name }} @endif</a>
                                                    </h2>
                                                    
                                                    <div class="price-box">
                                                        <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }} {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }}@endif{{ $pro->price }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         @endforeach
                                    </div>
                                </div>
                            </div>
                         </div>
                     </aside>
                 </div>
             </div>
                   
            <div class="featured-section">
                <div class="container">
                    <h2 class="carousel-title">{{ trans('lang.related') }}</h2>
                    <div class="featured-products owl-carousel owl-theme owl-dots-top">
                         
                         <?php
                         
                          $products =App\Related::pluck('product_id');
                          $productrelates=App\Product::wherein('id',$products)->get();

                          ?>
                        
                        
                              @foreach($productrelates as $pro)
                           <div class="product">
                              <figure class="product-image-container">
                                  <a @if ($lang == 0)  href="{{ url('product').'/'.$pro->custom_url_ar }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif class="product-image">
                                     <img src="{{asset('admin-assets/images/products/'.$pro->Catalog->photo)}}"  style="height:200px;" alt="product">
                                  </a>
                                </figure>
                                  <div class="product-details">
                                        <h2 class="product-title">
                                          <a href="">@if ($lang == 0)  {{ $pro->name_ar }} @else {{ $pro->name }} @endif</a>
                                       </h2>
                                           <div class="price-box">
                                                   @if( $pro->offer != 0 )
                                                <span class="product-price">{{ $pro->price -($pro->price*($pro->offer/100))}}</span>
                                                   @else 
                                                <span class="product-price">{{ $pro->price }}</span>
                                                    @endif    
                                                    </div>
                                                    </div>
                                              <div class="product-action">
                                                @if(Auth::check())
                                                @if(!Auth::user()->iswashed($pro->id))
                                            <a href="#"  id="like{{$pro->id}}"  onclick="Like({{$pro->id}}, 'like')" class="paction add-wishlist" title="Add to Wishlist">
                                                <span>Add to Wishlist</span>
                                            </a>
                                               @endif
                                               @endif
                                               @if($pro->Quantity() > 0 )
                                                <a href="#"   onclick="AddToCartmore({{ $pro->id }})"  class="paction add-cart"  title="Add to Cart">
                                                   <span>{{ trans('lang.tocart')}}</span>
                                               </a>
                                                 @else
                                               <a href="#" class="paction add-cart"  title="Add to Cart">
                                                <span>{{ trans('lang.outofstock')}}</span>
                                                </a>
                                                @endif
                                         </div>
                                      </div>
                                      @endforeach
                                   </div>
                              </div>
                            </div>
                        </div>
                    </main>
            

<script>
    (function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
            return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=1786041425014289";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    !function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
            p = /^http:/.test(d.location) ? 'http' : 'https';
    if (!d.getElementById(id)) {
    js = d.createElement(s);
    js.id = id;
    js.src = p + '://platform.twitter.com/widgets.js';
    fjs.parentNode.insertBefore(js, fjs);
    }
    }
    (document, 'script', 'twitter-wjs');

</script>



@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif