@extends('layouts.myadmin')
@section('styles')
    <link rel="stylesheet" href="{{asset('account/css/singe-product.css')}}">
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
        .last-viewed .product-title{
            overflow: hidden!important;
            text-overflow: ellipsis!important;
            white-space: nowrap!important;
            color: #0066c0;
        }

        .last-viewed .product-title:hover{
            color: #ff3333;
        }

        .last-viewed .reviews{
            text-decoration: underline;
        }
        .last-viewed .products.product-image{
            margin-top: 20px;
            width: 60%;
            height: 185px;
        }

        @media screen and (max-width: 576px) {
            .last-viewed .product-title{
                font-size: 14px;
                font-weight: 600;
            }

        }
    </style>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid  p-sm-l-10 p-sm-r-10">
                <div class="row d-md-flex d-none pl-1">
                    <div class="col-12">
                        <nav class="breadcrumb bg-transparent">
                            <a class="breadcrumb-item" href="/" aria-label="Home">
                                <i class="fa fa-home"></i>
                            </a>
                            <a class="breadcrumb-item" href="#">Single Product</a>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    @if(isset($product) && count($product) > 0)
                        @php($product = (object) $product)
                        <div class="col-12 mx-auto">
                            <div class="card pt-5 my-1 bg-white">
                                <div class="container-fluid">
                                    <div class="wrapper row">
                                        <div class="preview col-md-6">
{{--                                            if there are product variants--}}
                                            @if(count($product->variants) > 0)
                                                @foreach($product->variants as $index => $variant)
                                                    @php($variant = (object) $variant)
                                                    @if((bool)$variant->is_current_product)
                                                        <div class="my-variant active" id="v-{{$index}}">
                                                            <div class="preview-pic tab-content mb-5">
                                                                @foreach($product->images as $i => $image)
                                                                    <div class="tab-pane {{$i === 0 ? 'active':''}}" id="pic-{{$i+1}}">
                                                                        <img src="{{$image}}" class="center" />
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <ul class="preview-thumbnail nav nav-tabs justify-content-center">
                                                                @foreach($variant->images as $i => $image)
                                                                    <li class="{{$i === 0 ? 'active':''}}">
                                                                        <a data-target="#pic-{{$i+1}}" data-toggle="tab" class="h-100">
                                                                            <img src="{{$image['thumb']}}" />
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        @continue
                                                    @endif
                                                    <div class="my-variant d-none" id="v-{{$index}}">
                                                        <div class="preview-pic tab-content mb-5">
                                                            @foreach($variant->images as $i => $image)
                                                                <div class="tab-pane {{$i === 0 ? 'active':''}}" id="pic-{{$index.($i+1)}}">
                                                                    <img src="{{$image['large']}}" class="center" />
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <ul class="preview-thumbnail nav nav-tabs justify-content-center">
                                                            @foreach($variant->images as $i => $image)
                                                                <li class="{{$i === 0 ? 'active':''}}">
                                                                    <a data-target="#pic-{{$index.($i+1)}}" data-toggle="tab" class="h-100">
                                                                        <img src="{{$image['thumb']}}" />
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endforeach
{{--                                                if there are no variants--}}
                                                @else
                                                <div class="my-variant active" id="v-1">
                                                <div class="preview-pic tab-content mb-5">
                                                    @foreach($product->images as $i => $image)
                                                        <div class="tab-pane {{$i === 0 ? 'active':''}}" id="pic-{{$i+1}}">
                                                            <img src="{{$image}}" class="center" />
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <ul class="preview-thumbnail nav nav-tabs justify-content-center">
                                                    @foreach($product->images as $i => $image)
                                                        <li class="{{$i === 0 ? 'active':''}}">
                                                            <a data-target="#pic-{{$i+1}}" data-toggle="tab" class="h-100">
                                                                <img src="{{$image}}" />
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                        </div>
                                            @endif
                                        </div>
                                        <div class="details col-md-6">
                                            <h3 class="product-title">
                                                {{$product->title}}
                                            </h3>
                                            <div class="rating d-flex">
                                                <div class="stars">
                                                    @php($rating = (int) $product->reviews['rating'])
                                                    @for($i = 0; $i < 5; $i++)
                                                        <span class="fa fa-star {{$i < $rating ? 'checked': ''}}"></span>
                                                    @endfor
                                                </div>
                                                <span class="review-no text-underline ml-3">({{$product->reviews['total_reviews']}} reviews)</span>
                                            </div>
                                            <div class="dropdown-divider"></div>
                                            <h3 class="price">
                                                <span class="variation-price">
                                                    ${{$product->price['current_price']}}
                                                </span>
                                            </h3>
                                            <h5 class="sizes fs-13">
                                                <span class="text-muted text-400 d-none">Color:
                                                    <span class="active-variant-color ml-2"></span>
                                                </span>
                                            </h5>
                                            <div class="row">
                                                @foreach($product->variants as $i => $variant)
                                                    @php($variant = (object) $variant)
                                                    @php($parentClasses = empty($variant->price) ? 'col-3 col-lg-2' : 'col-6 col-md-6 col-lg-4')
                                                    @php($childClasses = empty($variant->price) ? 'col-12' : 'col-6')
                                                    <div class="{{$parentClasses}} px-1" data-toggle="tooltip" title="{{stripslashes($variant->title)}}">
                                                        <button class="btn border variant border-ddark my-1 w-100{{(bool)$variant->is_current_product ? ' active': ''}}"
                                                                aria-label="variant-button" id="vaiant-{{$i}}"
                                                                data-id="{{$i}}"
                                                                data-defaultasin="{{$variant->asin}}"
                                                                data-color="{{stripslashes($variant->title)}}">
                                                            <div class="row">
                                                                <div class="{{$childClasses}}">
                                                                    <img src="{{$variant->images[0]['thumb']}}" alt="{{stripslashes($variant->title)}}" class="img-thumbnail border-0">
                                                                </div>
                                                                @if(!empty($variant->price))
                                                                    <div class="col-6 center">
                                                                        <span class="d-flex h-100 flex-row justify-content-center align-items-center variant-price">
                                                                            {{$variant->price}}
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="row mt-3">
                                                <div class="action col-12 col-lg-6 text-center">
                                                    <button class="add-to-cart btn btn-sm btn-default mb-3 px-5 mr-1" type="button">add to cart</button>
                                                </div>
                                                <div class="m-sm-t-10 col-12 col-lg-6 text-center">
                                                    <a href="{{url()->previous()}}" class="btn-sm back btn btn-secondary" type="button">
                                                        Continue Shopping
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5 description px-3">
                                            <div class="col-12">
                                                <h4 class="fs-15 mb-2">About this item</h4>
                                                <ul>
                                                    @foreach($product->feature_bullets as $feature)
                                                        <li class="fs-14">
                                                            {{$feature}}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card bg-white">
                                {{--last viewed items--}}
                                @if(Auth::user()->lastViewed)
                                    <div class="row mt-5 description px-3">
                                        <div class="col-12">
                                            <h4 class="fs-15 mb-2">Last viewed products</h4>
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
                                @endif
                            </div>

                        </div>
                    @endif
                </div>

            </div>
@endsection
@section('scripts')
    @parent
    <script>
        window.product = JSON.stringify({!! json_encode($product) !!});
    </script>
@endsection
