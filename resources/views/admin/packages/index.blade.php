@extends('layouts.myadmin')
@section('styles')
    <link rel="stylesheet" href="{{asset('account/css/zigo.css')}}">
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <nav class="breadcrumb bg-transparent p-0 py-md-3 mb-2 mb-md-0" style="font-size: 14px;">
                            <a class="breadcrumb-item" href="/" aria-label="Home">
                                <i class="fa fa-home"></i>
                            </a>
                            <a class="breadcrumb-item" href="#">Customer Dashboard</a>
                            <a class="breadcrumb-item" href="#">Packages</a>
                        </nav>
                    </div>
                    <div class="col-12">
                        <div class="overview-wraps" style="font-size: 14px;">
                            <p>
                                <span style="font-size: 16px;" class="pr-2">Welcome, {{ucfirst(explode(' ', request()->user()->name)[0])}}</span>&nbsp;
                                <i class="fas fa-map-marker-alt"></i> {{\App\County::find(request()->user()->county)->name}}, Kenya
                            </p>
                        </div>
                    </div>
                </div>

                @include('partials.boxes')

                <div class="row">
                    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 packages-card ml-auto mr-auto">
                        <!--Package List Table-->
                        <div class="table-responsive m-b-30">
                            <table class="table table-borderless table-striped table-earning table-packages">
                                <thead>
                                <tr">
                                    <th class="text-center fs-14">Package Photo</th>
                                    <th class="text-center fs-14">Package ID</th>
                                    <th class="text-center fs-14">Package Weight</th>
                                    <th class="text-center fs-14">Package Dimensions</th>
                                    <th class="text-center fs-14">Tracking #</th>
                                    <th class="text-center fs-14">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">  <img class="popular-img" src="{{asset('account/images/banners/car.png')}}"> </td>
                                    <td class="text-center card-title link" data-href="{{route('admin.users.single_package')}}">ZFP001</td>
                                    <td class="text-center">20Kgs</td>
                                    <td class="text-center">15x10x15</td>
                                    <td class="text-center card-title">1ZMSA354554954</td>
                                    <td class="text-center text-success">
                                        <select class="select-package" >
                                            <option>Prepare To Ship</option>
                                            <option>Consolidate</option>
                                            <option>Repack</option>
                                            <option>Store</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">  <img class="popular-img" src="{{asset('account/images/banners/pot.png')}}"> </td>
                                    <td class="text-center card-title" data-href="{{route('admin.users.single_package')}}">ZFP001</td>
                                    <td class="text-center">20Kgs</td>
                                    <td class="text-center">15x10x15</td>
                                    <td class="text-center card-title">1ZMSA354554954</td>
                                    <td class="text-center text-success">
                                        <select class="select-package" >
                                            <option>Prepare To Ship</option>
                                            <option>Consolidate</option>
                                            <option>Repack</option>
                                            <option>Store</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">  <img class="popular-img" src="{{asset('account/images/banners/electronics.png')}}"> </td>
                                    <td class="text-center card-title">ZFP001</td>
                                    <td class="text-center">20Kgs</td>
                                    <td class="text-center">15x10x15</td>
                                    <td class="text-center card-title">1ZMSA354554954</td>
                                    <td class="text-center text-success">
                                        <select class="select-package" >
                                            <option>Prepare To Ship</option>
                                            <option>Consolidate</option>
                                            <option>Repack</option>
                                            <option>Store</option>
                                        </select>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <!--/.Package List Table-->
                    </div>
                </div>


                @include('partials.popular_categories')

            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>
@endsection
