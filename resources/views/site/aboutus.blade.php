@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)
@include('site.template.header2')
@endif

<?php

$data= App\Main::find(1);
$lang =$data->setlang;
$features = App\Benefits::all();

?>
             <main class="main">
                <div class="banner banner-cat" style="background-image: url( {{ asset('adminstyle/assets/images/gallery/'.$main->aboutusphoto)}});">
             </div>
          
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('')}}">{{ trans('lang.home')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.aboutus')}}</li>
                    </ol>
                </div><!-- End .container-fluid  -->
            </nav>
              <div class="about-section">
                  <div class="container">
                    <h2 class="subtitle">{{ trans('lang.ourhistory')}}</h2>
                    <p>@if ($lang == 0) 
                                {!! nl2br($main->vision_ar) !!}
                                @else 
                                {!! nl2br($main->vision) !!}
                                @endif</p>
                 
                </div><!-- End .container -->
            </div><!-- End .about-section -->

            <div class="features-section">
                <div class="container">
                    <h2 class="subtitle">{{ trans('lang.why')}}</h2>
                    <div class="row">
                         @foreach($features as $p)
                        <div class="col-lg-4">
                            <div class="feature-box">
                                <i class="icon-{{$p->icon}}"></i>
                                <div class="feature-box-content">
                                    <h3>@if ($lang == 0)   {{$p->name_ar}}  @else{{$p->name}}  @endif</h3>
                                    <p>@if ($lang == 0)    {{$p->desc_ar}}  @else{{$p->desc}}  @endif</p>
                                </div><!-- End .feature-box-content -->
                            </div><!-- End .feature-box -->
                        </div><!-- End .col-lg-4 -->
                        @endforeach 
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .features-section -->
            </div><!-- End .about-section -->
        </main><!-- End .main -->


@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif
