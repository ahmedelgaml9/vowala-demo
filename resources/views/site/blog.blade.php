@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)
@include('site.template.header2')
@endif
@inject('blogs',App\Blog)

        <?php
              $data= App\Main::find(1);
              $lang =$data->setlang;
              $blog = $blogs::where('custom_url',$blog->custom_url)->first();
          ?>
          
        <meta property="og:url"       content="{{ url('/') }}" />
    	<meta property="og:type"      content="website" />
    	<meta property="og:title"     content="{{ $blog->title }}" />
    	<meta property="og:description"   content="{!! $blog->desc !!}" />
        <meta property="og:image"      content="{{ asset('admin-assets/images/blogs/'.$blog->photo)}}" />
        <meta property="fb:app_id" content="835595309920900"/>
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@nytimes">
        <meta name="twitter:title" content="{!! $blog->title!!}">
        <meta name="twitter:description" content="{!! $blog->desc !!}">
        <meta name="twitter:image" content="{{ asset('admin-assets/images/blogs/'.$blog->photo)}}">
        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.blog')}}</li>
                    </ol>
                </div>
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <article class="entry single">
                            <div class="entry-media">
                                <div class="entry-slider owl-carousel owl-theme owl-theme-light">
								      @foreach($blog->photoes as $photo)
                                    <img src="{{ asset('admin-assets/images/blogs/'.$photo->photo)}}" alt="Post">
                                      @endforeach
                                </div>
                            </div>

                            <div class="entry-body">
                                <div class="entry-date">
                                    <span class="day">{{ date('d',strtotime($blog->created_at))}}</span>
                                    <span class="month">{{ date('m',strtotime($blog->created_at))}}</span>
                                </div>

                                <h2 class="entry-title">
                                   @if ($lang == 0)  {{$blog->title_ar }}  @else {{ $blog->title }}  @endif
                                </h2>

                                <div class="entry-meta">
                                    <span><i class="icon-calendar"></i>{{ date('d-m-Y',strtotime($blog->created_at))}} </span>
                                    <span><i class="icon-user"></i>By <a href="#">Admin</a></span>
                                    <span><i class="icon-folder-open"></i>
                                        
                                        <a href="#">@if ($lang == 0)  {{$blog->cat->name_ar }}  @else {{ $blog->cat->name }}  @endif</a>
                                    </span>
                                 </div

                                 <div class="entry-content">
                                     <p>@if ($lang == 0)  {!!  $blog->blog_ar !!}  @else {!! $blog->blog !!}  @endif</p> 
                                 </div>

                                <div class="entry-share">
                                    <h3>
                                        <i class="icon-forward"></i>
                                        Share this post
                                    </h3>

                                    <div class="social-icons">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('blog/'.$blog->custom_url)}}&amp;src=sdkpreparse" class="social-icon social-facebook" target="_blank" title="Facebook">
                                            <i class="icon-facebook"></i>
                                        </a>
                                        <a href="#" class="social-icon social-twitter" target="_blank" title="Twitter">
                                            <i class="icon-twitter"></i>
                                        </a>
                                     <!-- <a href="#" class="social-icon social-linkedin" target="_blank" title="Linkedin">
                                            <i class="icon-linkedin"></i>
                                        </a> -->
                                        <a href="https://plus.google.com/share?url={{ url('blog/'.$blog->custom_url)}}" class="social-icon social-gplus" target="_blank" title="Google +">
                                            <i class="icon-gplus"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        

                        <div class="related-posts">
                            <h4 class="light-title"><strong>{{ trans('lang.related')}}</strong></h4>
                            <div class="owl-carousel owl-theme related-posts-carousel">
                                   @foreach($related as $b)                     
                                <article class="entry">
                                    <div class="entry-media">
                                        <a href="{{ url('blog/'.$b->custom_url)}}">
                                            <img src="{{asset('admin-assets/images/blogs/'.$blog->photo)}}" alt="Post">
                                        </a>
                                    </div>
                                    <div class="entry-body">
                                          <div class="entry-date">
                                            <span class="day">{{ date('d',strtotime($blog->created_at))}}</span>
                                            <span class="month">{{ date('m',strtotime($blog->created_at))}}</span>
                                          </div>

                                        <h2 class="entry-title">
                                            <a href="{{ url('blog/'.$b->custom_url)}}"> @if ($lang == 0)  {{$blog->title_ar }}  @else {{ $blog->title }}  @endif</a>
                                        </h2>
                                        <div class="entry-content">
                                            <p></p>

                                            <a href="{{ url('blog/'.$b->custom_url)}}" class="read-more">{{ trans('lang.more')}} <i class="icon-angle-double-right"></i></a>
                                        </div><!-- End .entry-content -->
                                     </div><!-- End .entry-body -->
                                </article>
                                    @endforeach
                             </div>
                         </div>
                     </div>
                 
                    <aside class="sidebar col-lg-3">
                        <div class="sidebar-wrapper">
                            <div class="widget widget-search">
                                <form role="search" method="get" class="search-form" action="#">
                                    <input type="search" class="form-control" placeholder="{{ trans('lang.search')}}..." name="s" required>
                                    <button type="submit" class="search-submit" title="Search">
                                        <i class="icon-search"></i>
                                        <span class="sr-only">Search</span>
                                    </button>
                                </form>
                            </div><!-- End .widget -->

                            <div class="widget widget-categories">
                                <h4 class="widget-title">{{ trans('lang.blogcats')}}</h4>
                                <ul class="list">
                                    
                                    @foreach($blogcats as $cat)
                                  <li><a  href="#">{{$blog->cat->name}} @if ($lang == 0)  {{$blog->cat->name_ar}}  @else {{$blog->cat->name}}  @endif</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="widget">
                                <h4 class="widget-title">{{ trans('lang.recent')}}</h4>
                                <ul class="simple-entry-list">
                                           @foreach($recent_blogs as $b)                     
                                          <li>
                                        <div class="entry-media">
                                            <a href="{{ url('blog/'.$b->custom_url)}}">
                                               <img src="{{asset('admin-assets/images/blogs/'.$blog->photo)}}" alt="Post">
                                            </a>
                                        </div><!-- End .entry-media -->
                                        <div class="entry-info">
                                            <a href="{{ url('blog/'.$b->custom_url)}}">   @if ($lang == 0)  {{$blog->title_ar }}  @else {{ $blog->title }}  @endif</a>
                                            <div class="entry-meta">
                                             {{ date('d',strtotime($blog->created_at))}}
                                            </div>
                                        </div>
                                    </li>
                                      @endforeach
                                </ul>
                            </div>

                        </div>
                    </aside>
                </div>
            </div>

            <div class="mb-6"></div>
        </main>

      

@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif