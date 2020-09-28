@extends('layouts.myadmin')
@section('content')
    <style type="text/css">
        .card:hover {
            box-shadow: 1px 8px 20px grey;
            -webkit-transition: box-shadow .1s ease-in;
            cursor: pointer;
        }

        .orange {
            background: #ff9f1a;
            color: #fff;
        }

        .checked {
            color: #ff9f1a;
        }
        .product-title{
            overflow: hidden!important;
            text-overflow: ellipsis!important;
            white-space: nowrap!important;
            color: #0066c0;
        }

        .product-title:hover{
            color: #ff3333;
        }

        .reviews{
            text-decoration: underline;
        }

        @media screen and (max-width: 576px) {
            .product-title{
                font-size: 14px;
                font-weight: 600;
            }

        }
    </style>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row m-b-10">
                    <div class="col-12">
                        <nav class="breadcrumb bg-transparent">
                            <a class="breadcrumb-item" href="/" aria-label="Home">
                                <i class="fa fa-home"></i>
                            </a>
                            <a class="breadcrumb-item" href="#">Categories</a>
                            @if(!empty(Request::route('search_term')))
                                <a class="breadcrumb-item" href="#">{{ucfirst(Request::route('search_term'))}}</a>
                            @endif
                        </nav>
                    </div>
                </div>

                <div class="row  m-b-30">
                    <div class="col-lg-12">
                        <div class="au-card recent-report p-md-l-">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Products</h3>
                                <div class="row">
                                    @if(isset($products))
                                        @foreach($products as $product)
                                            @php($product =(object) $product)

                                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                                <div class="card">
                                                    <a href="{{route('product.show', $product->asin)}}">
                                                        <img class="card-img-top products product-image mx-auto" src="{{$product->thumbnail}}" alt="iPhone X">
                                                    </a>
                                                    <div class="card-body">
                                                        <a href="{{route('product.show', $product->asin)}}" class="w-100 card-title product-title">{{$product->title}}</a>
                                                        <div class="rating">
                                                            <div class="stars">
                                                                @php($rating = (int) $product->reviews['rating'])
                                                                @for($i = 0; $i < 5; $i++)
                                                                    <span class="fa fa-star {{$i < $rating ? 'checked': ''}}"></span>
                                                                @endfor

                                                                <span class="small reviews pl-2"> ({{$product->reviews['total_reviews']}})</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-lg-12">
                                                                <div class="price text-success">
                                                                    <h5 class="mt-4 ml-1">$ {{$product->price['current_price']}}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-12">
                                                                <a href="{{route('product.show', $product->asin)}}" class="btn btn-block orange mt-3 text-light">View Details</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- */product -->
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row float-right mr-3">
                                    {{$products->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
