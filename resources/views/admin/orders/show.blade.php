@extends('layouts.admin.app')
@section('styles')
    @parent
    <link href="{{asset('/account/css/cart.css')}}" rel="stylesheet" />
@endsection
@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <nav class="breadcrumb bg-transparent">
                            <a class="breadcrumb-item" href="#" aria-label="Home">
                                <i class="fa fa-home"></i>
                            </a>
                            <a class="breadcrumb-item" href="{{route('admin.home')}}">Admin Panel</a>
                            <a class="breadcrumb-item" href="{{route('admin.orders.index')}}">Orders</a>
                            <a class="breadcrumb-item" href="{{route('admin.orders.show', $order->id)}}">ZF-US-{{sprintf('%04d',$order->id)}}</a>
                        </nav>
                    </div>
                </div>

{{--                customer details--}}
                <h5>Customer Details</h5>
                <hr>
                <div class="row mt-3 mb-md-0 mb-3">
                    <div class="col-md-3 col-6 b-r"> <strong>Full Name</strong>
                        <br>
                        <p class="text-muted">
                            {{$order->customer->name}}
                        </p>
                    </div>
                    <div class="col-md-3 col-6 b-r"> <strong>Mobile</strong>
                        <br>
                        <p class="text-muted">
                            {{$order->customer->phone}}
                        </p>
                    </div>
                    <div class="col-md-3 col-6 b-r"> <strong>Email</strong>
                        <br>
                        <p class="text-muted">
                            {{$order->customer->email}}
                        </p>
                    </div>
                    <div class="col-md-3 col-6"> <strong>Location</strong>
                        <br>
                        <p class="text-muted">{{$order->customer->userCounty->name}}, Kenya</p>
                    </div>
                </div>
                <hr>

                <div class="row d-block d-md-none pt-3">
                    <div class="col-12 text-center">
                        <h4>Order Details</h4>
                        <hr>
                    </div>
                </div>
                <div class="mt-5 d-none d-md-block">
                    <div class="row">
                        <div class="col-md-5 d-flex justify-content-center">Item</div>
                        <div class="col-md-2 d-flex justify-content-center">Qty</div>
                        <div class="col-md-2 d-flex justify-content-center">Unit Price</div>
                        <div class="col-md-2 d-flex justify-content-center">Subtotal</div>
                    </div>
                    <div class="dropdown-divider"></div>
                </div>

                @php($orderItems = $order->orderItems ?? [])

                @forelse($orderItems as $item)
                    <div class="row p-3 effects" data-rowid="{{$item->id}}">
                        <div class="col-md-1 px-1">
                            <img src="{{$item->product->images[0]->link}}" class="img-responsive">
                        </div>
                        <div class="col-md-5">
                            <a href="{{$item->product->url ?? '#'}}" target="_blank" rel="noreferrer noopener" class="cart-item-title">{{$item->product->title}}</a>
                            <div class="text-muted">
                                <span class="price my-1 d-block d-md-none">${{$item->product->price}}</span>
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
                            {{$item->quantity}}
                        </div>
                        <div class="col-md-2 mt-3 mt-md-0 d-none justify-content-center d-md-flex">
                            <div class="mt-2">
                                <h6 class="product-price">${{$item->product->price}}</h6>
                            </div>
                        </div>
                        <div class="col-md-2 mt-3 mt-md-0 d-flex justify-content-center h-100 align-content-center">
                            <div class="mt-2">
                                <h6 class="product-subtotal">${{$item->product->price * $item->quantity}}</h6>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse

                @if(isset($orderItems))
                    <div class="container mb-5">
                        <div class="row">
                            <div class="container-fluid">
                                <div class="col-xl-4 col-md-6 py-3 pt-md-0 ml-auto bg-white">

                                    <div class="h5 font-weight-semibold text-center py-3">
                                        <div class="row">
                                            <div class="h6 font-weight-semibold row col-12">
                                                <div class="col-6 text-center">Subtotal:</div>
                                                <div class="col-6 text-center sub-total">${{$order->sub_total}}</div>
                                                <div class="col-12 my-1"></div>
                                                <div class="col-6 text-center">Tax:</div>
                                                <div class="col-6 text-center sub-total">${{$order->tax ?? '0'}}</div>
                                                <div class="col-12"><hr></div>
                                            </div>

                                            <div class="col-6 text-center">Total:</div>
                                            <div class="col-6 text-center total">${{$order->total}}</div>
                                        </div>
                                    </div>
                                    <a class="btn btn-primary btn-block mt-3" href="#">
                                        <img src="{{asset('admin/images/icon/file.svg')}}" width="24" height="24" alt="">
                                        Complete Order
                                    </a>
                                    <a class="btn btn-danger btn-block mt-2" href="#">
                                        <img src="{{asset('admin/images/icon/close.svg')}}" width="20" height="20" class="mr-1" alt="">
                                        Cancel Order
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
