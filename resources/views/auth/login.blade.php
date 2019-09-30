

<?php
$countries= App\Country::all();
$cities= App\Zone::all();

$main= App\Main::find(1);

?>



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
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ trans('lang.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.login') }}</li>
            </ol>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="heading">
                    <h2 class="title">{{ trans('lang.login') }}</h2>
                </div>
                  {!! Form::open(array('url' =>'/login','method'=>'POST')) !!}

                <input type="email" class="form-control" placeholder="Email Address" name="email" required>
                <input type="password" class="form-control" placeholder="{{ trans('lang.password') }}" name="password"   required>
                  
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('lang.login') }}</button>
                    <a href="#" class="forget-pass"> {{ trans('lang.forget') }}</a>
                </div><!-- End .form-footer -->
                </form>
                            
                  <div class="social-login-wrapper">
                   
                    <div class="btn-group">
                        <a class="btn btn-social-login btn-md btn-gplus mb-1"  href="{{url('auth/google')}}"><i class="icon-gplus"></i><span>Google</span></a>
                        <a class="btn btn-social-login btn-md btn-facebook mb-1"  href="{{url('auth/facebook')}}" ><i class="icon-facebook"></i><span>Facebook</span></a>
                    </div>
                </div>
            </div>
  
            <div class="col-md-6">
                <div class="heading">
                    <h2 class="title">{{ trans('lang.createacount') }}</h2>
                     </div>
                     
                     {!! Form::open(array('url' =>'register','method'=>'POST')) !!}

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
                    <button type="submit" class="btn btn-primary">{{ trans('lang.createacount') }}</button>
                </div><!-- End .form-footer -->
                </form>
            </div><!-- End .col-md-6 -->
            
   
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
</main><!-- End .main -->




@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif