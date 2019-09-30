@extends('site.template.index')
@section('content')
<div class="content-push">
    <div class="breadcrumb-box">
          <a href="{{ url('/') }}">{{ trans('lang.home') }}</a>
        <a href="{{ url('password') }}">{{ trans('lang.account') }}</a>
        <a >{{ trans('lang.mypassword') }}</a>
    </div>
    <div class="information-blocks">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3">

                <div class="login-box">
                    {!! Form::open(array('action' =>'Site\AjaxController@updatepassword','method'=>'POST','class'=>'ajax-form-request')) !!}
                    <div class="message-box message-success" id="messagebox" style="display: none">
                        <div class="message-icon"><i class="fa fa-check"></i></div>
                        <div class="message-text message"></div>
                        <div class="message-close"><i class="fa fa-times"></i></div>
                    </div>
                    <label>Current Password</label>
                    <input class="simple-field" type="password" name="oldpassword" placeholder="Enter Your Password" value="" />
                    <label>New Password</label>
                    <input class="simple-field" type="password" name="password" placeholder="Enter New Password" value="" />
                    <label>Password Confirmation</label>
                    <input class="simple-field" type="password" name="password_confirmation" placeholder="Enter New Password Again" value="" />
                    <div class="button style-10">Change Password<input type="submit" value="" /></div>
                </div>
                </form>
            </div>
            <div class="col-sm-3 col-sm-pull-9 blog-sidebar">
                <div class="information-blocks">
                    <div class="categories-list account-links">
                        <div class="block-title size-3">{{ trans('lang.account') }}</div>
                        <ul>
                                                     @include('site.template.profileheader')

                        </ul>
                    </div>
                    <div class="article-container">
                     </div>
                </div>
            </div>
        </div>
    </div>

  @include('site.template.featured')           

</div>

@endsection
