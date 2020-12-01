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
                    <div class="row  m-b-30 package-content col-md-11 mx-auto">
                        <div class="packsummary col-lg-4 col-md-5 col-xs-8 col-sm-8 package-card ">
                            <div class="row">
                                <div class="packimage col-lg-4 col-md-4 col-xs-4 col-sm-4">
                                    <img src="{{asset('account/images/banners/box.png')}}">
                                </div>
                                <div class="packname col-lg-8 col-md-8 col-xs-8 col-sm-8">
                                    <strong class="">Package Details</strong>
                                    <p>ZF0001UK</p>
                                </div>
                            </div><br>
                            <hr>
                            <div class="row">
                                <div class="details col-lg-10 col-md-10 col-xs-10 col-sm-10">
                                    <p>Package Dimensions: &ensp;<span class="info"> 15" x 10" x 5" </span></p>
                                    <p>Chargeable Weight: &ensp;<span class="info"> 2.45 kgs </span></p>
                                    <p>Volumetric Weight: &ensp;<span class="info"> 2.45 kgs </span></p>
                                    <p>Actual Weight: &ensp;<span class="info"> 2.00 kgs </span></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="packaddress">
                                    <p><span class="info">Ship to:&ensp;</span>Basil Malaki</p>
                                    <p>Techbridge Invest </p>
                                    <p>Nyali Mall </p>
                                    <p>Mombasa, Kenya </p>
                                    <p>0712121212 </p>
                                </div>
                            </div>


                        </div><br>
                        <hr>
                        <div class="packplan col-lg-4 col-md-5 col-xs-8 col-sm-8 package-card ">
                            <div class="standard packplancard">
                                <p><strong>STANDARD</strong></p>
                                <p>Get it by 25th June 2020 </p>
                                <p>$ 49.00 </p>
                            </div><br>
                            <div class="express packplancard">
                                <p><strong>STANDARD</strong></p>
                                <p>Get it by 10th June 2020 </p>
                                <p>$ 80.00 </p>
                            </div><br>
                            <div class="premium packplancard">
                                <p><strong>PREMIUM UPGRADE</strong></p>
                                <p>Get it by 10th June 2020 </p>
                                <p>$ 55.00 </p>
                            </div>

                        </div><br>
                        <hr>
                        <div class="packdetails col-lg-3 col-md-12 col-xs-8 col-sm-8  ">
                            <div class="packdetailscard">
                                <p><strong>Shipment Info</strong></p>
                                <p>Number of Packages:&ensp;<strong>2</strong></p>
                                <p>Shipping Fee:&ensp;<strong>$ 55.00</strong></p>
                                <form>
                                    <label class="d-inline" for="promocode">Promo Code:</label>
                                    <input type="text" id="promocode" name="promocode">
                                </form>
                            </div><br>
                            <div class="packaddress">
                                <button class="btnlink">
                                    Zigofly Wallet <img src="{{asset('account/images/banners/financial.png')}}">
                                </button>
                            </div><br>
                            <div class="packaddress">
                                <button class="">
                                    <img src="{{asset('account/images/banners/mpesa.png')}}">
                                </button>
                            </div> <br>
                        </div><br>
                        <hr>
                    </div>
                </div>


                @include('partials.popular_categories')

            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>
@endsection
