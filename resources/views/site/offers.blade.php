@extends('site.template.index')
@section('content')
<div class="information-blocks">
    <div class="row">
        <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
            <div class="page-selector">

                <div class="shop-grid-controls">
<!--                    <div class="entry">
                        <div class="inline-text">Sorty by</div>
                        <div class="simple-drop-down">
                            <select>
                                <option>Position</option>
                                <option>Price</option>
                                <option>Category</option>
                                <option>Rating</option>
                                <option>Color</option>
                            </select>
                        </div>
                    </div>-->
                    <div class="entry">
                        <div class="view-button active grid"><i class="fa fa-th"></i></div>
                        <div class="view-button list"><i class="fa fa-list"></i></div>
                    </div>

                </div>
                <div class="clear"></div>
            </div>
            <div class="row shop-grid grid-view">
                @foreach($products as $pro)
                   @include('site.template.pro')
        
                @endforeach
            </div>
   
            <center>{!! $products->render() !!}</center>
            <div class="clear"></div>

        </div>
        <div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 blog-sidebar">
             <div class="information-blocks categories-border-wrapper">
                <div class="block-title size-3">{{ trans('lang.cats')}}</div>
                <div class="accordeon">
                    @foreach($sections as $s)
                    <div class="accordeon-title">  @if (Session::get('local') == 'ar') {{ substr($s->ar_name,0,50) }} @else {{ substr($s->name,0,50) }}  @endif</div>
                    <div class="accordeon-entry">
                        <div class="article-container style-1">
                            <ul>
                                @foreach($s->cats as $cat)
                                <li ><a @if (Session::get('local') == 'ar') href="{{ url('category').'/'.$cat->ar_custom_url }}" @else href="{{ url('category').'/'.$cat->custom_url }}" @endif >
                                         @if (Session::get('local') == 'ar') {{ substr($cat->ar_name,0,50)}} @else  {{ substr($cat->ar_name,0,50)}} @endif </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="clear"></div>
            <div class="information-blocks hidden-sm hidden-xs">
                <h3 class="block-title">{{ trans('lang.popular')}}</h3>
                <div class="sidebar-logos-row">
                    @foreach($popular as $pro)
                    <div class="entry"><a @if (Session::get('local') == 'ar') href="{{ url('product').'/'.$pro->ar_custom_url }}" @else href="{{ url('product').'/'.$pro->custom_url }}" @endif ><img src="{{asset('admin-assets/images/products/'.$pro->photo)}}" alt="@if (Session::get('local') == 'ar') {{ $pro->ar_photo_alt }} @else {{ $pro->photo_alt }} @endif"/></a></div>
                    @endforeach
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>

        </div>
    </div>
</div>
<div class="information-blocks">
    <div class="tabs-container">
        <div class="swiper-tabs tabs-switch">
            <div class="title">Products</div>
            <div class="list">
                <?php $n = 0; ?>
                @foreach($blocks as $b)
                @if(count($b->lastthree($b->id))>0)
                  <a class="block-title tab-switcher @if($n == 0 ) active @endif">@if (Session::get('local') == 'ar') {{ substr($b->ar_title,0,70) }} @else {{ substr($b->title,0,50) }} @endif</a>
                <?php $n++; ?>
                @endif
                @endforeach
                <div class="clear"></div>
            </div>
        </div>
        <div>

            @foreach($blocks as $b)
            @if(count($b->lastthree($b->id))>0)
            <div class="tabs-entry">
                <div class="products-swiper">
                    <div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="4" data-add-slides="4">
                        <div class="swiper-wrapper">
                            @foreach($b->products as $pro)
                            @include('site.template.quickview')
                            @endforeach
                        </div>
                        <div class="pagination"></div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach


        </div>
    </div>
</div>

@endsection
