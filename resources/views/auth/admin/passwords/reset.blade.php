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
                <form class="login100-form validate-form" method="POST" action="{{ route('admin.password.update') }}">
                    @csrf
                    <span class="login100-form-title p-b-26">
						{{ucfirst(trans('panel.site_title'))}}
					</span>
                    <span class="login100-form-title p-b-48">
						<img src="{{asset('images/zigoflysmall.png')}}" alt="Logo" width="120">
					</span>

                    <input name="token" value="{{ $token }}" type="hidden">

                    <div class="wrap-input100 validate-input{{ $errors->has('email') ? ' alert-validate' : '' }}" data-validate="{{$errors->has('email')? $errors->first('email') : 'Valid email is: a@b.c'}}">
                        <input class="input100" type="text" name="email"  autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ $email ?? old('email') }}">
                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div>

                    <div class="wrap-input100 validate-input{{ $errors->has('password') ? ' alert-validate' : '' }}" data-validate="{{$errors->has('password')? $errors->first('password') : 'Enter password'}}">
                        <span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100" data-placeholder="New Password"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                        <input class="input100" type="password" name="password_confirmation">
                        <span class="focus-input100" data-placeholder="Confirm Password"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn text-dark">
                                Reset Password
                            </button>
                        </div>

                    </div>

                    <div class="text-center p-t-35">
                        <span class="txt1">
							Ooh I remember...
						</span>

                        <a class="txt2" href="{{route('admin.login')}}">
                            Login instead!
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
