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
                        <div class="col-md-6 d-flex justify-content-center">Item</div>
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
                            @if(\App\Product::class == $item->product->getMorphClass())
                                <img src="{{$item->product->images[0]->link}}" class="img-responsive">
                            @endif
                        </div>
                        <div class="col-md-5">
                            @if(\App\Product::class == $item->product->getMorphClass())
                                <a href="{{$item->product->url ?? '#'}}" target="_blank" rel="noreferrer noopener" class="cart-item-title">
                                    {{$item->product->title}} <i class="fa fa-external-link-alt ml-1" aria-hidden="false"></i>
                                </a>
                            @else
                                <a href="{{$item->product->link ?? '#'}}" target="_blank" rel="noreferrer noopener"
                                   class="cart-item-title" style="font-size: 14px; text-decoration:underline;">
                                    {{$item->product->name}} <i class="fa fa-external-link-alt ml-1" aria-hidden="false"></i>
                                </a>
                            @endif

                            <div class="text-muted">
                                @if($item->options)
                                    @foreach($item->options as $key => $value)
                                        @if($key == 'quantity')
                                            @continue
                                        @endif
                                        <span>{{ucfirst($key)}}:
                                            <span class="ml-2 font-weight-semibold">
                                                {{$value}}
                                            </span>
                                        </span>
                                    @endforeach
                                @elseif($item->product->options)
                                    <span>Options:
                                            <span class="ml-2 font-weight-semibold">
                                                {{$item->product->options}}
                                            </span>
                                        </span>
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

                @if(count($order->orderItems) > 0)
                    @php($item = $order->orderItems[0])
                    @php($product = $item->product)
                    @if(\App\QuoteProduct::class == $product->getMorphClass() && count($product->quote->services) > 0)
                        <div class="services-header">
                            <div class="row pt-5">
                                <div class="col-12 text-left">
                                    <h4>Services</h4>
                                    <hr>
                                </div>
                            </div>
                            <div class="mt-1 d-none d-md-block">
                                <div class="row">
                                    <div class="col-md-3 d-flex justify-content-center">Name</div>
                                    <div class="col-md-3 d-flex justify-content-center">Price</div>
                                    <div class="col-md-3 d-flex justify-content-center">Description</div>
                                    <div class="col-md-3 d-flex justify-content-center"></div>
                                </div>
                                <div class="dropdown-divider my-0"></div>
                            </div>
                        </div>

                        <div class="services">
                            @foreach($product->quote->services as $service)
                                <div class="row p-3 effects mb-3 mb-md-0">
                                    <div class="col-md-3 d-flex justify-content-center">
                                        {{$service->name}}
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-center">
                                        ${{$service->price}}
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-center">
                                        {{$service->description}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif

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
                                    <button class="btn bg-theme btn-block mt-3 text-light" data-toggle="modal"
                                            data-target="#complete-modal">
                                        <img src="{{asset('admin/images/icon/file.svg')}}" width="24" height="24" alt="">
                                        Complete Order
                                    </button>
                                    <button class="btn btn-danger btn-block mt-2" data-toggle="modal"
                                            data-target="#cancel-modal">
                                        <img src="{{asset('admin/images/icon/close.svg')}}" width="20" height="20" class="mr-1" alt="">
                                        Cancel Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .modal .btn-outline-secondary:hover{
            background-color: transparent;
            color: #6c757d;
        }
    </style>
{{--   approve modal--}}
    <div id="complete-modal" class="modal fade" data-back="{{route('admin.orders.show', $order->id)}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-theme">
                    <h4 class="modal-title text-light">Complete Order</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you mark the order as complete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button"
                            data-link="{{route('admin.update_status')}}"
                            data-id="{{$order->id}}"
                            class="btn bg-theme text-light btn-order-complete">
                        Confirm</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
{{--    cancel modal--}}
    <div id="cancel-modal" class="modal fade" data-back="{{route('admin.orders.show', $order->id)}}" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-light">Cancel Order</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel the order?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button"
                            data-link="{{route('admin.update_status')}}"
                            data-id="{{$order->id}}"
                            class="btn btn-danger text-light btn-order-cancel">
                        Confirm</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
