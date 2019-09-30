@inject('cat',App\Subcat) 
@inject('feature',App\Benefits) 

       <?php
       
           $cats = $cat::where('home',1)->get();
           $recent_viewed =  App\Product::select('name', 'name_ar', 'offer', 'id', 'price', 'custom_url', 'custom_url')->get()->take(3);
           $recent_products =  App\Product::select('name', 'name_ar', 'offer', 'id',  'price', 'custom_url', 'custom_url_ar')->get()->take(3);
           $popular =  App\Product::select('id', 'name', 'name_ar', 'offer', 'price', 'custom_url', 'custom_url_ar')->orderBy('viewers', 'desc')->get()->take(3);
           $sections = App\Section::all();
           $ourcats = $cat::all();
           $data= App\Main::find(1);
           $lang =$data->setlang;
           $features = $feature::all();

          ?>

  <footer class="footer">
       <div class="container">
         <div class="footer-top">
             <div class="row">
                <div class="col-md-9">
                    <div class="widget widget-newsletter">
                        <div class="row">
                             <div class="col-lg-6">
                               @if (Session::has('flash_message'))
                            <div  class=" alert alert-success" style="font-size: 18px;">
                                <strong></strong>{{ trans('lang.contactus_done')}}
                            </div>
                              @endif
                                <h4 class="widget-title">{{ trans('lang.newsletter')}}</h4>
                                <p>{{ trans('lang.oursubscribers') }}</p>
                                  </div>
                                <div class="col-lg-6">
                                      {!! Form::open(array('route' =>'subscribe','method'=>'post')) !!}
                                    <input type="email" class="form-control" placeholder="{{ trans('lang.email')}}"   name="email" required>
                                    <input type="submit" class="btn" value="{{ trans('lang.subscribe')}}">
                                </form>
                            </div><!-- End .col-lg-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .widget -->
                </div><!-- End .col-md-9 -->

                        <div class="col-md-3 widget-social">
                     <div class="social-icons">
                               @if(!empty($main->fb)) <a href="{{ $main->fb }}" class="social-icon" target="_blank"><i class="icon-facebook"></i></a> @endif
                               @if(!empty($main->tw))<a href="{{ $main->tw }}" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>@endif
                               @if(!empty($main->linkedin)) <a href="{{ $main->linkedin }}" class="social-icon" target="_blank"><i class="icon-linkedin"></i></a> @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">{{ trans('lang.contactus')}}</h4>
                        <ul class="contact-info">
                            <li>
                                <span class="contact-info-label">{{ trans('lang.address')}}:</span>@if($lang== 0){{ $main->ar_address}} @else {{ $main->address }} @endif
                            </li>
                            <li>
                                <span class="contact-info-label">{{ trans('lang.phone')}}</span>Toll Free <a href="tel:">{{ $main->phone }}</a>
                            </li>
                            <li>
                                <span class="contact-info-label">{{ trans('lang.email')}}:</span> <a href="mailto:mail@example.com"> {{ $main->email }}</a>
                            </li>
                        </ul>
                    </div><!-- End .widget -->
                </div><!-- End .col-lg-3 -->

                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="widget">
                                <h4 class="widget-title">{{ trans('lang.pages') }}</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="links">
                                            <li><a href="{{url('aboutus')}}">{{ trans('lang.aboutus') }}</a></li>
                                            <li><a href="{{url('contactus')}}">{{ trans('lang.contactus') }}</a></li>
                                            <li><a href="{{url('Cart')}}">{{ trans('lang.cart') }}</a></li>
                                        </ul>
                                   </div>
                               </div>
                            </div>
                         </div>
                                <div class="col-md-7">
                                    <div class="widget">
                                        <h4 class="widget-title">{{ trans('lang.features')}}</h4>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <ul class="links">
                                                   @foreach($features as $p)
                                               <li><a href="#">@if ($lang == 0) {{$p->name_ar}}  @else{{$p->name}}  @endif</a></li>
                                                   @endforeach
                                                 </ul>
                                             </div>
                                        </div>
                                    </div><!-- End .widget -->
                                </div><!-- End .col-md-7 -->
                           </div><!-- End .row -->

                    <div class="footer-bottom">
                        <p class="footer-copyright"> &copy; 2019. All Rights Reserved, Developed by <a href="http://www.multimega-eg.com/">MultiMega</a></p>
                         <ul class="contact-info">
                              <li>
                                <span class="contact-info-label">{{ trans('lang.workingdays')}}</span>
                                       {{$main->working_hours}}
                              </li>
                          </ul>
                        <img  src="{{ asset('adminstyle/assets/images/gallery/'.$main->iconsfooter)}}"    style="width:391px; height:30px;" alt="payment methods" class="footer-payments">
                    </div><!-- End .footer-bottom -->
                </div><!-- End .col-lg-9 -->
            </div><!-- End .row -->
        </div><!-- End .container-fluid -->
    </div><!-- End .footer-middle -->
