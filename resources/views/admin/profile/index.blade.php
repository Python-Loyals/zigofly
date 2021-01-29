@extends('layouts.admin.app')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row flex-lg-nowrap">
                    <div class="col">
                        <div class="row">
                            <div class="col mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        @if($message = Session::get('success'))
                                            <div class="col-12">
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <p>{{ $message }}</p>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                            @if ($errors->any())
                                                <div class="row center">
                                                    <div class="alert alert-danger mb-3 col-11">
                                                        Whoops! There was a problem with your input.<br>
                                                        <ul class="ml-3">
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif

                                        <div class="e-profile">
                                            <div class="row">
                                                <div class="col-12 col-sm-auto mb-3">
                                                    <div class="mx-auto" style="width: 140px;">
                                                        <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                                                            <img src="{{count(auth()->user()->profile) > 0 ? auth()->user()->profile[0]->preview : asset('images/user.png')}}" height="140" width="140" alt="{{auth()->user()->name}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                                    <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                        <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ucwords(Auth::user()->name)}}</h4>

                                                        <div class="mt-4">
                                                            <form action="{{route('admin.profile.update_avatar')}}" method="POST" class="avatar-form" enctype="multipart/form-data" >
                                                                @csrf
                                                                @method('PUT')
                                                                <input id="avatar" type="file" class="form-control required d-none" accept="image/jpeg,image/png" name="avatar">
                                                                <label for="avatar" class="btn btn-primary mb-3">
                                                                    <i class="fa fa-camera"></i>
                                                                    <span>Change Photo</span>
                                                                </label>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="text-center text-sm-right">
                                                        <div class="text-muted">
                                                            <small>Joined on {{date_format(Auth::user()->created_at, 'F j, Y')}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link {{($errors->has('password') || $errors->has('old_password')) ? '':'active'}}"
                                                       id="info-tab" data-toggle="tab" href="#personalInfo" role="tab"
                                                       aria-controls="personalInfo" aria-selected="{{($errors->has('password') || $errors->has('old_password')) ? 'false':'true'}}">Personal Details</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link {{($errors->has('password') || $errors->has('old_password')) ? 'show active':''}}"
                                                       id="password-tab" data-toggle="tab" href="#changePassword" role="tab"
                                                       aria-controls="changePassword" aria-selected="{{($errors->has('password') || $errors->has('old_password')) ? 'true':'false'}}">Change Password</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content pt-3">
                                                <div class="tab-pane fade {{($errors->has('password') || $errors->has('old_password')) ? '':'show active'}}" role="tabpanel" aria-labelledby="info-tab" id="personalInfo">
                                                    <form class="form" action="{{route('admin.profile.update_info')}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                                                            <label>Full Name</label>
                                                                            <input class="form-control" type="text" name="name" placeholder="John Smith" value="{{Auth::user()->name}}">
                                                                            @if($errors->has('name'))
                                                                                <div class="invalid-feedback">
                                                                                    {{ $errors->first('name') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                                                            <label>Email</label>
                                                                            <input class="form-control" type="email" placeholder="user@example.com" name="email" value="{{Auth::user()->email}}">
                                                                            @if($errors->has('email'))
                                                                                <div class="invalid-feedback">
                                                                                    {{ $errors->first('email') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group {{ $errors->has('phone') ? 'is-invalid' : '' }}">
                                                                            <label>Phone</label>
                                                                            <input class="form-control" type="text" placeholder="254712345678" name="phone" value="{{Auth::user()->phone}}">
                                                                            @if($errors->has('phone'))
                                                                                <div class="invalid-feedback">
                                                                                    {{ $errors->first('phone') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-4">
                                                            <div class="col d-flex justify-content-center">
                                                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>


                                                <div class="tab-pane fade {{($errors->has('password') || $errors->has('old_password')) ? 'show active':''}}" id="changePassword" role="tabpanel" aria-labelledby="password-tab">
                                                    <form class="form" action="{{route('admin.password.update')}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Current Password</label>
                                                                    <input class="form-control {{ $errors->has('old_password') ? 'is-invalid' : '' }}" name="old_password" type="password" placeholder="Provide Current Password">
                                                                    @if($errors->has('old_password'))
                                                                        <div class="invalid-feedback">
                                                                            {{ $errors->first('old_password') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>New Password</label>
                                                                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" type="password" placeholder="Enter New Password">
                                                                    @if($errors->has('password'))
                                                                        <div class="invalid-feedback">
                                                                            {{ $errors->first('password') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Confirm <span class="d-none d-xl-inline">Confirm Password</span></label>
                                                                    <input class="form-control" name="password_confirmation" type="password" placeholder="Confirm New Password"></div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-4">
                                                            <div class="col d-flex justify-content-center">
                                                                <button class="btn btn-primary" type="submit">Update Password</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-md-block d-none col-md-3 mb-3">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="px-xl-3">
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button class="btn btn-block btn-secondary" type="submit">
                                                    <i class="fa fa-sign-out"></i>
                                                    <span>Logout</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
