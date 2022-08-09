@extends('auth.layout')

@section('title','Forgot Password')

@section('content')
    <div class="login-page">
        <div class="row">
            <div class="xs-hidden col-9 d-none d-sm-block d-sm-none left-area">
                <img src="https://miro.medium.com/max/2625/1*qAX1633WKgkCBjW-7BICCA.jpeg" alt="">

            </div>

            <div class="col-lg-3 col-sm-12  right-area">

                <div class="login-content">
                    <div class="brand-logo">
                        <a href="{{route('app.home')}}">
                            <img src="{{setting('app_icon')}}" alt="" style="width: 150px;">
                         </a>
                    </div>

                    <div class="login-form">
                        <form method="POST" action="{{ route('password.email') }}" class="mg-b-20">
                            @csrf
                            <h5 class="info-title">Reset Password Link</h5>

                            @if(Session::has('inactive'))
                              <!-- <p class="alert alert-info">{{ Session::get('message') }}</p> -->
                              <div class="alert alert-info" role="alert">
                                Your account is not activated ! Please activate your account. <a href="">Click here</a> to resend activation link
                              </div>
                            @endif

                            @if(Session::has('message'))
                              <!-- <p class="alert alert-info">{{ Session::get('message') }}</p> -->
                              <div class="alert alert-info" role="alert">
                                {{ Session::get('message') }}
                              </div>
                            @endif

                            <div class="form-group">
                                <label for="email">Email Address</label>
                               <input type="text" class="form-control" name="email" placeholder="yourname@yourdomain.com" required="" autofocus value="{{ old('email') }}"/>
                               @if ($errors->has('email'))
                               <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                               </span>
                               @endif
                            </div>





                            <div>
                               <button class="btn btn-primary btn-login submit btn-sm pull-left form-control" style="margin-top: 5px;">{{ __('Send Password Reset Link') }}</button>
                            </div>

                        </form>


                        <p class="info" style="text-align: center;margin-top:20px">A password reset link will be send to your registered email.</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
