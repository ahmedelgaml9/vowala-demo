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
                        <li class="breadcrumb-item"><a href=""><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.blogs')}}</li>
                    </ol>
                </div>
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                       
                         @foreach($blogs as $blog)
                        <article class="entry">
                            <div class="entry-media">
                                <a href="{{ url('blog/'.$blog->custom_url)}}">
                                    <img src="{{asset('admin-assets/images/blogs/'.$blog->photo)}}" alt="Post">
                                </a>
                            </div><!-- End .entry-media -->

                            <div class="entry-body">
                                <div class="entry-date">
                                    <span class="day">{{ date('d',strtotime($blog->created_at))}} </span>
                                    <span class="month">{{ date('m',strtotime($blog->created_at))}} </span>
                                </div><!-- End .entry-date -->

                                <h2 class="entry-title">
                                    <a href=""> @if ($lang == 0)  {{$blog->title_ar }}  @else {{ $blog->title }}  @endif</a>
                                </h2>

                                <div class="entry-content">
                                    <p> @if ($lang == 0)  {!! $blog->desc_ar !!}  @else  {!! $blog->desc !!}  @endif</p>

                                  <a href="{{ url('blog/'.$blog->ustom_url)}}" class="read-more">{{ trans('lang.more')}} <i class="icon-angle-double-right"></i></a>
                                </div><!-- End .entry-content -->

                                <div class="entry-meta">
                                    <span><i class="icon-calendar"></i>{{ date('d-m-Y',strtotime($blog->created_at))}} </span>
                                    <span><i class="icon-user"></i>By <a href="#">Admin</a></span>
                                    <span><i class="icon-folder-open"></i>
                                        <a href="#">{{$blog->cat->name}} @if ($lang == 0)  {{$blog->cat->name_ar}}  @else {{$blog->cat->name}}  @endif</a>
                                    </span>
                                </div><!-- End .entry-meta -->
                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->
                            @endforeach
                        <nav class="toolbox toolbox-pagination">
                            <ul class="pagination">
                                {{$blogs->render() }}
                            </ul>
                        </nav>
                    </div><!-- End .col-lg-9 -->

                    <aside class="sidebar col-lg-3">
                        <div class="sidebar-wrapper">
                            <div class="widget widget-search">
                                {!! Form::open(['action'=>['SiteController@searchblog'],'class'=>'search-area form-group
                                        search-area-white','method'=>'get']) !!}         
                                    <input type="search" class="form-control" placeholder="{{ trans('lang.search')}}..." name="q" required>
                                    <button type="submit" class="search-submit" title="Search">
                                        <i class="icon-search"></i>
                                        <span class="sr-only"></span>
                                    </button>
                                </form>
                            </div><!-- End .widget -->

                            <div class="widget widget-categories">
                                <h4 class="widget-title">{{ trans('lang.blogcats')}}</h4>
                                <ul class="list">
                                @foreach($blogcats as $cat)
                             <li><a  href="#">{{$blog->cat->name}} @if ($lang == 0)  {{$cat->name_ar}}  @else {{$cat->name}}  @endif</a></li>
                                @endforeach
                                </ul>
                            </div>

                            <div class="widget">
                                <h4 class="widget-title">{{ trans('lang.recent')}}</h4>

                                <ul class="simple-entry-list">
                                            @foreach($recent_blogs as $b)                     
                                          <li>
                                        <div class="entry-media">
                                            <a href="">
                                                <img src="{{asset('admin-assets/images/blogs/'.$blog->photo)}}" alt="Post">
                                            </a>
                                        </div><!-- End .entry-media -->
                                        <div class="entry-info">
                                            <a href=""> @if ($lang == 0)  {{$blog->title_ar }}  @else {{ $blog->title }}  @endif</a>
                                            <div class="entry-meta">
                                             {{ date('d',strtotime($blog->created_at))}}
                                            </div><!-- End .entry-meta -->
                                        </div><!-- End .entry-info -->
                                    </li>
                                      @endforeach
                                </ul>
                            </div>
                        </div><!-- End .sidebar-wrapper -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-6"></div><!-- margin -->
        </main><!-- End .main -->


@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif