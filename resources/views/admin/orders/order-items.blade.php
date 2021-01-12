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
                            <a class="breadcrumb-item" href="#">Order Items</a>
                        </nav>
                    </div>
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <p>Welcome, {{ucfirst(explode(' ', Auth::user()->name)[0])}} &nbsp;<i class="fas fa-map-marker-alt"></i> Nairobi, Kenya</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-none d-md-block">
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

            </div>
        </div>
    </div>

@endsection
