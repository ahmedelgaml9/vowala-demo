@extends('site.template.index')
@section('content')
<?php
$main= App\Main::find(1);

?> 
 <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
                    </ol>
                  </div>
               </nav>

            <div class="container">
                <div class="heading mb-4">
                    <h2 class="title">Reset Password</h2>
                    <p>Please enter your email address below to receive a password reset link.</p>
                </div>

                  <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf
                    <div class="form-group required-field">
                        <label for="reset-email">Email</label>
                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    </div>
                       @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('email') }}</strong>
                      </span>
                      @endif
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">Reset My Password</button>
                    </div><!-- End .form-footer -->
                </form>
            </div><!-- End .container -->

            <div class="mb-10"></div><!-- margin -->
        </main><!-- End .main -->

@endsection
