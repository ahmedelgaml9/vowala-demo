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
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                    </ol>
                </div><!-- End .container -->
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

                                    <a href="{{ url('blog/'.$blog->ustom_url)}}" class="read-more">Read More <i class="icon-angle-double-right"></i></a>
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