  <?php
            
              $data= App\Main::find(1);
              $lang =$data->setlang;
              
           ?>
<!doctype html>
<html class="fixed sidebar-left-collapsed">

<head>
	<meta charset="UTF-8">

	<title></title>
	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet"
    	 type="text/css">
    	 

	     <link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/bootstrap/css/bootstrap.css" />
	     <link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/font-awesome/css/font-awesome.css" />
    	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/magnific-popup/magnific-popup.css" />
    	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
    	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/owl.carousel/assets/owl.carousel.css" />
    	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/owl.carousel/assets/owl.theme.default.css" />
    	<link rel="stylesheet" type="text/css" href="//www.fontstatic.com/f=cairo" />
        <link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/select2/css/select2.css" />
		<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
	    <link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/jquery-ui/jquery-ui.css" />
	    <link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/jquery-ui/jquery-ui.theme.css" />
        <link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/dropzone/basic.css" />
		<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/dropzone/dropzone.css" />
		<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/codemirror/theme/monokai.css" />
		<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/vendor/morris.js/morris.css" />
	     
	    
    	

            <!--
        	<link rel="stylesheet" href="{{ asset('admin-assets')}}/ar_assets/stylesheets/theme.css" />
        	<link rel="stylesheet" href="{{ asset('admin-assets')}}/ar_assets/stylesheets/skins/default.css" />
        	<link rel="stylesheet" href="{{ asset('admin-assets')}}/ar_assets/stylesheets/theme-custom.css">
                 -->

        
    	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/stylesheets/theme.css" />
    	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/stylesheets/skins/default.css" />
    	<link rel="stylesheet" href="{{ asset('admin-assets')}}/assets/stylesheets/theme-custom.css">

	   
	    <script src="{{ asset('admin-assets')}}/assets/vendor/modernizr/modernizr.js"></script>
     	<script type="text/javascript" src="{{ asset('admin-assets/ckeditor/ckeditor.js')}}"></script>

</head>

