@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)
@include('site.template.header2')
@endif

<?php
$data= App\Main::find(1);
$lang =$data->setlang;
 $main=App\Main::find(1);
$currency= App\Currencies::where('id',$main->default_currency)->first();
?>
   
        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb mt-0">
                        <li class="breadcrumb-item"><a href="{{url('')}}"><i class="icon-home"></i></a></li>
                    </ol>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        
                          <div class="boxed-slider owl-carousel owl-carousel-lazy owl-theme owl-theme-light mb-2">
                            <div class="category-slide">
                                <div class="slide-bg owl-lazy"  data-src="{{asset('adminstyle/assets/images/gallery/'.$main->categoryphoto)}}"></div>
                                <div class="banner boxed-slide-content offset-1">
                                    <h2 class="banner-subtitle"></h2>
                                 </div>
                             </div>
                             
                          </div>
                        <nav class="toolbox">
                           <div class="toolbox-left">
                            {!! Form::open(['action'=>['SiteController@sort'],'class'=>'search-area form-group search-area-white','method'=>'get']) !!}
                                <div class="toolbox-item toolbox-sort">
                                    <div class="select-custom">
                                        <select name="orderby" class="form-control">
                                            <option value="offer">{{ trans('lang.offer')}}</option>
                                            <option value="last_view">{{ trans('lang.sortnew')}}</option>
                                            <option value="price">{{ trans('lang.sortbyprice')}}</option>
                                        </select>
                                    </div>
        
                                    <button  class="sorter-btn" title="Set Ascending Direction"><span class="sr-only">Set Ascending Direction</span>
                                </div>
                                </form>
                            </div>

                            <div class="toolbox-item toolbox-show">
                            </div>

                             <div class="layout-modes">
                               
                             </div>
                         </nav>
                    <div class="row row-sm">
                         @foreach($products  as $p)
                      <div class="col-6 col-md-4 ">
                           <div class="product">
                                <figure class="product-image-container">
                                    <a  href="{{ url('product').'/'.$p->custom_url }}"   class="product-image">
                                        <img src="{{asset('admin-assets/images/products/'.$p->catalog->photo)}}" style="height:200px;"  alt="product">
                                    </a>
                                 @if($p->type  != null) <span class="product-label label-{{$p->type}}">{{$p->type}}</span>  @endif

                                </figure>
                                     <div class="product-details">
                                          <h2 class="product-title">
                                              <a href="">@if ($lang == 0) {{$p ->name_ar}} @else {{ $p->name }} @endif</a>
                                          </h2>
                                        <div class="price-box">
                                            @if($p->offer != 0 )
                                             <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }}  {{ $currency->value }} @else {{ $currency->name }}  {{ $currency->value }} @endif{{ $p->price -($p->price*($p->offer/100))}}</span>
                                             @else 
                                            <span class="product-price">@if ($lang == 0)  {{ $currency->name_ar }}    {{ $currency->value }}@else {{ $currency->name }}  {{ $currency->value }} @endif{{ $p->price }}</span>
                                             @endif          
                                             </div>
                                             </div>
                                          <div class="product-action">
                                               @if(Auth::check())
                                               @if(!Auth::user()->iswashed($p->id))
                                           <a href="{{url('mywishlist')}}"  id="like{{$p->id}}"  onclick="Like({{
                                                   $p->id}}, 'like')" class="paction add-wishlist" title="Add to Wishlist">
                                               <span>Add to Wishlist</span>
                                            </a>
                                              @endif
                                              @endif

                                          <a class="paction add-cart"   onclick="AddToCart({{ $p->id }})"  title="Add to Cart">
                                             <span>{{ trans('lang.tocart')}}</span>
                                         </a>      
                                   </div>
                               </div>
                            </div>
                            @endforeach
                         </div>
                        <nav class="toolbox toolbox-pagination">
                            <div class="toolbox-item toolbox-show">
                            </div>
                            <ul class="pagination">
                            </ul>
                        </nav>
                    </div>

                    <aside class="sidebar-shop col-lg-3 order-lg-first">
                        <div class="sidebar-wrapper">
                            <div class="widget">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-body-1" role="button" aria-expanded="true" aria-controls="widget-body-1">{{ trans('lang.products')}}</a>
                                </h3>
                            </div>

                            <div class="widget">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">{{ trans('lang.price')}}</a>
                                </h3>
                                <div class="collapse show" id="widget-body-2">
                                    <div class="widget-body">
                                          {!! Form::open(['action'=>['SiteController@sortprice'],'class'=>'search-area form-group
                                             search-area-white','method'=>'get']) !!}      
                                            {{ trans('lang.from')}}<INPUT TYPE="NUMBER" MIN="0" MAX="1000" STEP="2"  class="form-control"   value="100" name="pricefrom">
                                                  &nbsp; &nbsp;
                                           {{ trans('lang.to')}} <INPUT TYPE="NUMBER" MIN="0" MAX="10000" STEP="2"  class="form-control"  value="100"  name="priceto" >
                                      
                                            <div class="price-slider-wrapper">
                                                <div id="price-slider"></div>
                                            </div>

                                            <div class="filter-price-action">
                                              <button type="submit" class="btn btn-primary">Filter</button>
                                             
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="widget">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">{{ trans('lang.brands')}}</a>
                                </h3>

                                <div class="collapse show" id="widget-body-4">
                                    <div class="widget-body">
                                        <ul class="cat-list">
                                             @foreach($brands as $b)
                                             <li><a href="{{url('brand/'.$b->custom_url)}}">{{$b->name}}</a></li>
                                             @endforeach
                                        </ul>
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->
                        </div><!-- End .sidebar-wrapper -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-5"></div><!-- margin -->
        </main><!-- End .main -->

@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif
