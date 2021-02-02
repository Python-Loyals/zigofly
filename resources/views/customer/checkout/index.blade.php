@extends('layouts.customer.customer')
@section('styles')
    <link rel="stylesheet" href="{{asset('account/css/checkout.css')}}">
@endsection
@section('content')
    @if(Cart::count() < 1)
        <script>
            window.location.href = '{{route('cart.index')}}';
        </script>
    @endif
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid  p-sm-l-10 p-sm-r-10">
                <div class="row d-md-flex d-none pl-1>
                    <div class="col-12">
                <nav class="breadcrumb bg-transparent">
                    <a class="breadcrumb-item" href="/" aria-label="Home">
                        <i class="fa fa-home"></i>
                    </a>
                    <a class="breadcrumb-item" href="{{route('cart.index')}}">Cart</a>
                    <a class="breadcrumb-item" href="#">Checkout</a>
                </nav>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-12 col-md-8">
                <div class="bg-light py-2 rounded">
                    <div class="h6 ml-3 d-flex">
                        <div>
                            1. Address Details
                        </div>
                        <div class="js-address-change -link text-uppercase ml-auto">Change</div>
                    </div>
                    <div class="content">
                        <div class="cont brdt">
                            <div class="color-default -fwm ft-address-name">{{Auth::user()->name}}</div>
                            <div class="color-default-800 -fs-13">
                                <div class="-block ft-address-location">{{\App\County::find(Auth::user()->county)->name}}, Kenya</div>
                                <div class="-block ft-address-phone">{{Auth::user()->phone}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-light py-2 mt-4 rounded">
                    <div class="h6 ml-3 d-flex">
                        <div>
                            2. Delivery Details
                        </div>
                    </div>
                    <div id="shipping-methods" class="osh-opc-shipping-methods-form ft-shipping-methods">
                        <div class="subt color-default -pbm -fwm -fs-14">How do you want your order delivered?</div>
                        <div class="list list-options -mbl">
                            <div class="list--item list--item-options -ptxl -pbxl brdb">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input id="PickupStation" type="radio" class="custom-control-input osh-radio" value="PickupStation" rel="Pickup Station" data-address-name="" checked="checked" name="ShippingMethodForm[shipping_method]">
                                    <label class="-fwm custom-control-label" for="PickupStation">Pickup Station</label>
                                </div>
                                <div class="range color-default-800 -fs-13 -plxxxl -prxxxl">Ready for pick up between
                                    <span class="-fwm color-default">Saturday 10 Oct</span> and <span class="-fwm color-default">
                                                        Friday 16 Oct</span>
                                </div>
                                <div id="select-pickupstation-btn" class="text-underline color-primary -b -mtm -inline-block -mlxxxl -mrxxxl -pointer">
                                    Know More
                                </div>

                            </div>
                        </div>

                        <div class="osh-resume -mtxl -plm -prm">
                            <div class="ft-subtotal color-default -pbm price_row ">
                                <span class="price_col-desc">Subtotal</span>
                                <span class="price_col-value">
                                    <span data-currency-iso="USD">$</span>
                                    <span dir="ltr" data-price="{{Cart::total()}}">{{Cart::total()}}</span>
                                </span>
                            </div>
                            <div class="color-default -pbm price_row ">
                                <span class="price_col-desc">VAT</span>
                                <span class="price_col-value">
                                    <span data-currency-iso="USD">$</span>
                                    <span dir="ltr" data-price="{{Cart::tax()}}">
                                        {{Cart::tax()}}
                                    </span>
                                </span>
                            </div>
                            <div class="applied-shipping ft-shipping-amount color-default -pbm price_row ">
                                <span class="price_col-desc">Local delivery fees</span>
                                <span class="price_col-value">
                                    <span data-currency-iso="USD">$</span>
                                    <span dir="ltr" data-price="0">0</span>
                                </span>
                                <span class="price_col-value not_applicable-box -b color-primary -hidden">N.A.</span>
                            </div>
                            <div class="applied-customs-fee -hidden color-default -pbm price_row ft-icf">
                                <span class="price_col-desc">International shipping and customs fees</span>
                                <span class="price_col-value -b">
                                    <span data-currency-iso="KES">KSh</span> <span dir="ltr" data-price="0">0</span>
                                </span><span class="price_col-value not_applicable-box -b color-primary d-none">N.A.</span>
                            </div>

                            <div class="total ft-total brdt pt-3 color-default -fwm">
                                Total
                                <div class="total-value color-primary -fs-17 -hidden">
                                    <span data-currency-iso="KES">KSh</span> <span dir="ltr" data-price="1864">1,864</span>
                                </div>
                            </div>
                        </div>

                        <div id="paymentinfo" class="">
                            <center>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4><small>Pay</small> KES {{ceil(Cart::total() * 110)}}</h4>
                                    </div>
                                </div>
                                <div class="row mt-4 payinfo">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 payinfozigo mb-md-0 mb-2">
                                        <button class="btn btn-xs btn-dark ">
                                            Zigofly Wallet
                                        </button>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 payinfopesa" style="">
                                        <button class="btn btn-xs btn-dark payinfobtn"
                                                data-target="#checkout-modal" data-toggle="modal">
                                            <img class="payimg" style="" src="https://zigofly.brancetech.com/account/images/banners/mpesa.png" >
                                        </button>
                                    </div>
                                </div>
                            </center>

                        </div>

                        <button id="osh-opc-btn-save" class="osh-btn -p-l ft-save-and-continue-button  -full-width mt-4">
                            <span class="label ">Proceed to next step</span>
                        </button>

                    </div>
                </div>
            </div>
            <div class="col-md-4 d-none d-md-flex -fs-14">

                <section class="bg-white color-default -pbxl -rad -shad -ofy-a">
                    <div class="st p-3 pb-1 text-uppercase">Order Summary</div>
                    <div class="hdr -plm -prm -ptl -pbl -flex -vh-center"><span class="text-uppercase -pan -mrxxs">
                            Your Order</span> <span class="-pan">({{Cart::count()}} {{Cart::count() > 1 ? 'items': 'item'}})</span>
                    </div>
                    <div class="sum brdt -fs-13 -scroll-format" data-scrollbar>
                        @foreach(Cart::content() as $item)
                            <div class="prod_sum brdb -pts -pbs -prm">
                                <div class="col-3 -mts">
                                    <img width="60" height="60" class="lazy image -loaded"
                                         src="{{$item->model->images[0]->link}}" data-src="{{$item->model->images[0]->link}}"
                                         alt="{{$item->model->title}}" title="{{$item->model->title}}" data-placeholder="placeholder_xs_1.jpg" />
                                </div>
                                <div class="col-9 -mts">
                                    <span class="-ellipsis-2">{{$item->model->title}}</span>
                                    <span class="-mts color-primary"><span data-currency-iso="USD">$</span>
                                        <span dir="ltr" data-price="{{$item->model->price}}">{{$item->model->price}}</span>
                                    </span>
                                    <div class="-mts"><span class="color-default-800">Qty:</span>&nbsp;{{$item->qty}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="osh-resume -mtxl -fs-14 px-4">
                        <div class="ft-subtotal color-default -pbm price_row -fs-14">
                            <span class="price_col-desc -fs-14">Subtotal</span>
                            <span class="price_col-value">
                                <span data-currency-iso="USD">$</span>
                                <span dir="ltr" data-price="{{Cart::total()}}">{{Cart::total()}}</span>
                            </span>
                            <span class="price_col-value not_applicable-box -b color-primary -hidden">N.A.</span>
                        </div>
                        <div class="color-default -pbm price_row">
                            <span class="price_col-desc">VAT</span>
                            <span class="price_col-value">
                                <span data-currency-iso="USD">$</span>
                                <span dir="ltr" data-price="{{Cart::tax()}}">{{Cart::tax()}}</span>
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
                                <span dir="ltr" data-price="{{Cart::total()}}">{{Cart::total(null, null, ',')}}</span>
                            </div>
                            <div class="not_applicable-box color-primary -fs-17 -hidden">N.A.</div>
                        </div>
                    </div>
                    <div class="brdt -align-center -fwm -fs-14 -upp -ptxl -mtl">
                        <a class="color-primary" href="{{route('cart.index')}}">Modify Cart</a>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <livewire:customer.mpesa-checkout-modal />
@endsection
@section('scripts')
    @parent
    <script>
        $('#osh-opc-btn-save').on('click', function () {
            $('#paymentinfo, #back').slideToggle();
        });
        $('#back').on('click', function () {
            $('#paymentinfo, #back').slideToggle();
        });
    </script>
@endsection
