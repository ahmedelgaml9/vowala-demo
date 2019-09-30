@extends('admin.dashboard')
@section('content')

                                     <div class="row">
                                        <section class="panel">
							        	<header class="panel-heading">
								         <h2 class="panel-title">Sizes</h2>
							     	   </header>
								    <div class="panel-body">
                                       
                                        @foreach($product->sizes  as $row)
                                        <tr id="trow_{{ $row->id }}">
                                            <td><strong>{{  $row->size }}</strong></td>
                                            <td>
                                                {!! Form::open(['action'=>['ProductController@delsize',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
                                                <button type="submit" class="btn btn-danger red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                           @endforeach
                       
									  </div>
						    	</section>
						    	 </div>
                            
                                     <div class="row">
                                        <section class="panel">
							        	<header class="panel-heading">
								         <h2 class="panel-title">Colors</h2>
							     	   </header>
								    <div class="panel-body">
                                       
                                        @foreach($product->colors  as $row)
                                        <tr id="trow_{{ $row->id }}">
                                            <td><strong>{{$row->color}}</strong></td>
                                            <td>
                                                {!! Form::open(['action'=>['ProductController@delcolor',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
                                                <button type="submit" class="btn btn-danger red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                           @endforeach
                       
									  </div>
						    	</section>
						    	 </div>

                                   <div class="row">
                                       
                                       <div class="col-sm-6">
                                        <section class="panel">
							        	<header class="panel-heading">
								         <h2 class="panel-title">Gallary</h2>
							     	   </header>
								    <div class="panel-body">
                                         @foreach($product->catalog->photoes as $ph)

                                            <td><img class="img-thumbnail" src="{{ asset('admin-assets/images/products/'.$ph->photo) }}"  style="height:300px; width:100%;" alt=""></td>
                                            <td>
                                                {!! Form::open(['action'=>['ProductController@delgal',$ph->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
                                                <button type="submit" class="btn btn-danger red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                           @endforeach
                                     </div>
									
						    	</section>
						    	 </div>
						    	 </div>
						    	 
						    	 
                      <div class="row">
  	                      <div class="tabs tabs-warning">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#popular3" data-toggle="tab"><i class="fa fa-star"></i>En </a>
									</li>
									<li>
								    	<a href="#recent3" data-toggle="tab">Ar</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="popular3" class="tab-pane active">
										<p>English</p>
                                        Name : <h2>{{$product->name}}</h2>
                                        Description :<h2>{{$product->short_description}}</h2>
                                        Full Description :<h2>{!! $product->desc !!} </h2>
                                     <section class="panel">
                                     	<header class="panel-heading">
                                		 <h2 class="panel-title">Main Photo</h2>
                                     </header>
                                  <div class="panel-body">
                                      <img src="{{ asset('admin-assets/images/products/'.$product->catalog->photo) }}" alt="" style="width:100%; height:300px;">
                                </div>
                                     
                                </section>
                               
                               
                                 
                	               <section class="panel">
							        	<header class="panel-heading">
								         <h2 class="panel-title">Gallary</h2>
							     	   </header>
								    <div class="panel-body">
									    <div class="owl-carousel owl-theme" data-plugin-carousel data-plugin-options='{ "dots": true, "autoplay": true, "autoplayTimeout": 3000, "loop": true, "margin": 10, "nav": false, "items": 1 }'>
									         @foreach($product->catalog->photoes as $ph)
										  <div class="item"><img class="img-thumbnail" src="{{ asset('admin-assets/images/products/'.$ph->photo) }}"  style="height:300px; width:100%;" alt=""></div>
									         @endforeach
									  </div>
							     	</div>
						    	</section>
                                        Weight :<h2>{{$product->wight}}</h2>
                                        Return policy :<h2>{!! $product->return_policy !!}</h2>
						
									</div>
									<div id="recent3" class="tab-pane">
										<p>Arabic</p>
                                        Name : <h2>{{$product->name_er}}</h2>
                                        Description :<h2>{{$product->short_description_ar}}</h2>
                                        Full Description :<h2>{!! $product->desc_ar !!} </h2>
                                    <section class="panel">
                                     	<header class="panel-heading">
                                		 <h2 class="panel-title">Main Photo</h2>
                                     </header>
                                  <div class="panel-body">
                                      <img src="{{ asset('admin-assets/images/products/'.$product->catalog->photo) }}" alt="" style="width:100%; height:300px;">
                                </div>
                                     
                                </section>
                               
                	               <section class="panel">
							        	<header class="panel-heading">
								         <h2 class="panel-title">Gallary</h2>
							     	   </header>
								    <div class="panel-body">
									    <div class="owl-carousel owl-theme" data-plugin-carousel data-plugin-options='{ "dots": true, "autoplay": true, "autoplayTimeout": 3000, "loop": true, "margin": 10, "nav": false, "items": 1 }'>
									         @foreach($product->catalog->photoes as $ph)
										  <div class="item"><img class="img-thumbnail" src="{{ asset('admin-assets/images/products/'.$ph->photo) }}"  style="height:300px; width:100%;" alt=""></div>
									         @endforeach
									  </div>
							     	</div>
						    	</section>
                                        Weight :<h2>{{$product->wight}}</h2>
                                        Return policy :<h2>{!! $product->return_policy_ar !!}</h2>
                                        
                                        
                                       
                                        
                                        
                                        
									</div>
								</div>
							</div>
						</div>
						
						
					
                    
                 @stop
