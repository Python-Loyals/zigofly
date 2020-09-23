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
                        <nav class="breadcrumb bg-transparent">
                            <a class="breadcrumb-item" href="/" aria-label="Home">
                                <i class="fa fa-home"></i>
                            </a>
                            <a class="breadcrumb-item" href="#">Customer Dashboard</a>
                        </nav>
                    </div>
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <p>Welcome, {{ucfirst(explode(' ', request()->user()->name)[0])}} &nbsp;
                                <i class="fas fa-map-marker-alt"></i> {{\App\County::find(request()->user()->county)->name}}, Kenya
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="row">
                                        <h2 class="tex-2 align-items-center mx-auto pl-5 text-light">
                                            0
                                        </h2>
                                        <div class="icon ml-auto">
                                            <img src="{{asset('account/images/united-states.svg')}}" alt="US" width="55" height="80">
                                        </div>
                                    </div>
                                    <div class="text">
                                        <span>Recieved Packages -US</span>
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
                                        <h2 class="tex-2 align-items-center mx-auto pl-5 text-light">
                                            0
                                        </h2>
                                        <div class="icon ml-auto">
                                            <img src="{{asset('account/images/united-kingdom.svg')}}" alt="US" width="55" height="80">
                                        </div>
                                    </div>
                                    <div class="text">
                                        <span>Recieved Packages -UK</span>
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
                                        <h2 class="tex-2 align-items-center mx-auto pl-5 text-light">
                                            0
                                        </h2>
                                        <div class="icon ml-auto">
                                            <img src="{{asset('account/images/plane.svg')}}" alt="US" width="55" height="80">
                                        </div>
                                    </div>
                                    <div class="text">
                                        <span>My Shipments</span>
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
                                        <h2 class="tex-2 align-items-center mx-auto pl-5 text-light">
                                            0
                                        </h2>
                                        <div class="icon ml-auto">
                                            <img src="{{asset('account/images/box.svg')}}" alt="US" width="55" height="80">
                                        </div>
                                    </div>
                                    <div class="text">
                                        <span>My Orders</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row slides">
                    <div class="col-lg-11 col-md-12 col-sm-12 center w-100">
                        <!--Carousel Wrapper-->
                        <div id="carousel-example-1z" class="carousel slide carousel-fade  box w-100 rounded-10" data-ride="carousel">
                            <!--Indicators-->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-1z" data-slide-to="1"></li>
                                <li data-target="#carousel-example-1z" data-slide-to="2"></li>
                            </ol>
                            <!--/.Indicators-->
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <!--First slide-->
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="https://ke.jumia.is/cms/2020/W38/KE_Grocery_Carrefour_0920_SB-(1).jpg" alt="First slide">
                                </div>
                                <!--/First slide-->
                                <!--Second slide-->
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(129).jpg" alt="Second slide">
                                </div>
                                <!--/Second slide-->
                                <!--Third slide-->
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg" alt="Third slide">
                                </div>
                                <!--/Third slide-->
                            </div>
                            <!--/.Slides-->
                            <!--Controls-->
                            <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            <!--/.Controls-->
                        </div>
                        <!--/.Carousel Wrapper-->
                        <hr>
                    </div>
                </div>
                <!-- ------------------------------------------------------------------------------------------>

                <div class="row  m-b-30">
                    <div class="col-lg-12">
                        <div class="au-card recent-report">
                            <h3 class="title-2 p-b-30">Popular Categories</h3>
                            <div class="row p-b-30">
                                <div class="col-md-12 col-sm-12 col-lg-4 product-group-col">
                                    <!-- product-group-Item -->
                                    <div class="product-group d-flex flex-row align-items-center justify-content-start h-100">
                                        <div class="ml-auto col-lg-6 col-md-6 text-center">
                                            <div class=""><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561815855/rp-image.png" alt=""></div>
                                            <p class="product-group-title col-12 text-center"><a href="#">Electronics</a></p>
                                        </div>
                                        <div class="product-group-content col-lg-6 col-md-6">
                                            <div class="product-group-text">2020 is the session for trending electronic accessories</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-4 product-group-col">
                                    <!-- product-group-Item -->
                                    <div class="product-group d-flex flex-row align-items-center justify-content-start h-100">
                                        <div class="ml-auto col-lg-6 col-md-6 text-center">
                                            <div class=""><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561816391/rp1.png" alt=""></div>
                                            <p class="product-group-title col-12 text-center"><a href="#">Women Clothing</a></p>
                                        </div>
                                        <div class="product-group-content col-lg-6 col-md-6">
                                            <div class="product-group-text">All new ladies wear with upto 45% sale.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-4 product-group-col">
                                    <!-- product-group-Item -->
                                    <div class="product-group d-flex flex-row align-items-center justify-content-start h-100">
                                        <div class="ml-auto col-lg-6 col-md-6 text-center">
                                            <div class=""><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561814261/adv_3.png" alt=""></div>
                                            <p class="product-group-title col-12 text-center"><a href="#">Fitness</a></p>
                                        </div>
                                        <div class="product-group-content col-lg-6 col-md-6">
                                            <div class="product-group-text">2020 trendy fitness product here from US & UK</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-b-30">
                                <div class="col-md-12 col-sm-12 col-lg-4 product-group-col">
                                    <!-- product-group-Item -->
                                    <div class="product-group d-flex flex-row align-items-center justify-content-start h-100">
                                        <div class="ml-auto col-lg-6 col-md-6 text-center">
                                            <div class=""><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561815855/rp-image.png" alt=""></div>
                                            <p class="product-group-title col-12 text-center"><a href="#">Trends 2020</a></p>
                                        </div>
                                        <div class="product-group-content col-lg-6 col-md-6">
                                            <div class="product-group-text">2020 is the session for trending laptops and accessories</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-4 product-group-col">
                                    <!-- product-group-Item -->
                                    <div class="product-group d-flex flex-row align-items-center justify-content-start h-100">
                                        <div class="ml-auto col-lg-6 col-md-6 text-center">
                                            <div class=""><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561814261/adv_3.png" alt=""></div>
                                            <p class="product-group-title col-12 text-center"><a href="{{route('products.category.search', 'fitness')}}">Fitness</a></p>
                                        </div>
                                        <div class="product-group-content col-lg-6 col-md-6">
                                            <div class="product-group-text">2020 trendy fitness product here from US & UK</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-4 product-group-col">
                                    <!-- product-group-Item -->
                                    <div class="product-group d-flex flex-row align-items-center justify-content-start h-100">
                                        <div class="ml-auto col-lg-6 col-md-6 text-center">
                                            <div class=""><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561815855/rp-image.png" alt=""></div>
                                            <p class="product-group-title col-12 text-center"><a href="#">Electronics</a></p>
                                        </div>
                                        <div class="product-group-content col-lg-6 col-md-6">
                                            <div class="product-group-text">2020 is the session for trending electronic accessories</div>
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
