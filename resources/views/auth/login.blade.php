@extends('auth.layout')

@section('title','Login')

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
                        <form method="POST" action="{{ route('login') }}" class="mg-b-20">
                            @csrf
                            <h5 class="info-title">Sign in to your account</h5>

                            @if(Session::has('inactive'))
                              <!-- <p class="alert alert-info">{{ Session::get('message') }}</p> -->
                              <div class="alert alert-info" role="alert">
                                Your account is not activated ! Please check your email for activation link. <a href="">Click here</a> to resend activation link
                              </div>
                            @endif

                            @if(Session::has('register_success'))
                              <!-- <p class="alert alert-info">{{ Session::get('message') }}</p> -->
                              <div class="alert alert-info" role="alert">
                                Account created successfully, please check your mail to activate your account.
                              </div>
                            @endif

                            @if(Session::has('verified'))
                              <!-- <p class="alert alert-info">{{ Session::get('message') }}</p> -->
                              <div class="alert alert-info" role="alert">
                                Your account is verified successfully, please login to continue
                              </div>
                            @endif

                            @if(Session::has('invalid_token'))
                                <!-- <p class="alert alert-info">{{ Session::get('message') }}</p> -->
                                <div class="alert alert-info" role="alert">
                                    Invalid activation link
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
                               <input type="text" class="form-control" name="email" placeholder="Email" required="" autofocus value="{{ old('email') }}"/>
                               @if ($errors->has('email'))
                               <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                               </span>
                               @endif
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                               <input type="password" class="form-control" name="password" placeholder="Enter your password" required="" />
                               @if ($errors->has('password'))
                               <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                               </span>
                               @endif
                            </div>

                            <div class="form-group">
                               <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="filled-in chk-col-pink">
                               <label for="rememberme">Remember Me</label>

                               @if (Route::has('password.request'))
                                  <a class="pull-right" href="{{ route('password.request') }}">
                                      {{ __('Forgot Password?') }}
                                  </a>
                               @endif

                            </div>
                            @captcha
                            <div>
                               <button class="btn btn-primary btn-login submit btn-sm pull-left form-control" style="margin-top: 5px;">Sign In</button>
                            </div>

                        </form>

                        <div class="clearfix"></div>
                        <div class="separator">
                            <p class="change_link">New to site?
                                <a href="{{ route('register') }}" class="to_register"> Create Account </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />

                        </div>

                        @if(setting('app_name'))
                        <p class="info">Your data will not be used outside of {{setting('app_name')}}. By signing up you agree that your statistics may be used anonymously inside www.{{strtolower(setting('app_name'))}}.com.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
