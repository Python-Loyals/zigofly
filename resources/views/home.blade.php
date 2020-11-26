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
                        <nav class="breadcrumb bg-transparent" style="font-size: 14px">
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
                        <div class="row">
                            <div class="col-12 text-center my-2">
                                <p class="h4 font-weight-light text-dark">What's New</p>
                            </div>
                        </div>
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
                                    <img class="d-block w-100 rounded-10" src="https://ke.jumia.is/cms/2020/W38/KE_Grocery_Carrefour_0920_SB-(1).jpg" alt="First slide">
                                </div>
                                <!--/First slide-->
                                <!--Second slide-->
                                <div class="carousel-item">
                                    <img class="d-block w-100 rounded-10" src="https://images-na.ssl-images-amazon.com/images/G/01/AmazonExports/Events/2020/BlackFriday/Fuji_LPHero_BFWeek_en_US.jpg" alt="Second slide">
                                </div>
                                <!--/Second slide-->
                                <!--Third slide-->
                                <div class="carousel-item">
                                    <img class="d-block w-100 rounded-10" src="https://ke.jumia.is/cms/2020/BlackFriday/Live/HP/W4/Tue/KE_BFLive_FreeShipping_SB-(1).png" alt="Third slide">
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
                    </div>
                </div>
                <!-- ------------------------------------------------------------------------------------------>

{{--                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">--}}
{{--                    <div class="card product-group" data-href="{{route('products.category.search', 'men')}}">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="mx-auto d-block">--}}
{{--                                <img class="rounded-circle mx-auto d-block" src="{{asset('account/images/covers/men1.jpg')}}" alt="Card image cap">--}}
{{--                                <h5 class="text-sm-center mt-2 mb-1">Men Clothing</h5>--}}
{{--                                <div class="cartegory-text d-none">--}}
{{--                                    Shop men Clothing from US and UK Stores</div>--}}
{{--                            </div>--}}
{{--                            <hr>--}}
{{--                            <div class="text-sm-center">--}}
{{--                                <a href="{{route('products.category.search', 'men')}}">--}}
{{--                                    <button type="button" class="btn btn-outline-secondary">Shop now</button></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="row  m-b-30">
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-9">
                                <h3 class="title-2 pb-3" style="font-size: 18px;font-weight: 520;">Popular Categories</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="">
                            <div class="row ">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 popular-card">
                                    <!-- popular-card-Item -->
                                    <img class="popular-img" src="{{asset('account/images/banners/woman.png')}}">
                                    <p class="popular-title">Women Clothing</p>

                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 popular-card">
                                    <!-- popular-card-Item -->
                                    <img class="popular-img" src="{{asset('account/images/banners/man.png')}}">
                                    <p class="popular-title">Men Clothing</p>

                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 popular-card">
                                    <!-- popular-card-Item -->
                                    <img class="popular-img" src="{{asset('account/images/banners/toys.png')}}">
                                    <p class="popular-title">Toys</p>

                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 popular-card">
                                    <!-- popular-card-Item -->
                                    <img class="popular-img" src="{{asset('account/images/banners/electronics.png')}}">
                                    <p class="popular-title">Electronics</p>

                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 popular-card">
                                    <!-- popular-card-Item -->
                                    <img class="popular-img" src="{{asset('account/images/banners/cosmetics.png')}}">
                                    <p class="popular-title">Beauty</p>

                                </div>

                            </div><br>

                            <div class="row ">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 popular-card">
                                    <!-- popular-card-Item -->
                                    <img class="popular-img" src="{{asset('account/images/banners/weightlift.png')}}">
                                    <p class="popular-title">Fitness</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 popular-card">
                                    <!-- popular-card-Item -->
                                    <img class="popular-img" src="{{asset('account/images/banners/pot.png')}}">
                                    <p class="popular-title">Home & Garden</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 popular-card">
                                    <!-- popular-card-Item -->
                                    <img class="popular-img" src="{{asset('account/images/banners/confetti.png')}}">
                                    <p class="popular-title">Party Supplies</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 popular-card">
                                    <!-- popular-card-Item -->
                                    <img class="popular-img" src="{{asset('account/images/banners/mother.png')}}">
                                    <p class="popular-title">Baby & Mom</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 popular-card">
                                    <!-- popular-card-Item -->
                                    <img class="popular-img" src="{{asset('account/images/banners/gift.png')}}">
                                    <p class="popular-title">Gifts</p>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 popular-card">
                                    <!-- popular-card-Item -->
                                    <img class="popular-img" src="{{asset('account/images/banners/book.png')}}">
                                    <p class="popular-title">Books</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 popular-card">
                                    <!-- popular-card-Item -->
                                    <img class="popular-img" src="{{asset('account/images/banners/car.png')}}">
                                    <p class="popular-title">Automotives</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="popular-card1 p-0 my-3 my-sm-0">
                            <img class="popular-card1-img rounded-10" src="{{asset('account/images/banners/prime-banner.jpg')}}">
                        </div>
                    </div>

                </div>

                <!------ -->
                @if(Auth::user()->lastViewed)
                    <div class="row  m-b-30">
                        <div class="col-lg-12">
                            <div class="au-card recent-report">
                                <div class="row description px-3">
                                    <div class="col-12">
                                        <h4 class="fs-15 mb-2">Recently viewed products</h4>
                                        <div class="row last-viewed">
                                        @foreach(Auth::user()->lastViewed as $viewed)
                                            @php($prod = $viewed->product)
                                            <!-- product -->
                                                <div class="col-sm-4 col-lg-3">
                                                    <div class="card bg-white p-md-l-5 p-md-r-5 p-1">
                                                        <a href="{{route('product.show', $prod->asin)}}" class="d-flex">
                                                            <img class="card-img-top products product-image mx-auto mt-2 img-fluid" src="{{$prod->images[0]->link}}" alt="iPhone X">
                                                        </a>
                                                        <div class="card-body px-1 pb-2">
                                                            <a href="{{route('product.show', $prod->asin)}}" class="w-100 card-title product-title" style="font-size: 16px!important;color: #0066c0;">{{$prod->title}}</a>
                                                            <div class="rating mb-1">
                                                                <div class="stars">
                                                                    @php($rating = (int) $prod->rating)
                                                                    @for($i = 0; $i < 5; $i++)
                                                                        <span class="fa fa-star {{$i < $rating ? 'checked': ''}}"></span>
                                                                    @endfor

                                                                    <span class="small reviews pl-2"> ({{$prod->total_reviews}})</span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-12">
                                                                    <div class="price text-success">
                                                                        <h5 class="mt-2 ml-1">$ {{$prod->price}}</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-lg-12">
                                                                    <a href="{{route('product.show', $prod->asin)}}" class="btn btn-block orange mt-3 text-light">View Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- */product -->
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
