@extends('layouts.customer.customer')
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
                                    <a href="{{route('customer.shop')}}" type="button" class="btn btn-custom pull-right">Continue Shopping</a>
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
            @if(Cart::count() > 0)
                <div class="container mb-5">
                    <div class="row">
                        <div class="container-fluid">
                            <div class="col-xl-4 col-md-6 py-3 pt-md-0 ml-auto bg-white">

                                <div class="h5 font-weight-semibold text-center py-3">
                                    <div class="row">
                                        <div class="h6 font-weight-semibold row col-12">
                                            <div class="col-6 text-center">Subtotal:</div>
                                            <div class="col-6 text-center sub-total">${{Cart::total()}}</div>
                                            <div class="col-12 my-1"></div>
                                            <div class="col-6 text-center">Tax:</div>
                                            <div class="col-6 text-center sub-total">${{Cart::tax()}}</div>
                                            <div class="col-12"><hr></div>
                                        </div>

                                        <div class="col-6 text-center">Total:</div>
                                        <div class="col-6 text-center total">${{Cart::total()}}</div>
                                    </div>
                                </div>
                                <a class="btn btn-primary btn-block" href="{{route('cart.checkout')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card mr-2">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                    </svg>Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
@section('scripts')
    @parent
@endsection
