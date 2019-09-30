@extends('site.template.index')
@section('content')
<div class="content-push">
    <div class="breadcrumb-box">
        <a href="{{ url('/') }}">{{ trans('lang.home') }}</a>
        <a href="{{ url('mywishlist') }}">{{ trans('lang.account') }}</a>
        <a >{{ trans('lang.editprofile') }}</a>
    </div>
    <div class="information-blocks">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3">
                {!! Form::open(array('action' =>'Site\AjaxController@updateProfile', 'method'=>'PUT','class'=>'ajax-form-request')) !!}
                        <div class="message-box message-success" id="messagebox" style="display: none">
                            <div class="message-icon"><i class="fa fa-check"></i></div>
                            <div class="message-text message"></div>
                            <div class="message-close"><i class="fa fa-times"></i></div>
                        </div>
                        <div class="login-box">
                            <div class="col-md-6">
                                <label>{{ trans('lang.yourName') }}</label>
                                <input class="simple-field" type="text" name="name" placeholder="Enter Email Address" value="{{ Auth::user()->name }}" />
                            </div>
                            <div class="col-md-6">
                                <label>{{ trans('lang.yourEmail') }}</label>
                                <input class="simple-field" type="email" value="{{ Auth::user()->email }}" disabled=""/>
                            </div>
                            <div class="col-md-6">
                                <label>{{ trans('lang.yourBirthday') }}</label>
                                <input class="simple-field" type="text" name="birthdate" placeholder="Enter Birth Date" value="{{ Auth::user()->birthdate }}" id="datepicker" />
                            </div>
                            <div class="col-md-6">
                                <label>{{ trans('lang.yourPhone') }}</label>
                                <input pattern=".{11,11}" title="{{ trans('lang.phoneRequired') }}"  class="simple-field" type="text" name="phone" placeholder="Enter Phone" value="{{ Auth::user()->phone }}" required="required"/>
                            </div>
                            <div class="col-md-6">
                                <label>{{ trans('lang.yourCountry') }}</label>
                                <div class="simple-drop-down simple-field size-1">
                                    <select name="country">
                                        @foreach($countries as $c)
                                        <option value="{{ $c->id }}" name="{{ $c->id }}" @if($c->id== Auth::user()->country) selected @endif>@if (Session::get('local') == 'ar') {{ $c->ar_name}} @else {{ $c->name }} @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- city -->
                                    <div class="form-group">
                                    <label>{{ trans('lang.city') }}</label>
                                    <span style="color: red">{{ $errors->first('city') }}</span>
                                        <select name="city" class="simple-field form-control">
                                            @foreach($city as $c)
                                                <option value="{{ $c->id }}" @if($c->id ==  Auth::user()->city ) selected @endif  >
                                                    @if (Session::get('local') == 'ar') {{ $c->ar_name}} @else {{ $c->name }} @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                <!--  -->
                            </div>
                            <div class="col-md-6">
                                <label>{{ trans('lang.yourAddress') }}</label>
                                <input class="simple-field" type="text" name="address" placeholder="Enter Your Address" value="{{ Auth::user()->address }}" />
                            </div>
                            <div class="col-md-6">
                                <label>{{ trans('lang.yourGender') }}</label>
                                <p class="simple-field">
                                    <label class="checkbox-entry radio" style="display:inline">
                                        <input type="radio" name="gender" value="Male" 
                                            @if(Auth::user()->gender == "Male" ) 
                                                checked="" 
                                            @endif> 
                                        <span class="check"></span> <b> {{ trans('lang.Male') }}   </b>
                                    </label>
                                    <label class="checkbox-entry radio" style="display:inline">
                                        <input type="radio" name="gender" value="Female" 
                                            @if(Auth::user()->gender == "Female" ) 
                                                checked="" 
                                            @endif> 
                                                <span class="check"></span>
                                                <b> {{ trans('lang.Female') }}  </b>
                                    </label>
                                </p>
                            </div>
                           
                            
                        </div>
                        <br>
                        <div class="col-md-12">
                                <div class="button style-10">{{ trans('lang.update') }}<input type="submit" value="" /></div>
                        </div>
                 {!! Form::open()!!}
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
