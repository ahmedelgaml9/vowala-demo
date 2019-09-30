@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)
@include('site.template.header2')
@endif
<style>
      #map iframe{
        width:100%;
          
      }
    
</style>
 <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('')}}">{{ trans('lang.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.contactus') }}</li>
                    </ol>
                </div><!-- End .container-fluid -->
            </nav>
            <div class="container">
                <div id="map">
                    
                    {!!$main->map !!} 
                    
                </div><!-- End #map -->

                <div class="row">
                    <div class="col-md-8">
                        
                     @if (Session::has('message'))
                    <div  class=" alert alert-success" style="font-size: 18px;">
                        <strong>{{ trans('lang.done')}}</strong>  
                    </div>
                    @endif
                        <h2 class="light-title"> <strong>{{ trans('lang.writetous')}}</strong></h2>
                         {!! Form::open(array('action' =>'SiteController@submitcontactus')) !!}                        
                           <div class="form-group required-field">
                                <label for="contact-name">{{ trans('lang.name') }}</label>
                                <input type="text" class="form-control" id="contact-name" name="name" required>
                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label for="contact-email">{{ trans('lang.email') }}</label>
                                <input type="email" class="form-control" id="contact-email" name="email" required>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="contact-phone">{{ trans('lang.phone') }}</label>
                                <input type="tel" class="form-control" id="contact-phone" name="phone">
                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label for="contact-message">{{ trans('lang.message') }}</label>
                                <textarea cols="30" rows="1" id="contact-message" class="form-control" name="message" required></textarea>
                            </div><!-- End .form-group -->
                               <div class="g-recaptcha" data-sitekey="6Le_haQUAAAAAE00EYau1YYOq9yiUkNwLEUPd4g7"
                                id="captcha"  name="g-recaptcha-response"></div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary">{{trans('lang.submit')}}</button>
                            </div><!-- End .form-footer -->
                        </form>
                    </div><!-- End .col-md-8 -->

                    <div class="col-md-4">
                        <h2 class="light-title"> <strong>{{ trans('lang.contactus') }}</strong></h2>

                        <div class="contact-info">
                            <div>
                                <i class="icon-phone"></i>
                                <p><a href="tel:">{{ $main->phone }}</a></p>
                            </div>
                            <div>
                                <i class="icon-mobile"></i>
                               <p><a href="tel:">{{ $main->mobile }}</a></p>
                            </div>
                            <div>
                                <i class="icon-mail-alt"></i>
                                <p><a href="mailto:#">{{ $main->email }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="mb-8"></div>
     </main>
        

@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif