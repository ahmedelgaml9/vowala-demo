
         <?php
              $sections = App\Section::where('active',1)->get();
              $countries= App\Country::all();
              $cities= App\Zone::all();
              $ourcats= App\Subcat::all();
              $data= App\Main::find(1);
              $lang =$data->setlang;
              $card = $_SESSION['cart'];
           ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      @if(isset($meta))
    <title>{{$meta['title']}}</title>
    <meta name="keywords" content="{{ $meta['meta_keyword'] }}" />
    <meta name="description" content="{{ $meta['meta_description'] }}">
    <meta name="author" content="{{ $meta['meta_auther'] }}">
       @else
    <title>{{ $main->page_title }}</title>
    <meta name="keywords" content="{{ $main->meta_keyword }}" />
    <meta name="description" content="{{ $main->meta_description }}">
    <meta name="author" content="{{ $main->meta_auther }}">
       @endif
    <link rel="icon" type="image/x-icon" href="{{ asset('adminstyle/assets/images/gallery/'.$main->favicon)}}">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/droid-arabic-kufi" type="text/css"/>
   <link rel="stylesheet" href="{{ asset('siteassets/demo-2/assets/css/bootstrap.min.css')}}">
    <link href="{{asset('admin-assets/assets/plugins/sweetalert/')}}/sweetalert.css" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <link rel="stylesheet" href="{{ asset('siteassets/demo-2/assets/css/style.min.css')}}">
</head>
<body>
    <div class="page-wrapper">
        <header class="header">
            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <a href="index.html" class="logo">
                            <img src="{{ asset('adminstyle/assets/images/gallery/'.$main->logo)}}" alt="Logo"style="height: 60px;">
                        </a>
                        

                        </div>
                    <div class="header-right">
                        <div class="row header-row header-row-top">
                            <div class="header-dropdown dropdown-expanded">
                                <a href="#">Links</a>
                                <div class="header-menu">
                                    <ul>
                                       @if(Auth::check())<li><a href="{{url('profile')}}">{{ trans('lang.profile')}}</a></li>@endif

                                       @if(Auth::check())<li><a href="{{url('mywishlist')}}">{{ trans('lang.wlist')}}</a></li>@endif
                                      <li><a href="{{url('contactus')}}">{{ trans('lang.contactus')}}</a></li>
                                        @if(!Auth::check()) <li> <a href="#"  data-toggle="modal" data-target="#loginModel">{{ trans('lang.login')}}
                                               @else
                                            <li>
                                              <a href="{{ url('logout')}}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                           {{ trans('lang.logout')}}
                                                </a>
        							 	<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display:none;">
        								    	{{ csrf_field() }}
        								</form>
        							 </li>
                                        @endif
                                    </ul>
                                </div><!-- End .header-menu -->
                            </div><!-- End .header-dropown -->
                             <div class="header-search">
                            <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                              {!! Form::open(['action'=>['SiteController@search'],'class'=>'search-area form-group
                                        search-area-white','method'=>'get']) !!}                               
                                <div class="header-search-wrapper">
                                    <input type="search" class="typeahead form-control" name="q" placeholder="{{ trans('lang.search')}}..." required>
                                    <div class="select-custom">
                                       <select id="cat" name="cat">
                                        <option value="">{{ trans('lang.allcategories')}}</option>
                                          @foreach($ourcats as $cat)
                                          <option value="{{$cat->id}}">{{$cat->name}}</option>
                                         @endforeach
                                    </select>
                                    </div>
                                    <button class="btn" type="submit"><i class="icon-magnifier"></i></button>
                                </div>
                            </form>
                        </div>
                        </div><!-- End .header-row -->

                        <div class="row header-row header-row-bottom">
                            <nav class="main-nav">
                                <ul class="menu sf-arrows">
                                      <li><a href="{{url('/')}}">{{trans('lang.home')}}</a></li>
                            
                                    @if(isset($sections))
                                    @foreach($sections as $new)
                                  <li class="megamenu-container">
                                       <a href="{{ url('categories').'/'.$new->custom_url }}"   @if(count($new->cats) > 0 )  class="sf-with-ul" @endif> @if ($lang == 0) {{
                                             substr($new->name_ar,0,50) }} @else {{
                                             substr($new->name,0,50) }}@endif</a>
                                          @if(count($new->cats) > 0 )
                                    <div class="megamenu">
                                         <div class="row">
                                            <div class="col-lg-9">
                                                <div class="row">
                                                     @foreach($new->cats as $cat)
                                                    <div class="col-lg-3"  style="margin-right:40px;">
                                                        <div class="menu-title">
                                                            <a href="{{url('category').'/'.$cat->custom_url }}">
                                                                @if ($lang == 0)  {{$cat->name_ar  }}   @else {{
                                                                  $cat->name }} @endif
                                                              </a>
                                                          </div>
                                                          <ul>
                                                               @foreach($cat->childrens as $c)
                                                            <li><a href="{{url('category').'/'.$c->custom_url  }}">
                                                                @if ($lang == 0)  {{ $c->name_ar  }}   @else {{
                                                                   $c->name }} @endif
                                                              </a></li>
                                                               @endforeach
                                                        </ul>
                                                    </div>
                                                     @endforeach
                                                </div>
                                            </div>
                               
                                         <div class="col-lg-3" style="height: 400px;">
                                               <div class="banner">
                                                   <a href="#">
                                                      <img src="{{asset('admin-assets/images/sections/'.$new->photo)}}"
                                                            alt="Menu banner">
                                                     </a>
                                                 </div>
                                            </div>
                                        </div>
                                  </div>
                                  @endif
                            </li>
                            @endforeach
                            @endif
                                </ul>
                            </nav>

                            <button class="mobile-menu-toggler" type="button">
                                <i class="icon-menu"></i>
                            </button>

                            
                            <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                              @if(!empty($card))<span class="cart-count"></span>@endif
                            </a>

                               <div class="dropdown-menu" >
                                  <div class="dropdownmenu-wrapper" id="smallcard">
                                 </div>
                            </div>
                        </div>
                           
                        </div><!-- End .header-row -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->