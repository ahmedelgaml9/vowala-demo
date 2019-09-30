<!doctype html>
<html class="fixed sidebar-left-collapsed">

<head>
	<!-- Basic -->
	<meta charset="UTF-8">

	<title></title>
	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet"
	 type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/bootstrap/css/bootstrap.css" />

	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/font-awesome/css/font-awesome.css" />

	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/owl.carousel/assets/owl.carousel.css" />
	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/owl.carousel/assets/owl.theme.default.css" />
	<link href="{{asset('admin-assets/assets/plugins/sweetalert/')}}/sweetalert.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" type="text/css" href="//www.fontstatic.com/f=cairo" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/stylesheets/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/stylesheets/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/stylesheets/theme-custom.css">

	<!-- Head Libs -->
	<script src="{{ asset('admin-assets')}}/assets/vendor/modernizr/modernizr.js"></script>
	<script type="text/javascript" src="{{ asset('admin-assets/ckeditor/ckeditor.js')}}"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
	<section class="body">

		<!-- start: header -->
		<header class="header">
			<div class="logo-container">

				<h3 class="logo">Mega Cart</h3>

				<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
				 data-fire-event="sidebar-left-opened">
					<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
				</div>
			</div>

			<!-- start: search & user box -->
			<div class="header-right">
				<span class="separator"></span>

				<div id="userbox" class="userbox">
					<a href="#" data-toggle="dropdown">
						<figure class="profile-picture">
							<img src="{{ asset('admin-assets')}}/assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle"
							 data-lock-picture="{{ asset('admin-assets')}}/assets/images/!logged-user.jpg" />
						</figure>
						<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
							<span class="name">{{ Auth::user()->name }}</span>
							<span class="role">{{ Auth::user()->email }}</span>
						</div>
						<i class="fa custom-caret"></i>
					</a>

					<div class="dropdown-menu">
						<ul class="list-unstyled">
							<li class="divider"></li>
							<li>
								<a href="{{ url('logout')}}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
									Logout
								</a>

								<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</header>

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<aside id="sidebar-left" class="sidebar-left">

				<div class="sidebar-header">
					<div class="sidebar-title">
						Navigation
					</div>
					<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html"
					 data-fire-event="sidebar-left-toggle">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>

				<div class="nano">
					<div class="nano-content">
						<nav id="menu" class="nav-main" role="navigation">
							<ul class="nav nav-main">
								<li class="nav-active">
									<a href="{{url('seller')}}">
										<i class="fa fa-home" aria-hidden="true"></i>
										<span>Dashboard</span>
									</a>
								</li>

								<li class="nav-parent">
									<a href="#">
										<i class="fa fa-tv" aria-hidden="true"></i>
										<span>Shop</span>
									</a>
									<ul class="nav nav-children">
										<li>
											<a href="{{url('seller/catalog')}}">
												<i class="fa fa-desktop" aria-hidden="true"></i>
												<span>Catalogs</span>
											</a>
										</li>
										
										<li>
											<a href="{{url('seller/ourproducts')}}">
												<i class="fa fa-tv" aria-hidden="true"></i>
												<span>Products</span>
											</a>
										</li>
										
										<li>
											<a href="{{url('seller/orders')}}">
												<i class="fa fa-tv" aria-hidden="true"></i>
												<span>orders</span>
											</a>
										</li>
										
									</ul>
								</li>

							</ul>
							</ul>
							</li>
							</li>
							</ul>
						</nav>
					</div>
				</div>
				<script>
					// Maintain Scroll Position
					if (typeof localStorage !== 'undefined') {
						if (localStorage.getItem('sidebar-left-position') !== null) {
							var initialPosition = localStorage.getItem('sidebar-left-position'),
								sidebarLeft = document.querySelector('#sidebar-left .nano-content');

							sidebarLeft.scrollTop = initialPosition;
						}
					}
				</script>

			</aside>
			<!-- end: sidebar -->

			<section role="main" class="content-body pb-none">


				<div class="section">

					@yield('content')

				</div>
				<aside id="sidebar-right" class="sidebar-right">
					<div class="nano">
						<div class="nano-content">
							<a href="#" class="mobile-close visible-xs">
								Collapse <i class="fa fa-chevron-right"></i>
							</a>

							<div class="sidebar-right-wrapper">

								<div class="sidebar-widget widget-calendar">
									<h6>Upcoming Tasks</h6>
									<div data-plugin-datepicker data-plugin-skin="dark"></div>

									<ul>
										<li>
											<time datetime="2016-04-19T00:00+00:00">04/19/2016</time>
											<span>Company Meeting</span>
										</li>
									</ul>
								</div>

								<div class="sidebar-widget widget-friends">
									<h6>Friends</h6>
									<ul>
										<li class="status-online">
											<figure class="profile-picture">
												<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
											</figure>
											<div class="profile-info">
												<span class="name"> </span>
												<span class="title">Hey, how are you?</span>
											</div>
										</li>
										<li class="status-online">
											<figure class="profile-picture">
												<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
											</figure>
											<div class="profile-info">
												<span class="name">Joseph Doe Junior</span>
												<span class="title">Hey, how are you?</span>
											</div>
										</li>
										<li class="status-offline">
											<figure class="profile-picture">
												<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
											</figure>
											<div class="profile-info">
												<span class="name">Joseph Doe Junior</span>
												<span class="title">Hey, how are you?</span>
											</div>
										</li>
										<li class="status-offline">
											<figure class="profile-picture">
												<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
											</figure>
											<div class="profile-info">
												<span class="name">Joseph Doe Junior</span>
												<span class="title">Hey, how are you?</span>
											</div>
										</li>
									</ul>
								</div>

							</div>
						</div>
					</div>
				</aside>
			</section>


			<script src="{{ asset('admin-assets')}}/assets/vendor/jquery/jquery.js"></script>
			<script src="{{ asset('admin-assets')}}/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
			<script src="{{ asset('admin-assets')}}/assets/vendor/bootstrap/js/bootstrap.js"></script>
			<script src="{{ asset('admin-assets')}}/assets/vendor/nanoscroller/nanoscroller.js"></script>
			<script src="{{ asset('admin-assets')}}/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
			<script src="{{ asset('admin-assets')}}/assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
			<script src="{{ asset('admin-assets')}}/assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>

			<!-- Specific Page Vendor -->
			<script src="{{ asset('admin-assets')}}/assets/vendor/jquery-appear/jquery-appear.js"></script>
			<script src="{{ asset('admin-assets')}}/assets/vendor/owl.carousel/owl.carousel.js"></script>
			<script src="{{ asset('admin-assets')}}/assets/vendor/isotope/isotope.js"></script>

			<!-- Theme Base, Components and Settings -->
			<script src="{{ asset('admin-assets')}}/assets/javascripts/theme.js"></script>

			<!-- Theme Custom -->
			<script src="{{ asset('admin-assets')}}/assets/javascripts/theme.custom.js"></script>

			<!-- Theme Initialization Files -->
			<script src="{{ asset('admin-assets')}}/assets/javascripts/theme.init.js"></script>

			<!-- Examples -->
			<script src="{{ asset('admin-assets')}}/assets/javascripts/dashboard/examples.landing.dashboard.js"></script>

			<script src="{{asset('admin-assets/assets/plugins/sweetalert/')}}/sweetalert-dev.js"></script>
			<script src="{{asset('admin-assets/assets/plugins/sweetalert/')}}/sweetalert.min.js"></script>

		<script>

      CKEDITOR.replace('aboutus', {
	   customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
      });
      CKEDITOR.replace('aboutus_ar',{
	   customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
      });
      CKEDITOR.replace('vision', {
	   customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
       });
		CKEDITOR.replace('vision_ar', {
			customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
		});
		CKEDITOR.replace('mission', {
			customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
		});
		CKEDITOR.replace('mission_ar', {
			customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
		});

		CKEDITOR.replace('return_policy', {
			customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
		});
		CKEDITOR.replace('return_policy_ar', {
			customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
		});

</script>
   
</body>




</html>