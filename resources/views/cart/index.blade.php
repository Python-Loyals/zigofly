@extends('layouts.myadmin')
@section('styles')
    <link rel="stylesheet" href="{{asset('account/css/cart.css')}}">
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid  p-sm-l-10 p-sm-r-10">
                <div class="row d-md-flex d-none pl-1>
                    <div class="col-12">
                <nav class="breadcrumb bg-transparent">
                    <a class="breadcrumb-item" href="/" aria-label="Home">
                        <i class="fa fa-home"></i>
                    </a>
                    <a class="breadcrumb-item" href="#">Cart</a>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mx-auto">
                <div class="card pt-2 my-1 bg-white">
                    <div class="container-fluid">
                        <div class="cart">
                            <div class="row p-4 bg-mobile">
                                <div class="col-sm-6">
                                    <h2 class="text-success">Cart Details</h2>
                                </div>
                                <div class="col-sm-6 ">
                                    <a href="{{route('admin.shop')}}" type="button" class="btn btn-custom pull-right">Continue Shopping</a>
                                </div>
                            </div>
                            @if(Cart::count() > 0)
                                <div class="mt-2 d-none d-md-block">
                                    <div class="row">
                                        <div class="col-md-5 d-flex justify-content-center">Item</div>
                                        <div class="col-md-2 d-flex justify-content-center">Qty</div>
                                        <div class="col-md-2 d-flex justify-content-center">Unit Price</div>
                                        <div class="col-md-2 d-flex justify-content-center">Subtotal</div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                </div>
                                @foreach(Cart::content() as $item)
                                    <div class="row p-3 effects" data-rowid="{{$item->rowId}}">
                                        <div class="col-md-1 px-1">
                                            <img src="{{$item->model->images[0]->link}}" class="img-responsive">
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{route('product.show', $item->model->asin)}}" class="cart-item-title">{{$item->model->title}}</a>
                                            <div class="text-muted">
                                                <span class="price my-1 d-block d-md-none">${{$item->model->price}}</span>
                                                @if($item->options)
                                                    @foreach($item->options as $key => $value)
                                                        @if($key == 'quantity')
                                                            @continue
                                                        @endif
                                                        <span>{{ucfirst($key)}}: <span class="ml-2 font-weight-semibold">{{$value}}</span></span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex justify-content-center mt-3 mt-md-0">
                                            <div data-href="{{route('cart.quantity.update')}}" data-price="{{$item->model->price}}">
                                                <span class="input-number-decrement">–</span>
                                                <input class="input-number" type="text" value="{{$item->qty}}" min="1" max="10" readonly>
                                                <span class="input-number-increment">+</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-3 mt-md-0 d-none justify-content-center d-md-flex">
                                            <div class="mt-2">
                                                <h6 class="product-price">${{$item->model->price}}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-3 mt-md-0 d-flex justify-content-center h-100 align-content-center">
                                            <div class="mt-2">
                                                <h6 class="product-subtotal">${{$item->model->price * $item->qty}}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <form action="{{route('cart.product.delete', $item->rowId)}}" method="POST" id="{{$item->rowId}}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            <button type="submit" form="{{$item->rowId}}" class="mt-2 cart-product-delete" aria-label="Delete" ><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card" style="margin-bottom: 30px;border: 0;">
                                            <div class="card-body" style="background: transparent;">
                                                <div class="col-sm-12 empty-cart-cls text-center">
                                                    <img src="https://cdn.dribbble.com/users/204955/screenshots/4930541/emptycart.png" class="img-fluid mb-1 mr-3 empty">
                                                    <h3><strong>Your Cart is Empty</strong></h3>
                                                    <a href="{{route('products.category.search', 'fitness')}}" type="button" class="btn btn-custom mt-3">Continue Shopping</a>
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
        </div>

    </div>
@endsection
@section('scripts')
    @parent
@endsection
