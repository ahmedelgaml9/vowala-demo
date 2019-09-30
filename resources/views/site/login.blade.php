@extends('site.template.index')
@section('content')

<?php
$countries= App\Country::all();
$cities= App\Zone::all();

$data= App\Main::find(1);
$lang =$data->setlang;
 
?>

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ trans('lang.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.log') }}</li>
            </ol>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="heading">
                    <h2 class="title">Login</h2>
                    <p>If you have an account with us, please log in.</p>
                </div><!-- End .heading -->


                {!! Form::open(array('url' =>'/login','method'=>'POST')) !!}

                <input type="email" class="form-control" placeholder="Email Address" name="email" required>
                <input type="password" class="form-control" placeholder="{{ trans('lang.password') }}" name="password"
                    required>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">LOGIN</button>
                    <a href="#" class="forget-pass"> Forgot your password?</a>
                </div><!-- End .form-footer -->
                </form>
            </div><!-- End .col-md-6 -->

            <div class="col-md-6">
                <div class="heading">
                    <h2 class="title">Create An Account</h2>
                    <p>By creating an account with our store, you will be able to move through the checkout process
                        faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                </div><!-- End .heading -->

                {!! Form::open(array('url' =>'register','method'=>'POST')) !!}

                <input type="text" class="form-control" name="name" placeholder="{{ trans('lang.name') }}" required>
                <input type="text" class="form-control" name="f_name" placeholder="{{ trans('lang.fname') }}" required>
                <input type="text" class="form-control" name="l_name" placeholder="{{ trans('lang.lname') }}" required>
                <input type="hidden" class="form-control" name="permission" value="0">

                <h2 class=" temb-2">Login information</h2>

               
                <input type="email" class="form-control" name="email" placeholder="{{ trans('lang.email') }}" required>
                <input type="password" class="form-control" name="password" placeholder="{{ trans('lang.password') }}"
                    required>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password"
                    required>

                <input type="text" class="form-control" name="phone" placeholder="{{ trans('lang.phone')}}" required>
               <div class="form-group">
                  <label>Country</label>
                <div class="select-custom">
                  <select class="form-control"  name="country">
                        @foreach($countries as $country  )
                   <option value="{{$country->name}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                    </div>
                 </div>
                 
             
                    <div class="form-group">
                       <label> Cities</label>
                    <div class="select-custom">
                       <select class="form-control"  name="city">
                            @foreach($cities as $city)
                              <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                      </select>
                     </div>
                   </div>
                    
                    
                    
                <input type="text" class="form-control" name="address" placeholder="{{ trans('lang.address')}}"
                       required>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </div><!-- End .form-footer -->
                </form>
            </div><!-- End .col-md-6 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
</main><!-- End .main -->



@endsection