@extends('layouts.admin.app')
@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <nav class="breadcrumb bg-transparent">
                            <a class="breadcrumb-item" href="/" aria-label="Home">
                                <i class="fa fa-home"></i>
                            </a>
                            <a class="breadcrumb-item" href="#">Admin Panel</a>
                            <a class="breadcrumb-item" href="#">Dashboard</a>
                        </nav>
                    </div>
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <p>Welcome, {{ucfirst(explode(' ', Auth::user()->name)[0])}} &nbsp;<i class="fas fa-map-marker-alt"></i> Nairobi, Kenya</p>
                        </div>
                    </div>
                </div>

                <div class="row m-t-25">
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="row">
                                        <h2 class="tex-2 align-items-center mx-auto pl-2 text-light"
                                            style="font-size: 22px;">
                                            USD 2,000
                                        </h2>
                                        <div class="icon ml-auto">
                                            <img src="{{asset('admin/images/icon/sales.svg')}}" alt="US" width="50" height="75">
                                        </div>
                                    </div>
                                    <div class="text text-uppercase d-flex">
                                        <span>Revenues</span>
                                        <span class="ml-auto text-warning"
                                              style="text-transform: unset; font-size: 12px;">
                                                    Last 12 months
                                                </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c2">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="row">
                                        <h2 class="tex-2 align-items-center mx-auto pl-3 text-light">
                                            200
                                        </h2>
                                        <div class="icon ml-auto">
                                            <img src="{{asset('admin/images/icon/goods.png')}}" alt="US" width="50" height="75">
                                        </div>
                                    </div>
                                    <div class="text text-uppercase d-flex">
                                        <span>Estimates</span>
                                        <span class="ml-auto text-dark"
                                              style="text-transform: unset; font-size: 12px;">
                                                    Last 12 months
                                                </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c3">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="row">
                                        <h2 class="tex-2 align-items-center mx-auto pl-3 text-light">
                                            100
                                        </h2>
                                        <div class="icon ml-auto">
                                            <img src="{{asset('admin/images/icon/cart.svg')}}" alt="US" width="50" height="75">
                                        </div>
                                    </div>
                                    <div class="text d-flex">
                                        <span>ORDERS</span>
                                        <span class="ml-auto text-warning"
                                              style="text-transform: unset; font-size: 12px;">
                                                    Last 12 months
                                                </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c4">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="row">
                                        <h2 class="tex-2 align-items-center mx-auto pl-3 text-light">
                                            20
                                        </h2>
                                        <div class="icon ml-auto">
                                            <img src="{{asset('admin/images/icon/group.png')}}" alt="US" width="50" height="75">
                                        </div>
                                    </div>
                                    <div class="text d-flex">
                                        <span>USERS</span>
                                        <span class="ml-auto text-light"
                                              style="text-transform: unset; font-size: 12px;">
                                                    Last 12 months
                                                </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mx-auto">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="shadow border bg-transparent rounded-10 border-dark m-3 p-2">
                                            <div class="text-center">
                                                <span style="font-size: 14px;">Customers</span><br>
                                                <h2 class="text-2 text-theme">
                                                    250
                                                </h2>
                                                <p class="text-success">
                                                    + 2.5%
                                                </p>
                                                <p class="text-last">
                                                    Last 30 days
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="shadow border bg-transparent rounded-10 border-dark m-3 p-2">
                                            <div class="text-center">
                                                <span style="font-size: 14px;">Orders</span><br>
                                                <h2 class="text-2 text-theme">
                                                    50
                                                </h2>
                                                <p class="text-danger">
                                                    - 1.0%
                                                </p>
                                                <p class="text-last">
                                                    Last 30 days
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- line 2 -->
                                    <div class="col-md-6">
                                        <div class="shadow border bg-transparent rounded-10 border-dark m-3 p-2">
                                            <div class="text-center">
                                                <span style="font-size: 14px;">Shipments</span><br>
                                                <h2 class="text-2 text-theme">
                                                    5
                                                </h2>
                                                <p class="text-success">
                                                    + 15%
                                                </p>
                                                <p class="text-last">
                                                    Last 30 days
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="shadow border bg-transparent rounded-10 border-dark m-3 p-2">
                                            <div class="text-center">
                                                <span style="font-size: 14px;">Earnings</span><br>
                                                <h2 class="text-2 text-theme">
                                                    $2500
                                                </h2>
                                                <p class="text-success">
                                                    + 5%
                                                </p>
                                                <p class="text-last">
                                                    Last 30 days
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- line 3 -->
                                    <div class="col-md-6">
                                        <div class="shadow border bg-transparent rounded-10 border-dark m-3 p-2">
                                            <div class="text-center">
                                                <span style="font-size: 14px;">A/C Receivables</span><br>
                                                <h2 class="text-2 text-theme">
                                                    15
                                                </h2>
                                                <p class="text-danger">
                                                    + 15%
                                                </p>
                                                <p class="text-last">
                                                    Last 30 days
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="shadow border bg-transparent rounded-10 border-dark m-2 my-3 p-1">
                                            <div class="text-center">
                                                <span style="font-size: 13px;">Packages Delivered</span><br>
                                                <h2 class="text-2 text-theme">
                                                    3000
                                                </h2>
                                                <p class="text-success">
                                                    + 2.5%
                                                </p>
                                                <p class="text-last">
                                                    Last 30 days
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-6">
                                <div class="col-12">
                                    <div class="border shadow w-100 border-dark">
                                        <div class="row mx-0">
                                            <div class="col-md-6 border-md-right border-dark px-4 py-2">
                                                <span style="font-size: 15px; color: #5f7187; font-weight: 500;">Revenue</span><br>
                                                <h2 class="text-1 text-theme text-center py-2">
                                                    $8,000
                                                </h2>
                                                <p class="text-success text-center py-1">
                                                    + 2.5%
                                                </p>
                                                <p class="text-last text-center py-1">
                                                    Last 30 days
                                                </p>
                                            </div>

                                            <div class="col-md-6 border-dark px-4 py-2">
                                                <span style="font-size: 15px; color: #5f7187; font-weight: 500;">Expenses</span><br>
                                                <h2 class="text-1 text-theme text-center py-2">
                                                    $3,000
                                                </h2>
                                                <p class="text-danger text-center py-1">
                                                    -5%
                                                </p>
                                                <p class="text-last text-center py-1">
                                                    Last 3 months
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- line 2 -->
                                <div class="col-12 mt-4">
                                    <div class="border shadow w-100 border-dark border-right-radius">
                                        <div class="row mx-0">
                                            <div class="col-md-6 border-md-right border-dark px-2 py-2">
                                                        <span style="font-size: 14px; color: #5f7187; font-weight: 500;">
                                                            Top customers by revenue
                                                        </span><br>
                                                <div class="d-flex py-1">
                                                    <p class="text-left">
                                                        1. Wemo Kitawa
                                                    </p>
                                                    <span class="text-success ml-auto">
                                                                $2000
                                                            </span>
                                                </div>

                                                <div class="d-flex py-1">
                                                    <p class="text-left">
                                                        2. Basil Malaki
                                                    </p>
                                                    <span class="text-success ml-auto">
                                                                $1500
                                                            </span>
                                                </div>

                                                <div class="d-flex py-1">
                                                    <p class="text-left">
                                                        3. Sharon Bosibori
                                                    </p>
                                                    <span class="text-success ml-auto">
                                                                $1000
                                                            </span>
                                                </div>

                                                <div class="d-flex py-1">
                                                    <p class=" text-left">
                                                        4. Milton Onyiro
                                                    </p>
                                                    <span class="text-success ml-auto">
                                                                $500
                                                            </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 border-dark px-2 py-2">
                                                        <span style="font-size: 14px; color: #5f7187; font-weight: 500;">
                                                            Top Employees by revenue
                                                        </span><br>
                                                <div class="d-flex py-1">
                                                    <p class="text-left">
                                                        1. Leah Wambui
                                                    </p>
                                                    <span class="text-success ml-auto">
                                                                $2500
                                                            </span>
                                                </div>

                                                <div class="d-flex py-1">
                                                    <p class="text-left">
                                                        2. James Omariba
                                                    </p>
                                                    <span class="text-success ml-auto">
                                                                $1500
                                                            </span>
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
        </div>
    </div>

@endsection
