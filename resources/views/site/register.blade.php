@extends('site.template.index')
@section('content')
<div class="content-push">
    <div class="breadcrumb-box">
        <a href="{{ url('/') }}">{{ trans('lang.home') }}</a>
        <a href="">{{ trans('lang.signup') }}</a>
    </div>
    <div class="information-blocks">
        <div class="row">
            <div class="col-sm-12 information-entry">
                <div class="login-box">
                    <div class="article-container style-1">
                        <h3>{{ trans('lang.newcustomer') }}</h3>
                        <p>{{ trans('lang.welcome') }}.</p>
                    </div>
                    <div class="message" >
                    </div>
                    {!! Form::open(array('url' =>'register','method'=>'POST')) !!}
                    <div class="col-sm-6">
                        <label>{{ trans('lang.name') }}</label>    <span style="color:red">{{ $errors->first('name') }}</span>
                        <input class="simple-field" type="text" placeholder="Enter User  Name"  name="name"  value="{{ old('name') }}"/>
                    </div>
                    <div class="col-sm-6">
                        <label>{{ trans('lang.email') }}</label>    <span style="color:red">{{ $errors->first('email') }}</span>
                        <input class="simple-field" type="text" placeholder="Enter Email Address"  name="email"  value="{{ old('email') }}"/>
                    </div>

                    <div class="col-sm-6">
                        <label>{{ trans('lang.password') }}</label>    <span style="color:red">{{ $errors->first('password') }}</span>
                        <input class="simple-field" type="password" placeholder="Enter Password" name="password" />
                    </div>
                    <div class="col-sm-6">
                        <label>{{ trans('lang.password_r') }}</label>   
                        <input class="simple-field" type="password" placeholder="Enter Password" name="password_confirmation" />
                    </div>
                    <div class="col-sm-6">
                        <label>{{ trans('lang.phone') }}</label>    <span style="color:red">{{ $errors->first('phone') }}</span>
                        <input class="simple-field" type="text" placeholder="Enter   phone"  name="phone"  value="{{ old('phone') }}"/>
                    </div>
                    <div class="col-sm-6">
                        <label>{{ trans('lang.county') }}</label>    <span style="color:red">{{ $errors->first('country') }}</span>
                        <input class="simple-field" type="text" placeholder="Enter   Country"  name="country"  value="{{ old('country') }}"/>
                    </div>
                    <div class="col-sm-6">
                        <label>{{ trans('lang.city') }}</label>    <span style="color:red">{{ $errors->first('city') }}</span>
                        <input class="simple-field" type="text" placeholder="Enter   City"  name="city"  value="{{ old('city') }}"/>
                    </div>
                    <div class="col-sm-6">
                        <label>{{ trans('lang.address') }}</label>    <span style="color:red">{{ $errors->first('address') }}</span>
                        <input class="simple-field" type="text" placeholder="Enter   address"  name="address"  value="{{ old('address') }}"/>
                    </div>
                    <div style="padding-top: 20px;"></div>
                         <div class="button style-10">{{ trans('lang.signup') }}<input type="submit" value="" /></div>
                        <a class="button style-12" href="{{ url('user\login')}}">{{ trans('lang.signin') }}</a>

                     {!! Form::close() !!}   
                </div>
            </div>

        </div>
    </div>
    @endsection