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
                                        <h2 class="tex-2 align-items-center mx-auto pl-2 text-light" style="font-size: 22px;">
                                            USD 2,000
                                        </h2>
                                        <div class="icon ml-auto">
                                            <img src="images/icon/sales.svg" alt="US" width="50" height="75">
                                        </div>
                                    </div>
                                    <div class="text text-uppercase">
                                        <span>Revenues</span>
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
                                            <img src="images/icon/notebook.svg" alt="US" width="50" height="75">
                                        </div>
                                    </div>
                                    <div class="text text-uppercase">
                                        <span>Estimates</span>
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
                                            {{count($orders) ?? '0'}}
                                        </h2>
                                        <div class="icon ml-auto">
                                            <img src="images/icon/cart.svg" alt="US" width="50" height="75">
                                        </div>
                                    </div>
                                    <div class="text">
                                        <span>ORDERS</span>
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
                                            {{count(\App\User::all())}}
                                        </h2>
                                        <div class="icon ml-auto">
                                            <img src="images/icon/group.png" alt="US" width="50" height="75">
                                        </div>
                                    </div>
                                    <div class="text">
                                        <span>USERS</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-9">

                        <!-- SHIPMENT TRACKING TABLE --->
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Origin</th>
                                    <th class="text-center">Shipping ID</th>
                                    <th class="text-center">Destination</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Order Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">1.</td>
                                    <td class="text-center">Basil Malaki</td>
                                    <th class="text-center">US</th>
                                    <th class="text-center card-title">ZF0000001US</th>
                                    <th class="text-center card-title">MSA-KE</th>
                                    <th class="text-center text-success">Delivered</th>
                                    <th class="text-center">2020-08-29 05:57</th>
                                </tr>
                                <tr>
                                    <td class="text-center">2.</td>
                                    <td class="text-center">Milton  Onyiro</td>
                                    <th class="text-center">UK</th>
                                    <th class="text-center">ZF0000002UK</th>
                                    <th class="text-center">NBO-KE</th>
                                    <th class="text-center text-warning">Shipped</th>
                                    <th class="text-center">2020-09-05 17:59</th>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <!-- ORDER TRACKING TABLE --->

                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Order ID</th>
                                    <th class="text-center"> Order Status</th>
                                    <th class="text-center">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($orders as $i => $order)
                                    <tr>
                                        <td class="text-center">{{$i + 1}} .</td>
                                        <td class="text-center">{{$order->customer->name ?? ''}}</td>
                                        <th class="text-center card-title">ZF-US-{{sprintf('%04d',$order->id)}}</th>
                                        <td class="text-center text-success">
                                            @switch($order->status)
                                                @case(1)
                                                Pending
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="text-center">
                                            {{$order->created_at}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No orders yet</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>

                        <!-- QUOTE TRACKING TABLE --->
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Quote ID</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($quotes as $i => $quote)
                                    <tr>
                                        <td class="text-center">{{$i + 1}} .</td>
                                        <td class="text-center">{{$quote->user->name ?? ''}}</td>
                                        <th class="text-center card-title">ZFQ-{{sprintf('%04d',$quote->id)}}</th>
                                        <td class="text-center text-success">
                                            @switch($order->status)
                                                @case(1)
                                                Pending
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="text-center">
                                            {{$order->created_at}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No quotes yet</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header bg-theme">
                                <strong class="card-title text-light text-right">Notice Board</strong>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-light">Some quick example text to build on the card title and make up the bulk of the card's
                                    content.
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-theme">
                                <strong class="card-title text-light text-right">CHAT</strong>
                            </div>
                            <div class="card-body">
                                <p class="card-text"> Leah</p>
                                <p class="card-text font-weight-bolder" align="right"> @kimani, respond to inquiry <br> @ZFQ001</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>Copyright © 2020 zigofly.com. All rights reserved. By <a href="https://zigofly.com">Zigofly Kenya Ltd</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
