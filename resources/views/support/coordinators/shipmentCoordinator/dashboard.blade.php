<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title -->
        <title>Discovery |  Shipment Coordinator </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="{{ asset('admin-assets/assets/plugins/materialize/css/materialize.min.css')}}"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('admin-assets/assets/plugins/metrojs/MetroJs.min.css')}}" rel="stylesheet">
        <link href="{{ asset('admin-assets/assets/plugins/weather-icons-master/css/weather-icons.min.css')}}" rel="stylesheet">
        <!-- Theme Styles -->
        <link href="{{ asset('admin-assets/assets/css/alpha.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('admin-assets/assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="{{ asset('admin-assets/ckeditor/ckeditor.js')}}"></script>
        <link href="{{asset('admin-assets/assets/plugins/sweetalert/')}}/sweetalert.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .error
            {
                color: red;
            }
            .alert-success {
                background-color: #dff0d8;
                border-color: #d0e9c6;
                color: #3c763d;
            }
            .alert {
                padding: 1rem;
                margin-bottom: 1rem;
                border: 1px solid transparent;
                border-radius: .25rem;
            }
            .pagination li.active {
                background-color: #fff;
                color: #00acc1;
            }
        </style>
    </head>
    <body>
        <div class="loader-bg"></div>
        <div class="loader">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-teal lighten-1">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mn-content fixed-sidebar">
            <header class="mn-header navbar-fixed">
                <nav class="cyan darken-1">
                    <div class="nav-wrapper row">
                        <section class="material-design-hamburger navigation-toggle">
                            <a href="javascript:void(0)" data-activates="slide-out" class="button-collapse show-on-large material-design-hamburger__icon">
                                <span class="material-design-hamburger__layer"></span>
                            </a>
                        </section>
                        <div class="header-title col s3 m3">
                            <a href="{{ url('/shipmentCoordinator') }}"><span class="chapter-title">Discovery </span></a>
                        </div>
                        <!--                        <form class="left search col s6 hide-on-small-and-down">
                                                    <div class="input-field">
                                                        <input id="search" type="search" placeholder="Search" autocomplete="off">
                                                        <label for="search"><i class="material-icons search-icon">search</i></label>
                                                    </div>
                                                    <a href="javascript: void(0)" class="close-search"><i class="material-icons">close</i></a>
                                                </form>-->
                        <ul class="right col s9 m3 nav-right-menu">
<!--                            <li><a href="javascript:void(0)" data-activates="chat-sidebar" class="chat-button show-on-large"><i class="material-icons">more_vert</i></a></li>
                            <li class="hide-on-small-and-down"><a href="javascript:void(0)" data-activates="dropdown1" class="dropdown-button dropdown-right show-on-large"><i class="material-icons">notifications_none</i><span class="badge">4</span></a></li>
                            <li class="hide-on-med-and-up"><a href="javascript:void(0)" class="search-toggle"><i class="material-icons">search</i></a></li>-->
                        </ul>

                    </div>
                </nav>
            </header>

            <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper">
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-image">
                            <img src="{{ asset('admin-assets/images/users/'.Auth::user()->photo) }}" class="circle" alt="">
                        </div>
                        <div class="sidebar-profile-info">
                            <a href="javascript:void(0);" class="account-settings-link">
                                <p>{{ Auth::user()->name }}</p>
                                <span>{{ substr(Auth::user()->email,0,15) }}<i class="material-icons right">arrow_drop_down</i></span>
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-account-settings">
                        <ul>
                            <li class="no-padding">
                                <a class="waves-effect waves-grey"><i class="material-icons">mail_outline</i>Inbox</a>
                            </li>

                            <li class="no-padding">
                                  <a class="waves-effect waves-grey" href="{{ url('logout')}}"><i class="material-icons">exit_to_app</i>{{ trans('lang.signout')}}</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                      <li class="no-padding">
                          <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">my_location</i> Zones<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                          <div class="collapsible-body">
                              <ul>
                                  <li><a href="{{ url('shipmentCoordinator/continents')}}">continents</a></li>
                                  <li><a href="{{ url('shipmentCoordinator/countries')}}">Countries</a></li>
                                  <li><a href="{{ url('shipmentCoordinator/zones')}}">Zones</a></li>
                              </ul>
                          </div>
                      </li>
                      <li class="no-padding"><a class="waves-effect waves-grey active" href="{{ url('shipmentCoordinator/shipment') }}"><i class="material-icons">directions_boat
                              </i>Shipment Methods</a></li>
                      <li class="no-padding"><a class="waves-effect waves-grey active" href="{{ url('shipmentCoordinator/orders') }}"><i class="material-icons">directions_boat
                      </i>Orders</a></li>
                     </ul>
                    <div class="footer">
                        <p class="copyright"><a href="#!">Multi Mega</a> @2017</p>
                     </div>
                </div>
            </aside>
            <main class="mn-inner inner-active-sidebar">
                <div class="middle-content">

                    @yield('content')
                </div>
            </main>

        </div>
        <div class="left-sidebar-hover"></div>


        <!-- Javascripts -->
        <script src="{{ asset('admin-assets/assets/plugins/jquery/jquery-2.2.0.min.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/materialize/js/materialize.min.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/material-preloader/js/materialPreloader.min.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/jquery-blockui/jquery.blockui.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/counter-up-master/jquery.counterup.min.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/chart.js/chart.min.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/flot/jquery.flot.min.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/flot/jquery.flot.time.min.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/flot/jquery.flot.symbol.min.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/flot/jquery.flot.resize.min.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/curvedlines/curvedLines.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/plugins/peity/jquery.peity.min.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/js/alpha.min.js')}}"></script>
<!--        <script src="{{ asset('admin-assets/assets/js/pages/dashboard.js')}}"></script>-->
        <script src="{{ asset('admin-assets/assets/js/ajax.js')}}"></script>
        <script src="{{ asset('admin-assets/assets/js/pages/form_elements.js')}}"></script>
        <script src="{{asset('admin-assets/assets/plugins/sweetalert/')}}/sweetalert-dev.js"></script>
        <script src="{{asset('admin-assets/assets/plugins/sweetalert/')}}/sweetalert.min.js"></script>






    </body>
</html>
