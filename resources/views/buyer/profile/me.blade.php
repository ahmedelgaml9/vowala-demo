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
                        <li class="breadcrumb-item"><a href="{{url('')}}">{{ trans('lang.home')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.dashboard')}}</li>
                    </ol>
                </div><!-- End .container-fluid -->
            </nav>
                  @if (Session::has('done'))
                    <div  class=" alert alert-success" style="font-size: 18px;">
                        <strong> {{ trans('lang.done')}}  </strong>
                    </div>
                    @endif
            <div class="container mt-2">
                <div class="row">
                    <div class="col-lg-9 order-lg-last dashboard-content">
                        {!! Form::open(['action'=>['SiteController@editprofile',Auth::user()->id],'method'=>'put']) !!}
                            <div class="row">
                                <div class="col-sm-12">
                                    
                                            <div class="form-group required-field">
                                                <label for="acc-name">{{ trans('lang.name')}}</label>
                                                <input type="text" class="form-control" id="acc-name" name="name"  value="{{ Auth::user()->name}}" required>
                                              </div>
                                            
                                              <div class="form-group required-field">
                                                <label for="acc-name">{{ trans('lang.phone')}}</label>
                                                <input type="text" class="form-control"  name="phone"  value="{{ Auth::user()->phone}}" required>
                                              </div>
                                        </div>
                                    </div>

                                  <div class="form-group required-field">
                                    <label for="acc-email">{{ trans('lang.email')}}</label>
                                    <input type="email" class="form-control" id="acc-email" name="email"   value="{{ Auth::user()->email}}" required>
                                </div><!-- End .form-group -->

                                <div class="form-group required-field">
                                    <label for="acc-password">{{ trans('lang.password')}}</label>
                                    <input type="password" class="form-control" id="acc-password" name="password" required>
                                </div>

                                <div class="form-group required-field">
                                <label for="password-confirm" >{{ trans('lang.password')}}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                           
                              <div class="form-footer">
                                <div class="form-footer-right">
                                         <button type="submit" class="btn btn-primary">{{ trans('lang.save')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <aside class="sidebar col-lg-3">
                        <div class="widget widget-dashboard">
                            <h3 class="widget-title">{{ trans('lang.account')}}</h3>
                            <ul class="list">
                                <li><a href="{{url('profile')}}">{{ trans('lang.account')}}</a></li>
                                <li><a href="{{url('mywishlist')}}">{{ trans('lang.wlist')}}</a></li>
                                <li><a href="{{url('myorders')}}">{{ trans('lang.myorders')}} </a></li>
                                <li><a href="{{url('addressbook')}}">{{ trans('lang.addressbook')}}</a></li>


                            </ul>
                        </div><!-- End .widget -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-5"></div>
         </main>



@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif