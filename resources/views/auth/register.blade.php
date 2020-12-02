@extends('layouts.customer.myapp')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection
@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <form class="login100-form register-form validate-form" method="POST" action="{{route('register')}}">
                    @csrf
                    <span class="login100-form-title p-b-10">
                    {{trans('panel.site_title')}}
                  </span>
                    <span class="login100-form-title p-b-30">
                        <img src="{{asset('images/zigoflysmall.png')}}" alt="Logo" width="120">
                    </span>
                    <div class="wrap-input100 validate-input {{ $errors->has('name') ? ' alert-validate' : '' }}" data-validate="{{ $errors->has('name') ? $errors->first('name') : 'Enter your full name' }}">
                        <input class="input100" type="text" name="name" value="{{old('name','')}}">
                        <span class="focus-input100" data-placeholder="Full Name"></span>
                    </div>
                    <div class="wrap-input100 validate-input{{ $errors->has('email') ? ' alert-validate' : '' }}" data-validate=" {{$errors->has('email')? $errors->first('email') : 'Valid email is: a@b.c'}}">
                        <input class="input100" type="text" name="email" value="{{old('email','')}}">
                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div>
                    <!-- phone number -->
                    <div class="wrap-input100 validate-input{{ $errors->has('phone') ? ' alert-validate' : '' }}" data-validate="{{ $errors->has('phone') ? $errors->first('phone') : 'Enter your phone number' }}">
                        <input class="input100" type="text" name="phone" value="{{old('phone','')}}">
                        <span class="focus-input100" data-placeholder="Phone Number"></span>
                    </div>
                    <div class="wrap-input100 validate-input{{ $errors->has('phone') ? ' alert-validate' : '' }}" data-validate="{{ $errors->has('age') ? $errors->first('age') : 'Select your age' }}">
                        <select class="input100" type="text" name="age" required>
                            <option value="" selected disabled>--Select your age--</option>
                            @if(isset($ages))
                                @foreach($ages as $id => $age)
                                    <option value="{{$id}}">{{$age}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="wrap-input100 validate-input{{ $errors->has('county') ? ' alert-validate' : '' }}" data-validate="{{ $errors->has('county') ? $errors->first('county') : 'Enter your county' }}">
                        <select class="input100" type="text" name="county" required>
                            <option value="" selected disabled>--Select your county--</option>
                            @if(isset($counties))
                                @foreach($counties as $id => $county)
                                    <option value="{{$id}}">{{$county}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="wrap-input100 validate-input{{ $errors->has('password') ? ' alert-validate' : '' }}" data-validate="{{$errors->has('password')? $errors->first('password') : 'Enter password'}}">
                        <span class="btn-show-pass">
                     <i class="zmdi zmdi-eye"></i>
                     </span>
                        <input class="input100" type="password" name="password" value="{{old('password','')}}" autocomplete="chrome-off">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>
                    <div class="wrap-input100 validate-input{{ $errors->has('password_confirmation') ? ' alert-validate' : '' }}" data-validate="{{$errors->has('password_confirmation')? $errors->first('password_confirmation') : 'Enter confirm password'}}">
                        <span class="btn-show-pass">
                     <i class="zmdi zmdi-eye"></i>
                     </span>
                        <input class="input100" type="password" name="password_confirmation">
                        <span class="focus-input100" data-placeholder="Repeat Password"></span>
                    </div>

                    <div class="wrap-input10 validate-input dis-flex">
                        <input type="checkbox" name="terms" required id="terms" class="m-t-5 m-r-5">
                        <label for="terms">I accept Zigofly.com terms & conditions as well as the privacy policy.</label>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn text-dark" type="submit">
                                Sign Up
                            </button>
                        </div>
                    </div>
                    <div class="text-center p-t-55">
                        <span class="txt1">
                            Already have an account?
                        </span>
                        <a class="txt2" href="{{route('login')}}">
                            Sign In
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
