@extends('layouts.customer.myapp')
@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">

                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <span class="login100-form-title p-b-26">
						{{ucfirst(trans('panel.site_title'))}}
					</span>
                    <span class="login100-form-title p-b-48">
						<img src="{{asset('images/zigoflysmall.png')}}" alt="Logo" width="120">
					</span>

                    <div class="wrap-input100 validate-input{{ $errors->has('email') ? ' alert-validate' : '' }}" data-validate="{{$errors->has('email')? $errors->first('email') : 'Valid email is: a@b.c'}}">
                        <input class="input100" type="text" name="email"  autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div>

                    <div class="wrap-input100 validate-input{{ $errors->has('password') ? ' alert-validate' : '' }}" data-validate="{{$errors->has('password')? $errors->first('password') : 'Enter password'}}">
                        <span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                        </label>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn text-dark">
                                Login
                            </button>
                        </div>

                        <div class="text-center p-t-9">
                            <span class="txt1">
									Forgot your Password?
								</span>

                            <a class="txt2" href="{{route('password.request')}}">
                                Reset now.
                            </a>
                        </div>

                    </div>

                    <div class="text-center p-t-35">
                        <span class="txt1">
							Don’t have an account?
						</span>

                        <a class="txt2" href="{{route('register')}}">
                            Sign Up
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
