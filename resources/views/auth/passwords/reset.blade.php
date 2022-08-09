@extends('auth.layout')

@section('title','Reset Password')

@section('content')
    <div class="login-page">
        <div class="row">
            <div class="xs-hidden col-9 left-area">
                <img src="https://miro.medium.com/max/2625/1*qAX1633WKgkCBjW-7BICCA.jpeg" alt="">

            </div>

            <div class="col-3 right-area">

                <div class="login-content">
                    <div class="brand-logo">
                        <a href="{{route('app.home')}}">
                            <img src="{{setting('app_icon')}}" alt="" style="width: 150px;">
                         </a>
                    </div>

                    <div class="login-form">
                        <form method="POST" action="{{ route('password.update') }}" class="mg-b-20">
                            @csrf
                            <h5 class="info-title">Reset your password</h5>

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




                            <input type="hidden" class="form-control" name="email"  value="{{ $email }}" />


                            <div class="form-group">
                                <label for="password">Password</label>
                               <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter your password" required="" />
                               @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Confirm Password') }}</label>
                               <input type="password" class="form-control" name="password_confirmation" placeholder="Enter your password" required="" />
                            </div>



                            <div>
                               <button class="btn btn-primary btn-login submit btn-sm pull-left form-control" style="margin-top: 5px;"> {{ __('Reset Password') }}</button>
                            </div>

                        </form>


                        <p class="info">Your data will not be used outside of Devlomatix. By signing up you agree that your statistics may be used anonymously inside www.devlomatix.com.</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