<body>
    
	<section class="body">
		<header class="header">
			<div class="logo-container">
					<a href="" class="logo">
						<img src="{{ asset('admin-assets')}}/logo.png" width="170" height="35" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
                <div class="header-right">
				

			 
			                	
					<ul class="notifications">
					
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-tasks"></i>
								<span class="badge">3</span>
							</a>

							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default">3</span>
									Offers
								</div>

								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-thumbs-down bg-danger"></i>
												</div>
												<span class="title">Server is Down!</span>
												<span class="message">Just now</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-lock bg-warning"></i>
												</div>
												<span class="title">User Locked</span>
												<span class="message">15 minutes ago</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-signal bg-success"></i>
												</div>
												<span class="title">Connection Restaured</span>
												<span class="message">10/10/2016</span>
											</a>
										</li>
									</ul>

									<hr />

									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>

	                     	<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-tasks"></i>
								<span class="badge">3</span>
							</a>

							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default">3</span>
									Offers
								</div>

								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-thumbs-down bg-danger"></i>
												</div>
												<span class="title">Server is Down!</span>
												<span class="message">Just now</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-lock bg-warning"></i>
												</div>
												<span class="title">User Locked</span>
												<span class="message">15 minutes ago</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-signal bg-success"></i>
												</div>
												<span class="title">Connection Restaured</span>
												<span class="message">10/10/2016</span>
											</a>
										</li>
									</ul>

									<hr />

									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>


			                <?php
			                
			                     $return_orders =App\Order::where('order_return', 1)->get();
			                     $neworders =App\Order::where('status',null)->get();
			                   ?>
			                  
                                <li>
                             <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                  <i class="fa fa-bell"></i>
                                 <span class="badge">{{count($return_orders)}}</span>
                             </a>
            
                            <div class="dropdown-menu notification-menu" >
                                <div class="notification-title">
                                    <span class="pull-right label label-default"></span>
                                 Return Orders
                                </div>
                                <div class="content" style="overflow-y:auto ;height:500px;" >
                            
                                            <h6 class="text-center">Return orders</h6>
                                                <hr>
                                                  <ul>
                                                      @foreach($return_orders as $r )
                                                    <li>
                                                    <a href="{{url('admin/orders/'.$r->id)}}" class="clearfix">
                                                        <div class="image ">
                                                            <i class="fa fa-envelope"></i>
                                                        </div>    
                                                            <span class="title">{{$r->id}}</span>
                                                            <span class="message red">{{ date('d M,Y',strtotime($r->created_at))}}
                                                            </span>
                                                    </a>
                                                </li>
                                                  @endforeach
                                          </ul>
                                      </hr>
                                </div>
                            </div>
                        </li>
                     
			          
                             <li>
                              <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                   <i class="fa fa-bell"></i>
                                 <span class="badge">{{count($neworders)}}</span>
                            </a>
            
                            <div class="dropdown-menu notification-menu" >
                                <div class="notification-title">
                                    <span class="pull-right label label-default"></span>
                                 New Orders
                                </div>
                                <div class="content" style="overflow-y:auto ;height:500px;" >
                            
                                            <h6 class="text-center">New orders</h6>
                                                <hr>
                                                  <ul>
                                                      @foreach($neworders as $r)
                                                    <li>
                                                    <a href="{{url('admin/orders/'.$r->id)}}" class="clearfix">
                                                        <div class="image ">
                                                            <i class="fa fa-envelope"></i>
                                                        </div>    
                                                            <span class="title">{{$r->id}}</span>
                                                            <span class="message red">{{ date('d M,Y',strtotime($r->created_at))}}
                                                            </span>
                                                    </a>
                                                </li>
                                                  @endforeach
                                          </ul>
                                      </hr>
                                </div>
                            </div>
                        </li>
                    </ul>    
			   
		  	           <span class="separator"> </span>
				          <div id="userbox" class="userbox">
			         		<a href="#" data-toggle="dropdown">
                            @if ($lang == 1)  ENGLISH @endif
                            @if ($lang == 0)    عربى   @endif
			         		  	
			     		    	<i class="fa custom-caret"></i>
			         		 </a>

						<div class="dropdown-menu">
						  <ul>
							<li class="divider"></li>
					 
                              <li><a href="{{ url('lang/en')}}">ENGLISH</a></li>
                              <li><a href="{{ url('lang/ar')}}">عربى</a></li>
                             </ul>  
                            </div>
                      </div>
		    	
			     <span class="separator"> </span>
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
						
					</div>
				<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
				            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
				        </div>
				</div>

				<div class="nano">
					<div class="nano-content">
						<nav id="menu" class="nav-main" role="navigation">
							<ul class="nav nav-main">
								<li class="nav-active">
									<a href="{{url('admin')}}">
										<i class="fa fa-line-chart" aria-hidden="true"></i>
										<span>{{trans('lang.dashboard')}}</span>
									</a>
								</li>
	                                
	                         	<li class="nav-active">
									<a href="{{url('admin/orders')}}">
										<i class="fa fa-dollar" aria-hidden="true"></i>
										<span>{{trans('lang.orders')}}</span>
									</a>
								</li>
								<li class="nav-parent">
									<a href="#">
										<i class="fa fa-tv" aria-hidden="true"></i>
										<span>{{trans('lang.products')}}</span>
									</a>
									<ul class="nav nav-children">
										<li>
											<a href="{{url('admin/sections')}}">
												<span>{{trans('lang.sections')}}</span>
											</a>
										</li>
									
										<li>
											<a href="{{url('admin/ourcatalog')}}">
												<span>{{trans('lang.catalogs')}}</span>
											</a>
										</li>

										<li>
											<a href="{{url('admin/brands')}}">
												<span>{{trans('lang.brands')}}</span>
											</a>
										</li>

										<li>
											<a href="{{url('admin/subcats')}}">
												<span>{{trans('lang.cats')}}</span>
											</a>

										</li>

										<li>
											<a href="{{url('admin/cartproducts')}}">
												<span>{{trans('lang.products')}} </span>
											</a>
									   	 </li>
										
										
										<li>
											<a href="{{url('admin/myproducts')}}">
												<span>{{trans('lang.myproducts')}}</span>

											  </a>
									   	  </li>
									   </ul>
							    	</li>


								<li class="nav-parent">

									<a href="#">
										<i class="fa fa-user" aria-hidden="true"></i>
												<span>{{trans('lang.customers')}}</span>

									</a>
									<ul class="nav nav-children">

										<li>
											<a href="{{url('admin/clientusers')}}">
												<span>{{trans('lang.customers')}}</span>
											</a>
										</li>
										
										<li>
										     <a href="{{url('admin/sellerusers')}}">
												<span>{{trans('lang.sellers')}}</span>
										 	 </a>
									    </li>
											<li>
											<a href="{{url('admin/managerusers')}}">
												<span>{{trans('lang.managers')}}</span>
											</a>
										</li>
										
									</ul>
								</li>
                                       <!--<li class="nav-parent">
				                        <a href="#">
				                            <i class="fa fa-list-alt" aria-hidden="true"></i>
				                            <span>{{trans('lang.marketing')}}</span>
				                        </a>
				                        <ul class="nav nav-children">
				                            <li>
				                                <a href="">
				                                    Campaigns
				                                </a>
				                            </li>
				                            <li>
				                                <a href="">
				                                    Affiliates
				                                </a>
				                            </li>
				                            <li>
				                                <a href="">
				                                    Coupons
				                                </a>
				                            </li>
				                            <li>
				                                <a href="">
				                                    Gift Vouchers
				                                </a>
				                            </li>
				                            <li>
				                                <a href="">
				                                    Integrations
				                                </a>
				                            </li>
				                        </ul>
				                    </li>-->
				                    
				                    		 <li class="nav-parent">
									 <a href="#">
									  	<i class="fa fa-cog" aria-hidden="true"></i>
									      <span> {{trans('lang.blog')}}</span>
									  </a>
									<ul class="nav nav-children">
									    
									 
                                        <li>
											<a href="{{url('admin/blogcat')}}">
												<span>{{trans('lang.blogcats')}}</span>
											</a>
										</li>
										<li>
											<a href="{{url('admin/blog')}}">
												<span>{{trans('lang.blog')}}</span>
											</a>
										</li></ul>
										</li>
			  							

								 <li class="nav-parent">
									 <a href="#">
									  	<i class="fa fa-cog" aria-hidden="true"></i>
									      <span>{{trans('lang.design')}}</span>
									  </a>
									<ul class="nav nav-children">
									    
									   <li>
										<a href="{{url('admin/blocks')}}">
									     	<i class="fa fa-tag" aria-hidden="true"></i>
											<span>{{trans('lang.blocks')}}</span>
										</a>
									 	</li>
									
										<li>
											<a href="{{url('admin/adds')}}">
												<span>{{trans('lang.adds')}}</span>
											</a>
										</li>
                                       
									
										<li>
								        <a href="{{url('admin/slider')}}">
										<span>{{trans('lang.slider')}}</span>
								    	</a>
								        </li>
								     	<li>
								        <a href="{{url('admin/banner_settings')}}">
										<span>{{trans('lang.baners')}}</span>
								    	</a>
								        </li>
								        	</ul>
							        
							        	</li>
							        	
							       <!-- 	<li>
    				                        <a href="">
    				                            <i class="fa fa-home" aria-hidden="true"></i>
    				                            <span>Analytics</span>
    				                        </a>
				                       </li>-->
							   	     

				        		    	  <li class="nav-parent">
				        		    	 <a  href="#">
									     <i class="fa fa-home" aria-hidden="true"></i>
				                            <span>{{trans('lang.settings')}}</span>
				                        </a>
				                        <ul class="nav nav-children">
															<li class="nav-parent">
								                        <a href="#">
								                            <i class="fa fa-align-left" aria-hidden="true"></i>
								                            <span>{{trans('lang.storesettings')}}</span>
								                        </a>
								                        <ul class="nav nav-children">
																					<li>
																				       <a href="{{url('admin/settings')}}">
																									{{trans('lang.general')}}
																						</a>
																					</li>
																				   <li>
                                            											<a href="{{url('admin/shipmentprices')}}">
                                            												<span>{{trans('lang.shippingprice')}}</span>
                                            											</a>
                                            										 </li>
                                            									
                                            										<li>
                                            											<a href="{{url('admin/payment')}}">
                                            												<span>{{trans('lang.payments')}} </span>
                                            											</a>
                                            										</li>
																					<li>
                                            											<a href="{{url('admin/shipments')}}">
                                            												<span>{{trans('lang.shippingmethods')}} </span>
                                            											</a>
                                            										</li>
																				
								                                             	</ul>
								                                             </li>
                        													<li class="nav-parent">
                        								                        <a href="#">
                        								                            <i class="fa fa-align-left" aria-hidden="true"></i>
                        								                            <span>	{{trans('lang.langauge')}}</span>
                        								                        </a>
                        								                        <ul class="nav nav-children">
																					<li>
																				       <a href="{{url('admin/settings')}}">

																								{{trans('lang.general')}}
																							</a>
																				     	</li>
																				    	<li>
																					    	 <a href="{{url('admin/currency')}}">
																							    	{{trans('lang.curr')}}
																						    	</a>
																					      </li>
																				    	<li>
																							<a href="">
																							{{trans('lang.langauge')}}		
																							</a>
																				    	</li>
																				 
		
                                    								                 <li>
                                                								       <a href="{{url('admin/seo_settings')}}">
                                                										 <span>{{trans('lang.seo')}}</span>
                                                								       </a>
                                                								      </li> 
                                    									    	      <li>
                                                								       <a href="{{url('admin/header_settings')}}">
                                                										<span>{{trans('lang.header')}}</span>
                                                								       </a>
                                                								       </li> 
                                    									     	  
                                    									     	       <li>
                                                								       <a href="{{url('admin/footer_settings')}}">
                                                										<span>{{trans('lang.footer')}}</span>
                                                								       </a>
                                                								       </li> 
                                                                                 
                                                                                 	  <li>
                                        											     <a href="{{url('admin/area')}}">
                                        											    	<span>{{trans('lang.area')}}</span>
                                        										    	  </a>
                                        									        	</li>
                                    									    	
                                    													   <li>						  
                                        										          <a href="{{url('admin/countries')}}">
                                        											          <span>{{trans('lang.country')}}</span>
                                        										 	        </a>
                                        									     	     </li>
                                        												
                                            										     <li>
                                            										         
                                            											 <a href="{{url('admin/zones')}}">
                                            											    	<span>{{trans('lang.zones')}}</span>
                                            										    	</a>
                                            									         </li>
        								                                      	         </ul>
        								                                             </li>
														
                        													<li class="nav-parent">
                        								                        <a href="#">
                        								                      <i class="fa fa-align-left" aria-hidden="true"></i>
                        								                            <span>{{trans('lang.advancedsetting')}}</span>
                        								                        </a>
                        								                        <ul class="nav nav-children">
        																					<li>
        																							<a href="">
        																							{{trans('lang.orders')}}
        																							</a>
        																					</li>
																					
																					
																					
																					<li>
																							<a href="">
																								{{trans('lang.orders')}}
																							</a>
																					</li>
																					
																					     <li>
																							<a href="">
																								{{trans('lang.products')}}   

																				    	</li>
                                                																					
                                                										<li>
                                                								         <a href="{{url('admin/contact_settings')}}">
                                                									     	<span>	{{trans('lang.contactus')}}</span>
                                                								    	 </a>
                                                								        </li>
                                                								      
                                                								    	<li>
                                                    								         <a href="{{url('admin/about_settings')}}">
                                                    										  <span>	{{trans('lang.aboutus')}}</span>
                                                    								    	 </a>
                                                								         </li>
                                                        							
                                                								      	 <li>
                                                        									  <a href="{{url('admin/size')}}">
                                                        									     <span>	{{trans('lang.size')}}</span>
                                                
                                                        									</a>
                                                        							    	</li>
                                                        								 <li>
                                                        									  <a href="{{url('admin/color')}}">
                                                        										<span>	{{trans('lang.colors')}}</span>
                                                        									</a>
                                                        							    	</li>
                                                        								
                                                								      	 <li>
                                                    								        <a href="{{url('admin/benefits')}}">
                                                    										  <span>{{trans('lang.features')}}</span>
                                                    								    	</a>
                                                								          </li>
                                                								      	<li>
                                                    								        <a href="{{url('admin/contacts')}}">
                                                    										<span>	{{trans('lang.contactus')}}</span>
                                                    								    	</a>
                                                								         </li>
                                                								      
                                                								       	<li>
                                                    								        <a href="{{url('admin/subscribers')}}">
                                                    										<span>{{trans('lang.subscribers')}}</span>
                                                    								    	</a>
                                                								          </li>
																				
																				
																				
																				
																				
								                       	</ul>
								                    </li>
				                          </ul>
				                       </li>
								 	  
						          </ul>
						    </li>
						</li>
					</ul>
				 </nav>
		    </div>
	  	</div>
	  	
	  	
				<script>
					if (typeof localStorage !== 'undefined') {
						if (localStorage.getItem('sidebar-left-position') !== null) {
							var initialPosition = localStorage.getItem('sidebar-left-position'),
								sidebarLeft = document.querySelector('#sidebar-left .nano-content');
						      	sidebarLeft.scrollTop = initialPosition;
						}
					}
					
					   
				    	 
	                </script>
	                
                               	
			</aside>

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
               <script src="{{ asset('admin-assets')}}/assets/vendor/jquery-ui/jquery-ui.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/select2/js/select2.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/bootstrap-timepicker/bootstrap-timepicker.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/fuelux/js/spinner.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/dropzone/dropzone.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/bootstrap-markdown/js/markdown.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/codemirror/lib/codemirror.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/codemirror/addon/selection/active-line.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/codemirror/mode/javascript/javascript.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/codemirror/mode/xml/xml.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/codemirror/mode/css/css.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/summernote/summernote.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
        		<script src="{{ asset('admin-assets')}}/assets/vendor/ios7-switch/ios7-switch.js"></script>
			 <script src="{{ asset('admin-assets')}}/assets/vendor/jquery-appear/jquery-appear.js"></script>
			 <script src="{{ asset('admin-assets')}}/assets/vendor/owl.carousel/owl.carousel.js"></script>
			 <script src="{{ asset('admin-assets')}}/assets/vendor/isotope/isotope.js"></script> 
		   	  <script src="{{ asset('admin-assets')}}/assets/javascripts/theme.js"></script>
			  <script src="{{ asset('admin-assets')}}/assets/javascripts/theme.custom.js"></script>
              <script src="{{ asset('admin-assets')}}/assets/javascripts/theme.init.js"></script>

		     
		     	<script src="{{ asset('admin-assets')}}/assets/javascripts/dashboard/examples.landing.dashboard.js"></script>

			         @yield('script')
			         
			         
			      	
		<script>

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