@extends('site.template.index')
@section('content')

<?php
$data= App\Main::find(1);
$lang =$data->setlang;
 
?>
     <main  class="main">
                <div class="banner-content container">
                    <h3 class="banner-subtitle">check out over <strong>200+</strong></h3>
                    <h1 class="banner-title">INCREDIBLE deals</h1>

                </div><!-- End .banner-content -->
            </div><!-- End .banner -->
            
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{ trans('lang.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">@if ($lang == 0){{$cat ->name_ar }} @else {{ $cat->name }} @endif</a></li>
                    </ol>
                </div><!-- End .container-fluid  -->
            </nav>

            <div class="container">
                <div class="row row-sm">
                  @foreach($cat->cats  as $p)
                    <div class="col-6 col-md-4 col-xl-5col">
                        <div class="product">
                            <figure class="product-image-container">
                                <a @if ($lang == 0) href="{{ url('category').'/'.$p->ar_custom_url }}"@else href="{{ url('category').'/'.$p->custom_url }}" @endif  class="product-image">
                                    <img src="{{asset('admin-assets/images/cats/'.$p->photo)}}" style="height:300px;"  alt="product">
                                </a>
                            </figure>
                            <div class="product-details">
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <h2 class="product-title">
                                    <a href="">@if ($lang == 0) {{$p ->name_ar }} @else {{ $p->name }} @endif</a>
                                </h2>
                             
                                </div>
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                    </div><!-- End .col-md-4 -->

                      @endforeach
                <nav class="toolbox toolbox-pagination">
                    <div class="toolbox-item toolbox-show">
                        
                    </div>
                </nav>
            </div><!-- End .container-fluid -->
        </main><!-- End .main -->



@endsection