</footer><!-- End .footer -->
</div><!-- End .page-wrapper -->

<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-cancel"></i></span>
       <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="active"><a href="{{url('/')}}">Home</a></li>
                  
                                    @if(isset($sections))
                                    @foreach($sections as $new)
                                    <li>
                                    <a href="{{ url('categories').'/'.$new->custom_url }}"   @if(count($new->cats) > 0 )  class="sf-with-ul" @endif> @if ($lang == 0) {{
                                             substr($new->name_ar,0,50) }} @else {{
                                             substr($new->name,0,50) }}@endif</a>
                                       <ul>
                                         @foreach($new->cats as $cat)
                                      <li> <a href="{{url('category').'/'.$cat->custom_url }}">
                                        @if ($lang == 0)  {{$cat->name_ar  }}   @else {{
                                             $cat->name }} @endif   </a>
                                             
                                         <ul>
                                              @foreach($cat->products as $c)
                                           <li><a href="{{url('category').'/'.$cat->custom_url }}">
                                            @if ($lang == 0)  {{ $c->name_ar  }}   @else {{
                                             $c->name }} @endif
                                            </a></li>
                                             @endforeach
                                         </ul>
                                        </li>
                                           @endforeach                                             
                                       
                                         </ul>
                                    </li>
                                     @endforeach
                                      @endif
                             </ul>
                          </nav>

                        <div class="social-icons">
                               @if(!empty($main->fb)) <a href="{{ $main->fb }}" class="social-icon" target="_blank"><i class="icon-facebook"></i></a> @endif
                               @if(!empty($main->tw))<a href="{{ $main->tw }}" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>@endif
                               @if(!empty($main->linkedin)) <a href="{{ $main->linkedin }}" class="social-icon" target="_blank"><i class="icon-linkedin"></i></a> @endif
                       </div>
                    </div><!-- End .mobile-menu-wrapper -->
                </div><!-- End .mobile-menu-container -->

     @if($main->type== 1)
   <div class="newsletter-popup mfp-hide" id="newsletter-popup-form" style="background-image: url({{ asset('siteassets')}}/assets/images/newsletter_popup_bg.jpg)">
      <div class="newsletter-popup-content">
          <img src="siteassets/assets/images/logo-black.png" alt="Logo" class="logo-newsletter">
          <h2>BE THE FIRST TO KNOW</h2>
            <p>Subscribe to  the newsletter to receive timely updates from your favorite products.</p>
        
            {!! Form::open(array('route' =>'subscribe','method'=>'post')) !!}
                
                         {{ csrf_field() }}    
                         
         <div class="input-group">
                <input type="email" class="form-control" id="newsletter-email" name="email" placeholder="Email address"
                    required>
                <input type="submit" class="btn" value="Go!">
            </div><!-- End .from-group -->
        </form>
        <div class="newsletter-subscribe">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1">
                    Don't show this popup again
                </label>
            </div>
        </div>
    </div><!-- End .newsletter-popup-content -->
</div><!-- End .newsletter-popup -->
@endif
<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

<!-- Plugins JS File -->
<script src="{{ asset('siteassets')}}/assets/js/jquery.min.js"></script>
<script src="{{ asset('siteassets')}}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('siteassets')}}/assets/js/plugins.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src="{{asset('admin-assets/assets/plugins/sweetalert/')}}/sweetalert-dev.js"></script>
<script src="{{asset('admin-assets/assets/plugins/sweetalert/')}}/sweetalert.min.js"></script>
<script src="{{ asset('siteassets')}}/assets/js/main.min.js"></script>
 <script src="{{ asset('siteassets')}}/assets/js/nouislider.min.js"></script>
<script src="{{ asset('admin-assets')}}/assets/vendor/modernizr/modernizr.js"></script>
        
@yield('scripts')

