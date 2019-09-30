@extends('site.template.index')
@section('content')
<div class="information-blocks">
    <div class="row">
        <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
            @foreach($brands as $bran)
            <div class="col-sm-6 col-md-4 portfolio-container type-2">
                <div class="portfolio-entry">
                    <div class="image">
                        <img  src="{{ asset('admin-assets/images/brands/'.$bran->photo)}}" alt="{{ $bran->name}}"  style="height: 200px">
                        <div class="hover-layer">
                            <div class="info">
                                <div class="title">@if (Session::get('local') == 'ar') {{ $bran->ar_name}} @else {{ $bran->name}} @endif</div>
                                 <div class="actions">
                                     <a @if (Session::get('local') == 'ar') href="{{ url('brand').'/'.$bran->ar_custom_url }}" @else href="{{ url('brand').'/'.$bran->custom_url }}" @endif class="action-button"><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 blog-sidebar">
            <div class="sidebar-navigation">
                <div class="title">Product Categories<i class="fa fa-angle-down"></i></div>
                <div class="list">
                    @foreach($cats as $c)
                    <a class="entry"@if (Session::get('local') == 'ar') href="{{ url('category').'/'.$c->ar_custom_url  }}"  @else href="{{ url('category').'/'.$c->custom_url  }}" @endif><span><i class="fa fa-angle-right"></i>@if (Session::get('local') == 'ar') {{ $c->ar_name }} @else {{ $c->name }} @endif</span></a>
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
@endsection