@extends('layouts.customer.customer')
@section('styles')
    <link rel="stylesheet" href="{{asset('account/css/zigo.css')}}">
    <link rel="stylesheet" href="{{asset('account/css/quote.css')}}">
    <style>
        /*spin loader*/
        #loader {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 1;
            margin: -95px 0 0 -75px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #072448;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <nav class="breadcrumb bg-transparent p-0 py-md-3 mb-2 mb-md-0" style="font-size: 14px;">
                            <a class="breadcrumb-item" href="/" aria-label="Home">
                                <i class="fa fa-home"></i>
                            </a>
                            <a class="breadcrumb-item" href="#">Customer Dashboard</a>
                            <a class="breadcrumb-item" href="{{route('customer.users.quotes')}}">Quotes</a>
                            <a class="breadcrumb-item" href="#">ZFQ-{{sprintf('%04d', $quote->id)}}</a>
                        </nav>
                    </div>
                    <div class="col-12">
                        <div class="overview-wraps" style="font-size: 14px;">
                            <p>
                                <span style="font-size: 16px;" class="pr-2">Welcome, {{ucfirst(explode(' ', request()->user()->name)[0])}}</span>&nbsp;
                                <i class="fas fa-map-marker-alt"></i> {{\App\County::find(request()->user()->county)->name}}, Kenya
                            </p>
                        </div>
                    </div>
                </div>

                @include('partials.customer.boxes')

                <div class="row">
                    <div class="packsummary col-md-4 col-12 package-card">
                        <div class="row">
                            <div class="packname col-12 text-center pt-2">
                                <strong class="">Quote Details</strong>
                                <p>ZFQ-{{sprintf('%04d', $quote->id)}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="details col-lg-10 col-md-10 col-xs-10 col-sm-10">
                                <p>Quote Service: &ensp;
                                    <span class="info"> {{$quote->service == 2 ? 'Buy & Ship': 'Ship Only'}} </span></p>
                                @if($quote->status == 0)
                                    @if($quote->amount)
                                        <p>Quote Amount: &ensp;
                                            <span class="info">
                                            ${{$quote->amount}}
                                        </span>
                                        </p>
                                    @endif
                                    <p>Quote Status: &ensp;
                                        <span class="info">
                                            <button class="paybtn btn btn-danger btn-sm pt-1">Cancelled</button>
                                        </span>
                                    </p>
                                @elseif($quote->status == 2)
                                    <p>Quote Amount: &ensp;
                                        <span class="info">
                                            ${{$quote->amount}}
                                        </span>
                                    </p>
                                @elseif($quote->status == 1)
                                    <p>Quote Status: &ensp;
                                        <span class="info">
                                            <button class="paybtn btn btn-warning btn-sm pt-1">Pending</button>
                                        </span>
                                    </p>
                                @elseif($quote->status == 3)
                                    <p>Quote Amount: &ensp;
                                        <span class="info">
                                            ${{$quote->amount}}
                                        </span>
                                        <span class="info">
                                            <button class="paybtn btn btn-success btn-sm pt-1">Paid</button>
                                        </span>
                                    </p>

                                @endif
                                @if($quote->instructions)
                                    <p>Quote Instructions: &ensp;<span class="info"> {{$quote->instructions}} </span></p>
                                @endif
                            </div>
                        </div>
                        <hr>
                        @if(count($quote->services) > 0)
                            <h5 class="text-center mb-1">Services(s)</h5>
                            <hr>
                            <div class="">

                                @foreach($quote->services as $service)
                                    <div class="packplancard  standard mb-1">
                                        <p>Name: <spn class="info">{{$service->name}}</spn></p>
                                        <p>Price: <spn class="info">${{$service->price}}</spn></p>
                                        @if($service->description)
                                            <p>Description: <spn class="info">{{$service->description}}</spn></p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <hr>
                        @if(count($quote->getMedia('attachment')) > 0)
                            <h5 class="text-center mb-1">Attachment(s)</h5>
                            <hr>
                            <div class="">

                                @foreach($quote->getMedia('attachment') as $attachment)
                                    <div class="file col-12">
                                        <a href="{{$attachment->getFullUrl()}}" download class="field">
                                            <i class="fa fa-download"></i>
                                        </a>
                                        <div class="text">
                                            <i class="fa fa-file{{str_contains($attachment->mime_type, 'image/') ? '-image':''}} icon"></i>
                                            <span class="filename">{{$attachment->name}}</span>
                                            <span class="sizes">({{$attachment->humanReadableSize}})</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div><br>

                    <div class="packplan col-md-4 col-12 package-card pt-3">
                        <h5 class="text-center mb-2">Quote products</h5>
                        @foreach($quote->products as $product)
                            <div class="{{$loop->odd ? 'standard':'express'}} packplancard">
                                <a href="{{$product->link}}" target="_blank" rel="noopener noreferrer"
                                   class="h6 text-uppercase"><strong>{{$product->name}}</strong> <i class="fa fa-external-link-alt ml-1" aria-hidden="false"></i></a>
                                <p>Quantity: <spn class="info">{{$product->quantity}}</spn></p>
                                <p>Options: <span class="info">{{$product->options}}</span></p>
                                @if($product->status == 0)
                                    <p>Product Status: <span class="info text-danger">Not Found</span></p>
                                @elseif($product->status == 1)
                                    <p>Product Status: <span class="info text-warning">Pending</span></p>
                                @elseif($product->status == 2)
                                    <p>Unit Price:
                                        <span class="info">${{$product->price}}</span></p>
                                @endif
                            </div><br>
                        @endforeach
                    </div><br>

                    @if($quote->status == 2)
                        <div class="packdetails col-md-3 col-12  package-card">
                            {{--                        <div class="packdetailsshipment-info packdetailscard">--}}
                            {{--                            <center><p><strong>Shipment Info</strong></p></center>--}}
                            {{--                            <p>Number of Packages:&ensp;<strong>2</strong></p>--}}
                            {{--                            <p>Shipping Fee:&ensp;<strong>$ 55.00</strong></p>--}}
                            {{--                            <form>--}}
                            {{--                                <label for="promocode">Promo Code:</label>--}}
                            {{--                                <input type="text" id="promocode" name="promocode"><br>--}}
                            {{--                            </form>--}}
                            {{--                        </div><br>--}}
                            <div class="packaddress">
                                <button class="btnlink">Zigofly Wallet
                                    <img src="{{asset('account/images/banners/financial.png')}}">
                                </button>
                            </div><br>
                            <div class="packaddress">
                                <button class="" data-toggle="modal" data-target="#confirm-modal-{{$quote->id}}">
                                    <img src="{{asset('account/images/banners/mpesa.png')}}">
                                </button>
                            </div> <br>
                        </div><br>
                    @endif
                </div>


                @include('partials.customer.popular_categories')

            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>
    <livewire:customer.quote-pay-modal :quote="$quote" />
@endsection
