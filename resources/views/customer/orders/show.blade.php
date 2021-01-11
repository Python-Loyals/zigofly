@extends('layouts.customer.customer')
@section('styles')
    <link rel="stylesheet" href="{{asset('account/css/checkout.css')}}">
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
                    <a class="breadcrumb-item" href="{{route('cart.index')}}">Orders</a>
                    <a class="breadcrumb-item" href="#">ZF{{sprintf('%07d',$order->id)}}US</a>
                </nav>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-9 col-12 -fs-14 shadow">
                <section class="bg-white color-default -pbxl -rad -shad -ofy-a">
                    <div class="st p-3 pb-1 text-uppercase">Order Summary</div>
                    <div class="hdr -plm -prm -ptl -pbl -flex -vh-center"><span class="text-uppercase -pan -mrxxs">
                            Your Order had </span> <span class="-pan">({{count($order->orderItems)}} {{count($order->orderItems) > 1 ? 'items': 'item'}})</span>
                    </div>
                    <div class="sum brdt -fs-13 -scroll-format" data-scrollbar>
                        @foreach($order->orderItems as $item)
                            @php($product = $item->product)
                            <div class="prod_sum brdb -pts -pbs -prm">
                                <div class="col-3 -mts">
                                    <img width="60" height="60" class="lazy image -loaded"
                                         src="{{$product->images[0]->link}}" data-src="{{$product->images[0]->link}}"
                                         alt="product image" title="{{$product->title}}" data-placeholder="placeholder_xs_1.jpg" />
                                </div>
                                <div class="col-9 -mts">
                                    <span class="-ellipsis-2">{{$product->title}}</span>
                                    <span class="-mts color-primary"><span data-currency-iso="USD">$</span>
                                        <span dir="ltr" data-price="{{$product->price}}">{{$product->price}}</span>
                                    </span>
                                    <div class="-mts"><span class="color-default-800">Qty:</span>&nbsp;{{$item->quantity}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="osh-resume  -fs-14 px-4 mt-5">
                        <div class="ft-subtotal color-default -pbm price_row -fs-14">
                            <span class="price_col-desc -fs-14">Subtotal</span>
                            <span class="price_col-value">
                                <span data-currency-iso="USD">$</span>
                                <span dir="ltr" data-price="{{$order->sub_total}}">{{$order->sub_total}}</span>
                            </span>
                            <span class="price_col-value not_applicable-box -b color-primary -hidden">N.A.</span>
                        </div>

                        <div class="applied-shipping ft-shipping-amount color-default -pbm price_row">
                            <span class="price_col-desc">Local delivery fees</span>
                            <span class="price_col-value -b -hidden">
                                <span data-currency-iso="KES">KSh</span> <span dir="ltr" data-price="379">379</span>
                            </span>
                            <span class="price_col-value not_applicable-box -b color-primary">N.A.</span>
                        </div>
                        <div class="applied-customs-fee -hidden color-default -pbm price_row ft-icf">
                            <span class="price_col-desc"><i class="osh-font-airplane -fs-12 -prxs"></i>International shipping and customs fees</span>
                            <span class="price_col-value -b"><span data-currency-iso="KES">KSh</span> <span dir="ltr" data-price="0">0</span> </span><span class="price_col-value not_applicable-box -b color-primary -hidden">N.A.</span>
                        </div>
                        <div class="cart-rules js-cart-rules ft-price-cart-rules"></div>
                        <div class="total ft-total brdt -ptl color-default -fwm">
                            Total
                            <div class="total-value color-primary -fs-17">
                                <span data-currency-iso="USD">$</span>
                                <span dir="ltr" data-price="{{$order->total}}">{{$order->total}}</span>
                            </div>
                            <div class="not_applicable-box color-primary -fs-17 -hidden">N.A.</div>
                        </div>
                    </div>

                    <div class="brdt -align-center -fwm -fs-14 -upp -ptxl -mtl">
                        <a class="color-primary" href="#">Track Order</a>
                    </div>
                </section>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    @parent
@endsection
