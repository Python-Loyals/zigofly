@extends('layouts.admin.app')
@section('styles')
    @parent
    <link href="{{asset('/account/css/cart.css')}}" rel="stylesheet" />
    <style>
        .form-control-sm{
            width: 120px;
            height: 38px;
            padding: 0 12px;
            vertical-align: top;
            text-align: center;
            outline: none;
        }
        select.status{
            width: 130px;
            height: 38px;
        }
        #btn-add-service{
            color: #072448;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.15);
            background-position: center;
            transition: background 0.8s;
        }

        #btn-add-service:focus,
        #btn-add-service:active{
            outline: none;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.19);
        }
    </style>
@endsection
@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <form action="{{route('admin.estimates.update', $quote->id)}}" method="POST" id="quote-form">
                @csrf
                @method('put')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <nav class="breadcrumb bg-transparent">
                                <a class="breadcrumb-item" href="#" aria-label="Home">
                                    <i class="fa fa-home"></i>
                                </a>
                                <a class="breadcrumb-item" href="{{route('admin.home')}}">Admin Panel</a>
                                <a class="breadcrumb-item" href="{{route('admin.orders.index')}}">Estimates</a>
                                <a class="breadcrumb-item" href="{{route('admin.orders.show', $quote->id)}}">
                                    ZFQ-{{sprintf('%04d',$quote->id)}}
                                </a>
                                <div class="ml-auto">
                                    @if($quote->status == 2)
                                        <aspan class="paybtn btn btn-success btn-sm">processed</aspan>
                                    @elseif($quote->status == 0)
                                        <span class="paybtn btn btn-danger btn-sm pt-1">cancelled</span>
                                    @else
                                        <span class="paybtn btn btn-warning btn-sm pt-1">Pending</span>
                                    @endif
                                </div>
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
                                {{$quote->customer->name}}
                            </p>
                        </div>
                        <div class="col-md-3 col-6 b-r"> <strong>Mobile</strong>
                            <br>
                            <p class="text-muted">
                                {{$quote->customer->phone}}
                            </p>
                        </div>
                        <div class="col-md-3 col-6 b-r"> <strong>Email</strong>
                            <br>
                            <p class="text-muted">
                                {{$quote->customer->email}}
                            </p>
                        </div>
                        <div class="col-md-3 col-6"> <strong>Location</strong>
                            <br>
                            <p class="text-muted">{{$quote->customer->userCounty->name}}, Kenya</p>
                        </div>
                    </div>
                    <hr>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row d-block d-md-none pt-3">
                        <div class="col-12 text-center">
                            <h4>Quote Products</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="mt-5 d-none d-md-block">
                        <div class="row">
                            <div class="col-md-3 d-flex justify-content-center">Name</div>
                            <div class="col-md-2 d-flex justify-content-center">Options</div>
                            <div class="col-md-1 d-flex justify-content-center">Qty</div>
                            <div class="col-md-2 d-flex justify-content-center">Status</div>
                            <div class="col-md-2 d-flex justify-content-center">Unit Price</div>
                            <div class="col-md-2 d-flex justify-content-center">Subtotal</div>
                        </div>
                        <div class="dropdown-divider"></div>
                    </div>

                    @php($quoteItems = $quote->products ?? [])

                    @forelse($quoteItems as $item)
                        <div class="row p-3 effects mb-3 mb-md-0" data-rowid="{{$item->id}}">
                            <div class="col-md-3 text-center">
                                <a href="{{$item->link ?? '#'}}" target="_blank" rel="noreferrer noopener"
                                   class="cart-item-title">
                                    {{$item->name}} <i class="fa fa-external-link-alt ml-1" aria-hidden="false"></i>
                                </a>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <div class="text-muted">
                                    <span class="price my-1 d-block d-md-none"></span>
                                    @if($item->options)
                                        <span class="ml-2 font-weight-light badge badge-warning">{{$item->options}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1 d-flex justify-content-center mt-3 mt-md-0">
                                {{$item->quantity}}
                            </div>
                            <div class="col-md-2 mt-3 mt-md-0 d-flex justify-content-center">
                                <select class="form-control status" name="products[{{$item->id}}][status]">
                                    <option value="0" {{$item->status == 0 ? 'selected':""}}>Not Found</option>
                                    <option value="1" {{$item->status == 1 ? 'selected':""}}>Pending</option>
                                    <option value="2" {{$item->status == 2 ? 'selected':""}}>Verified</option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-3 mt-md-0 d-flex justify-content-center">
                                <input type="text" class="form-control form-control-sm price"
                                       data-quantity="{{$item->quantity}}" {{$item->status == 0 ? 'readonly':''}}
                                       name="products[{{$item->id}}][price]" value="{{$item->price}}">
                            </div>
                            <div class="col-md-2 mt-3 mt-md-0 d-flex justify-content-center h-100 align-content-center">
                                <div class="mt-2">
                                    <h6 class="product-subtotal">
                                        ${{$item->price * $item->quantity}}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    @empty

                    @endforelse

                    <div class="services-header {{count($quote->services) > 0 ? '':'d-none'}}">
                        <div class="row pt-5">
                            <div class="col-12 text-center">
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
                        @foreach($quote->services as $service)
                            <div class="row p-3 effects mb-3 mb-md-0">
                                <div class="col-md-3 d-flex justify-content-center">
                                    {{$service->name}}
                                    <input type="text" class="form-control form-control-sm" hidden value="{{$service->name}}"
                                           name="old_services[{{$service->id}}][name]">
                                </div>
                                <div class="col-md-3 d-flex justify-content-center">
                                    ${{$service->price}}
                                    <input type="text" hidden class="service-costs" value="{{$service->price}}"
                                           name="old_services[{{$service->id}}][price]">
                                </div>
                                <div class="col-md-3 d-flex justify-content-center">
                                    {{$service->description}}
                                    <input type="text" hidden value="{{$service->description}}"
                                           name="old_services[{{$service->id}}][description]">
                                </div>
                                <div class="col-md-3 d-flex justify-content-center">
                                    <button class="mt-2 service-delete text-danger" aria-label="Delete" >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row my-3">
                        <div class="col-md-12">
                            <button type="button" id="btn-add-service" class="btn ml-auto btn-default"data-toggle="modal"
                                    data-target="#service-modal">
                                <i class="fa fa-plus-circle"></i> Add new service
                            </button>
                        </div>
                    </div>

                    @if(isset($quoteItems))
                        <div class="containers mb-5">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 py-3 pt-md-5 ml-auto bg-white">

                                    <div class="h5 font-weight-semibold text-center py-3">
                                        <div class="row">
                                            <div class="h6 font-weight-semibold row col-12">
                                                <div class="col-6 text-center">Subtotal:</div>
                                                <div class="col-6 text-center sub-total">${{$quote->amount ?? 0}}</div>
                                                <div class="col-12 my-1"></div>
                                                <div class="col-6 text-center">Tax:</div>
                                                <div class="col-6 text-center tax">${{$quote->tax ?? '0'}}</div>
                                                <div class="col-12"><hr></div>
                                            </div>

                                            <div class="col-6 text-center">Total:</div>
                                            <div class="col-6 text-center total">${{$quote->amount ?? 0}}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn bg-theme btn-block mt-3 text-light" data-toggle="modal"
                                            data-target="#complete-modal">
                                        <img src="{{asset('admin/images/icon/file.svg')}}" width="24" height="24" alt="">
                                        Save Quote
                                    </button>
                                    <button type="button" class="btn btn-danger btn-block mt-2" data-toggle="modal"
                                            data-target="#cancel-modal">
                                        <img src="{{asset('admin/images/icon/close.svg')}}" width="20" height="20" class="mr-1" alt="">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <style>
        .modal .btn-outline-secondary:hover{
            background-color: transparent;
            color: #6c757d;
        }
    </style>
    {{--  add service modal  --}}
    <div class="modal fade" id="service-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="service-form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email1">Service Name</label>
                            <input type="text" required class="form-control" name="name" placeholder="Provide service name e.g. Shopping Fee">
                        </div>
                        <div class="form-group">
                            <label for="password1">Price</label>
                            <input type="number" required name="service_cost" id="service-cost" class="form-control" placeholder="Service cost">
                        </div>
                        <div class="form-group">
                            <label for="password1">Description</label>
                            <textarea name="description" class="form-control description"></textarea>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit"
                            form="service-form"
                            class="btn bg-theme text-light">
                        Add Service</button>
                </div>
            </div>
        </div>
    </div>
    {{--   approve modal--}}
    <div id="complete-modal" class="modal fade" data-back="{{route('admin.orders.show', $quote->id)}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-theme">
                    <h4 class="modal-title text-light">Complete Order</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to process the quote?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit"
                            form="quote-form"
                            class="btn bg-theme text-light btn-quote-aprrove">
                        Confirm</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{--    cancel modal--}}
    <div id="cancel-modal" class="modal fade" data-back="{{route('admin.orders.show', $quote->id)}}" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-light">Cancel Quote</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel the quotation?</p>
                    <form id="quote_cancel_form" method="post" action="{{route('admin.orders.cancel', $quote->id)}}">
                        @csrf
                        @method('put')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" form="quote_cancel_form"
                            class="btn btn-danger text-light btn-order-cancel">
                        Confirm</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('select.status').on('change', function (){
                if ($(this).val() == 0){
                    $(this).parent().next().find('.price')
                        .val('0').prop('readonly', true)
                        .trigger('input')
                }else{
                    $(this).parent().next().find('.price')
                        .prop('readonly', false)
                }
            })
            $('.price, #service-cost').inputFilter(function(value) {
                return /^-?\d*[.,]?\d*$/.test(value)    // Allow digits only, using a RegExp
            });

            $('.price').on('input', function (){
                let qty = parseFloat($(this).data('quantity'));
                let price = parseFloat($(this).val()) || 0
                const lineSubTotal = qty * price

                $(this).parent().next().find('.product-subtotal').text(`$${lineSubTotal}`)
                if (price > 0){
                    $(this).parent().prev().find('select.status').val(2)
                }
                // else{
                //     $(this).parent().prev().find('select.status').val(0)
                // }
                updateTotals();
            })

            let services = {{count($quote->services)}}


            $('#service-form').on('submit', function (e){
                services++;
                e.preventDefault();
                let formData = {}
                $(this).serializeArray().map(item => formData[item.name] = item.value)
                let index = services
                $('.services-header').removeClass('d-none');
                appendService(formData.name, formData.service_cost, formData.description, index)
                $(this)[0].reset();
                $('#service-modal').modal('hide')
                updateTotals()
            });

            $('body').on('click', '.service-delete', function (){
                $(this).parent().parent().remove();
                updateTotals();
                if ($('.services').children().length == 0){
                    $('.services-header').addClass('d-none')
                }
            });



        });

        const updateTotals = () => {
            let total = 0;
            let subtotal = 0;
            $('input.price').each(function (){
                let qty = parseFloat($(this).data('quantity'));
                let price = parseFloat($(this).val()) || 0
                console.log(price)
                const lineSubTotal = qty * price
                subtotal += lineSubTotal
            });
            $('.service-costs').each(function (){
                let price = parseFloat($(this).val()) || 0
                subtotal += price
            })
            total += subtotal
            $('.sub-total').text(`$${subtotal}`)
            $('.total').text(`$${total}`)
        }

        const appendService = (name, price, description='', index) => {
            let html = `<div class="row p-3 effects mb-3 mb-md-0">
                        <div class="col-md-3 d-flex justify-content-center">
                            ${name}
                            <input type="text" hidden value="${name}" name="services[${index}][name]">
                        </div>
                        <div class="col-md-3 d-flex justify-content-center">
                            $${price}
                            <input type="text" hidden class="service-costs" value="${price}" name="services[${index}][price]">
                        </div>
                        <div class="col-md-3 d-flex justify-content-center">
                            ${description}
                            <input type="text" hidden value="${description}" name="services[${index}][description]">
                        </div>
                        <div class="col-md-3 d-flex justify-content-center">
                            <button class="mt-2 service-delete text-danger" aria-label="Delete" ><i class="fas fa-trash"></i></button>
                        </div>
                    </div>`;

            $('.services').append(html);
        }
    </script>
@endsection