<script>
         $("#smallcard").load("{{ url('smallcartcontent') }}");
          $(".cart-count").load("{{ url('quantity') }}");
          $(".cart").load("{{ url('total') }}");
          $("#session").load("{{ url('getapi') }}");

                                     function AddToCartmore(id)
                                       {
                                         sizeid = $('#size').val();
                                           if (sizeid == null) { sizeid = 1;}
                                          colorid = $('#color').val();
                                           if (colorid == null) { colorid = 1;}
                                           qu= $('.horizontal-quantity').val();
                                            if (qu == null) { qu = 1;}  
                                            $.ajax({
                                             type: 'Get',
                                              url: "{{URL::to('addtocartmore')}}" + '/' + id,
                                                 data: "itemid=" + id + '&sizeid='+ sizeid +'&colorid=' + colorid + '&qu='+ qu,
                                                success: function (data) {
                                                if (data == "done")
                                                {
                                                $("#smallcard").load("{{ url('smallcartcontent') }}");
                                                return (swal(
                        {title: "Done", text: "Product has been added to Cart Succesfully",
                            showCancelButton: true, cancelButtonText: "Continue shopping!", confirmButtonText: "Check Out Now!", }
                , function () {
                    window.location.href = "{{url('/Cart')}}";
                }))
                                                     window.location.href = "https://vowalaa.com/demo/Cart";
                                                   $("#total").load("{{ url('total') }}");
                                                  } else
                                                   {
                                                       document.getElementById("done" + id).style.display = 'none';
                                                       document.getElementById("adderror" + id).style.display = 'block';
                                                       document.getElementById('adderrormessage' + id).innerHTML = "There are onle " + data + " From Product";
                                                   }
                                                  }
                                                 }
                                                 );
                                                }
                                        
                                        
                                           function AddToCart(id)
                                                {
                                                $.ajax({
                                                type: 'Get',
                                                        url: "{{URL::to('addtocart')}}" + '/' + id,
                                                        data: "itemid=" + id,
                                                        success: function (data) {
                                                        if (data == "done")
                                                        {
                                                          $("#smallcard").load("{{ url('smallcartcontent') }}");
                                                           return (swal(
                                                          {title: "Done", text: "Product has been added to Cart Succesfully",
                                                          showCancelButton: true, cancelButtonText: "Continue shopping!", confirmButtonText: "Check Out Now!", }
                                                          , function () {
                                                             window.location.href = "{{url('/Cart')}}";
                                                               }))
                                                          window.location.href = "https://vowalaa.com/demo/Cart";
                                                        
                                                        $("#total").load("{{ url('total') }}");
                                                        } else
                                                        {
                                                        document.getElementById("done" + id).style.display = 'none';
                                                        document.getElementById("adderror" + id).style.display = 'block';
                                                        document.getElementById('adderrormessage' + id).innerHTML = "There are onle " + data + " From Product";
                                                        }
                                                        }
                                                       }
                                                    );
                                                   }
                                                
                                        function Rate(product_id, value)
                                        {
                                        var rate = value;
                                        $.ajax({
                                        type: 'Post',
                                                url: "{{URL::to('addreview')}}",
                                                data:{_token: '{!! csrf_token() !!}', rate: rate, product_id: product_id },
                                                success: function (data) {
                                                if (data == "success")
                                                {

                                                }
                                                else
                                                {

                                                }
                                                }
                                        });
                                        }
                                          function Like(id, val)
                                          {
                                            $.ajax({
                                            type: 'Get',
                                                    url: "{{URL::to('addtowishlist')}}" + '/' + id,
                                                    data: "itemid=" + id,
                                                    success: function (data) {
                                                    if (data == "like"){
                                                    document.getElementById(val + id).innerHTML = "<i class='fa fa-heart'></i>"; }
                                                    else if (data == "unlike"){
                                                    document.getElementById(val + id).innerHTML = "<i class='fa fa-heart-o'></i>";
                                                    }
                                                   }  
                                                 }
                                                    );  }
                                          function AddToCompare(id)
                                          {
                                            $.ajax({
                                            type: 'Get',
                                                url: "{{URL::to('addtocompare')}}" + '/' + id,
                                                data: "itemid=" + id,
                                                success: function (data) {
                                               if (data == "done")
                                                {
                                                swal({
                                                title: "Success!",
                                                        text: "Product Added Succefuly.",
                                                        timer: 1000
                                                });
                                                } else
                                                {
                                                    
                                                }
                                               
                                                }
                                        }

                                        );  }
                                        
                                    function plus(id)
                                    {
                                        document.getElementById('qu' + id).innerHTML = parseInt(document.getElementById('qu' + id).innerHTML) + 1;
                                    }
                                    function minus(id)
                                    {
                                        if (parseInt(document.getElementById('qu' + id).innerHTML) > 1) {
                                            document.getElementById('qu' + id).innerHTML = parseInt(document.getElementById('qu' + id).innerHTML) - 1;
                                        }
                                    }

                                        
</script>
 
</body>
</html>
