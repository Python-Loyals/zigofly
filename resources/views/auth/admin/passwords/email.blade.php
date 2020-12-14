@extends('layouts.customer.myapp')
@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="login100-form validate-form" method="POST" action="{{ route('admin.password.email') }}">
                    @csrf
                    <span class="login100-form-title p-b-26">
						{{trans('panel.site_title')}}
					</span>
                    <span class="login100-form-title p-b-48">
						<img src="{{asset('/images/zigoflysmall.png')}}" alt="Logo" width="120">
					</span>

                    <div class="wrap-input100 validate-input{{ $errors->has('email') ? ' alert-validate' : '' }}" data-validate="{{$errors->has('email')? $errors->first('email') : 'Valid email is: a@b.c'}}">
                        <input class="input100" type="text" name="email"  autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div>


                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn text-dark">
                                {{ trans('global.send_password') }}
                            </button>
                        </div>
                    </div>

                    <div class="text-center p-t-35">
                        <a class="txt2" href="{{route('admin.login')}}"> Back to Login! </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
