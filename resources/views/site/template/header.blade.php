
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

    <link rel="stylesheet" href="{{ asset('siteassets/assets/css/bootstrap.min.css')}}">
    <link href="{{asset('admin-assets/assets/plugins/sweetalert/')}}/sweetalert.css" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <link rel="stylesheet" href="{{ asset('siteassets/assets/css/style.min.css')}}">
      @if($lang== 0)
    <link rel="stylesheet" href="{{ asset('siteassets/rtl-assets/css/bootstrap.min.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <link rel="stylesheet" href="{{ asset('siteassets/rtl-assets/css/style.min.css')}}">
        @endif
    <script src='https://www.google.com/recaptcha/api.js?render=6LdfSasUAAAAAKH6Yl4FRdu1WVp1hJJrEXrNaG2J'></script
     <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <div class="page-wrapper">
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-left header-dropdowns">
                        <div class="header-dropdown">
                                     @if ($lang == 1)  <a href="{{ url('lang/en')}}"><img src="{{asset('siteassets/assets/images/flags/en.png')}}" alt="England flag">ENGLISH</a>@endif
                                     @if ($lang == 0) <a href="{{ url('lang/ar')}}"><img src="{{asset('siteassets/assets/images/flags/egy.jpg')}}" alt="France flag">عربى</a>@endif
                          
                            <div class="header-menu">
                                 <ul>
                                   <li><a href="{{ url('lang/en')}}"><img src="{{asset('siteassets/assets/images/flags/en.png')}}" alt="England flag">ENGLISH</a></li>
                                   <li><a href="{{ url('lang/ar')}}"><img src="{{asset('siteassets/assets/images/flags/egy.jpg')}}" alt="France flag">عربى</a></li>
                               </ul>
                            </div>
                        </div>
                    </div>

                    <div class="header-right">
                        <p class="welcome-msg"> @if($lang ==0 ){{$main->welcome_ar }}  @else {{$main->welcome }}  @endif </p>
                        <div class="header-dropdown dropdown-expanded">
                            <a href="#">Login</a>
                            <div class="header-menu">
                                <ul>
                                @if(Auth::check())<li><a href="{{url('profile')}}">{{ trans('lang.profile')}}</a></li>@endif
                                @if(Auth::check())<li><a href="{{url('mywishlist')}}">{{ trans('lang.wlist')}}</a></li>@endif
                                    <li><a href="{{url('blogs')}}">{{ trans('lang.blog')}}</a></li>
                                    <li><a href="{{url('contactus')}}">{{ trans('lang.contactus')}}</a>
                                    </li>
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
                            </div>
                        </div>
                    </div>
                </div>
               </div>

            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <a href="{{url('')}}" class="logo">
                            <img src="{{ asset('adminstyle/assets/images/gallery/'.$main->logo)}}" alt="Logo"style="height: 60px;">
                        </a>
                    </div>
                    <div class="header-center">
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
                    </div>

                    <div class="header-right">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>
                        <div class="header-contact">
                            <span>{{ trans('lang.callus')}}</span>
                            <a href="tel:{{$main->phone}}"><strong>{{$main->phone}}</strong></a>
                        </div>

                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                              @if(!empty($card))<span class="cart-count"></span>@endif
                            </a>

                               <div class="dropdown-menu" >
                                  <div class="dropdownmenu-wrapper" id="smallcard">
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                        <div class="modal fade" id="loginModel" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                
                          <div class="modal-body">
                             <div class="row">
                               <div class="col-md-6">
                                 <h3 class="title mb-2">{{ trans('lang.profile') }}</h3>
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                    <input type="email" class="form-control" name="email" placeholder="{{ trans('lang.email') }}" required>
                    <input type="password" class="form-control" name="password" placeholder="{{ trans('lang.password') }}"
                          required>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                         {{ trans('lang.remember') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   {{ trans('lang.login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                  {{ trans('lang.forget') }}
                                </a>
                            </div>
                        </div>
                    </form>
                    
                 <div class="social-login-wrapper">
                    <div class="btn-group">
                        <a class="btn btn-social-login btn-md btn-gplus mb-1" href="{{url('auth/google')}}"><i class="icon-gplus"></i><span>Google</span></a>
                        <a class="btn btn-social-login btn-md btn-facebook mb-1" href="{{url('auth/facebook')}}" ><i class="icon-facebook"></i><span>Facebook</span></a>
                    </div>
                </div>
              </div>
 
            <div class="col-md-6"
                <h3 class="title mb-2">{{ trans('lang.register') }}</h3>
                 {!! Form::open(array('url' =>'register','method'=>'POST')) !!}
                     @csrf
                <input type="text" class="form-control" name="name" placeholder="{{ trans('lang.name') }}">
                   @if($errors->has('name'))
                  <label class="alert alert-danger nopaddinng">{{ $errors->first('name') }}</label>
                  @endif
                <input type="hidden" class="form-control" name="permission" value="0">
                      
                <input type="email" class="form-control" name="email" placeholder="{{ trans('lang.email') }}">
                   @if($errors->has('email'))
                       <label class="alert alert-danger nopaddinng">{{ $errors->first('email') }}</label>
                   @endif
                <input type="password" class="form-control" name="password" placeholder="{{ trans('lang.password') }}">
                   @if($errors->has('password'))
                  <label class="alert alert-danger nopaddinng">{{ $errors->first('password') }}</label>
                  @endif
                <input type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('lang.password_r') }}">
                      @if($errors->has('password_confirmation'))
                   <label class="alert alert-danger nopaddinng">{{ $errors->first('password_confirmation') }}</label>
                     @endif
               <div class="g-recaptcha" data-sitekey="6LdfSasUAAAAAPoPhwvlZiPVFokTpK6kQHeHMkoV"
                		 id="captcha"  name="g-recaptcha-response"></div>
                     @if($errors->has('g-recaptcha-response'))
                       <label class="alert alert-danger nopaddinng">{{ $errors->first('g-recaptcha-response') }}</label>
                     @endif   
                    <input type="text" class="form-control" name="phone" placeholder="{{ trans('lang.phone')}}" >
                      @if($errors->has('phone'))
                        <label class="alert alert-danger nopaddinng">{{ $errors->first('phone') }}</label>
                      @endif 
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-md">{{ trans('lang.register') }}</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
   </div>
 </div>

            <div class="header-bottom sticky-header">
                <div class="container">
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
                </div><!-- End .header-bottom -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->
      
                    
            @section('scripts')
    
    <script type="text/javascript">
        var path = "{{ route('searchajax') }}";
        $('input.typeahead').typeahead({
            source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            }
        });
    </script>
          @endsection    
           
            