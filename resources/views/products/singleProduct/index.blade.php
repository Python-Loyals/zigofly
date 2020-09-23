@extends('layouts.myadmin')
@section('styles')
    <link rel="stylesheet" href="{{asset('account/css/singe-product.css')}}">
@endsection
@section('content')
    <div class="main-content pt-10">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
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
                            <div class="card mt-0 bg-white">
                                <div class="container-fluid">
                                    <div class="wrapper row">
                                        <div class="preview col-md-6">

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
{{--                                            <p class="product-description">Suspendisse quos? Tempus cras iure temporibus? Eu laudantium cubilia sem sem! Repudiandae et! Massa senectus enim minim sociosqu delectus posuere.</p>--}}
                                            <h3 class="price">
                                                <span>
                                                    $ <span class="variation-price">
                                                        {{$product->price['current_price']}}
                                                    </span>
                                                </span>
                                            </h3>
                                            <h5 class="sizes fs-13">
                                                <span class="text-muted text-400">Color:</span> <span class="active-variant-color ml-2"></span>
                                            </h5>
                                            <div class="row">
                                                @foreach($product->variants as $i => $variant)
                                                    @php($variant = (object) $variant)
                                                    <div class="col-6 col-md-6 col-lg-4 px-1" data-toggle="tooltip" title="{{$variant->title}}">
                                                        <button class="btn border variant border-ddark my-1 w-100{{(bool)$variant->is_current_product ? ' active': ''}}"
                                                                aria-label="variant-button" id="vaiant-{{$i}}"
                                                                data-id="{{$i}}"
                                                                data-defaultasin="{{$variant->asin}}"
                                                                data-color="{{$variant->title}}">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <img src="{{$variant->images[0]['thumb']}}" alt="{{$variant->title}}" class="img-thumbnail border-0">
                                                                </div>
                                                                <div class="col-6 center">
                                                                    <span class="d-flex h-100 flex-row justify-content-center align-items-center">
                                                                        {{$variant->price}}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="row mt-3">
                                                <div class="action col-12 col-lg-6">
                                                    <button class="add-to-cart btn btn-sm btn-default mb-3 px-5 mr-1" type="button">add to cart</button>
                                                </div>
                                                <div class="m-sm-t-10 col-12 col-lg-6">
                                                    <a href="products.html" class="btn-sm back btn btn-secondary" type="button">
                                                        Continue Shopping
                                                    </a>
                                                </div>
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
    </div>
@endsection
@section('scripts')
    @parent
    <script>
    </script>
@endsection
