@extends('layouts.customer.customer')
@section('styles')
    @parent
    <link rel="stylesheet" href="{{asset('account/css/zigo.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">
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
                            <a class="breadcrumb-item" href="#">Quote</a>
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

                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-7">
                                <form method="POST" id="quote-form" action="{{route('customer.users.quotes.store')}}" enctype="multipart/form-data" class="border rounded-10 shadow p-2">
                                    @csrf
                                    <table class="table table-borderless" cellpadding="2">
                                        <tbody>
                                        <tr class="d-md-table-row d-none fs-14 text-center">
                                            <td class="my-label">Product Name</td>
                                            <td class="my-label">Product Link</td>
                                            <td class="my-label">Quantity</td>
                                            <td class="my-label">Color/Size/Options</td>
                                        </tr>
                                        @if(count(old()) > 0)
                                            @php($i = 0)
                                            @foreach(old('products') as $row)
                                                <tr>
                                                    <td class="d-table-row d-md-table-cell">
                                                        <div class="form-row mt-2 mt-md-0">
                                                            <div class="col-4 d-md-none d-flex fs-13 mt-auto mb-auto">
                                                                Product Name:
                                                            </div>
                                                            <div class="col-8 col-md-12 col-lg-12">
                                                                <input type="text" name="products[{{$i}}][name]" class="form-control form-rounded w-100 {{ $errors->has('products.'.$i.'.name') ? 'is-invalid' : '' }}" value="{{$row['name']}}">
                                                                @if($errors->has('products.'.$i.'.name'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('products.'.$i.'.name') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="d-table-row d-md-table-cell">
                                                        <div class="form-row mt-2 mt-md-0">
                                                            <div class="col-4 d-md-none d-flex fs-13 mt-auto mb-auto">
                                                                Product Link:
                                                            </div>
                                                            <div class="col-8 col-md-12 col-lg-12">
                                                                <input type="text" name="products[{{$i}}][link]" class="form-control form-rounded w-100 {{ $errors->has('products.'.$i.'.link') ? 'is-invalid' : '' }}" value="{{$row['link']}}">
                                                                @if($errors->has('products.'.$i.'.link'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('products.'.$i.'.link') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="d-table-row d-md-table-cell">
                                                        <div class="form-row mt-2 mt-md-0">
                                                            <div class="col-4 d-md-none d-flex fs-13 mt-auto mb-auto">
                                                                Quantity:
                                                            </div>
                                                            <div class="col-8 col-md-12 col-lg-12">
                                                                <input type="text" name="products[{{$i}}][quantity]" class="form-control form-rounded w-100 {{ $errors->has('products.'.$i.'.quantity') ? 'is-invalid' : '' }}" value="{{$row['quantity']}}">
                                                                @if($errors->has('products.'.$i.'.quantity'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('products.'.$i.'.quantity') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="d-table-row d-md-table-cell">
                                                        <div class="form-row mt-2 mt-md-0">
                                                            <div class="col-5 d-md-none d-flex fs-12 mt-auto mb-auto">
                                                                Color/Size/Options:
                                                            </div>
                                                            <div class="col-7 col-md-10 col-lg-10">
                                                                <input type="text" name="products[{{$i}}][options]" class="form-control form-rounded w-100">
                                                            </div>
                                                            <div class="col-2 d-flex mt-2 mt-md-auto mb-auto ml-auto">
                                                                <button type="button" id="{{($i == count(old('products')) - 1) ? 'btn-add-row':''}}" class="btn ml-auto btn-outline-dark btn-default btn-circle {{($i == count(old('products')) - 1) ? '':'btn-minus-row'}}" value="{{$row['options']}}">
                                                                    <i class="fa fa-{{($i == count(old('products')) - 1) ? 'plus' : 'minus'}}"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php($i++)
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="d-table-row d-md-table-cell">
                                                    <div class="form-row mt-2 mt-md-0">
                                                        <div class="col-4 d-md-none d-flex fs-13 mt-auto mb-auto">
                                                            Product Name:
                                                        </div>
                                                        <div class="col-8 col-md-12 col-lg-12">
                                                            <input type="text" name="products[0][name]" class="form-control form-rounded w-100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="d-table-row d-md-table-cell">
                                                    <div class="form-row mt-2 mt-md-0">
                                                        <div class="col-4 d-md-none d-flex fs-13 mt-auto mb-auto">
                                                            Product Link:
                                                        </div>
                                                        <div class="col-8 col-md-12 col-lg-12">
                                                            <input type="text" name="products[0][link]" class="form-control form-rounded w-100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="d-table-row d-md-table-cell">
                                                    <div class="form-row mt-2 mt-md-0">
                                                        <div class="col-4 d-md-none d-flex fs-13 mt-auto mb-auto">
                                                            Quantity:
                                                        </div>
                                                        <div class="col-8 col-md-12 col-lg-12">
                                                            <input type="text" name="products[0][quantity]" class="form-control form-rounded w-100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="d-table-row d-md-table-cell">
                                                    <div class="form-row mt-2 mt-md-0">
                                                        <div class="col-5 d-md-none d-flex fs-12 mt-auto mb-auto">
                                                            Color/Size/Options:
                                                        </div>
                                                        <div class="col-7 col-md-10 col-lg-10">
                                                            <input type="text" name="products[0][options]" class="form-control form-rounded w-100">
                                                        </div>
                                                        <div class="col-2 d-flex mt-2 mt-md-auto mb-auto ml-auto">
                                                            <button type="button" id="btn-add-row" class="btn ml-auto btn-outline-dark btn-default btn-circle">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="form-row px-3">
                                        <div class="col-md-8 order-1">
                                            <label class="fs-14 my-label">Special/other instructions (Leave blank if none)</label>
                                            <textarea class="form-control form-control-sm mb-1 {{ $errors->has('instructions') ? 'is-invalid' : '' }}" name="instructions" rows="4"></textarea>
                                            @if($errors->has('instructions'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('instructions') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-4 order-0 order-md-1 quote pt-3">
                                            <div class="custom-control custom-checkbox mb-1">
                                                <input type="checkbox" checked class="custom-control-input checkbox" id="buy_ship" name="buy_ship">
                                                <label class="custom-control-label" for="buy_ship">Buy & Ship</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-1">
                                                <input type="checkbox" class="custom-control-input checkbox" id="ship" name="ship">
                                                <label class="custom-control-label" for="ship">Ship only</label>
                                            </div>

                                            <div class="my-form-group">
                                                <label for="file" class="sr-only">
                                                    Attach file <i class="fa fa-plus-circle"></i>
                                                </label>
                                                <input type="file" id="file" multiple name="attachments[]" accept="image/gif,image,jpg,image/jpeg,image/png,application/pdf,application/docx,application/doc">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-lg-8 col-md-8 text-right"></div>
                                        <div class="col-12 col-lg-4 col-md-4 text-right px-3 px-md-2 mt-3 mt-md-0">
                                            <button type="submit" class="btn btn-warning btn-block">Submit Quote</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-5 mt-3 mt-md-0 px-0 px-md-3">
                                <div class="table-responsive rounded-10 shadow">
                                    <style>
                                        .modal-backdrop{
                                            z-index: -1;
                                        }
                                    </style>
                                    <table class="table  table-striped table-earning">
                                        <thead>
                                        <tr>
                                            <th class="text-center" style="font-size: 13px;">Date</th>
                                            <th class="text-center" style="font-size: 13px;">Quote ID</th>
                                            <th class="text-center" style="font-size: 13px;">Amount</th>
                                            <th class="text-center" style="font-size: 13px;"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($quotes) && count($quotes) > 0)
                                            @foreach($quotes as $i => $quote)
                                                <tr>
                                                    <td class="text-center">{{\Carbon\Carbon::parse($quote->created_at)->format('jS M, Y')}}</td>
                                                    <td class="text-center">
                                                        <a href="{{route('customer.users.quotes.show', $quote->id)}}">ZFQ-{{sprintf("%04d",$quote->id)}}</a>
                                                    </td>
                                                    <td class="text-center">
                                                        {{$quote->amount?? '__'}}
                                                    </td>
                                                    <td>
                                                        @if($quote->status == 2)
                                                            <button href="#" class="paybtn btn btn-success btn-sm" data-toggle="modal" data-target="#confirm-modal-{{$quote->id}}">
                                                                pay
                                                            </button>
                                                            <livewire:customer.quote-pay-modal :quote="$quote" :key="$loop->index" />
                                                        @elseif($quote->status == 0)
                                                            <a href="#" class="paybtn btn btn-danger btn-sm pt-1">Cancelled</a>
                                                        @elseif($quote->status == 1)
                                                            <a href="#" class="paybtn btn btn-warning btn-sm pt-1">Pending</a>
                                                        @elseif($quote->status == 3)
                                                            <a href="#" class="paybtn btn btn-success btn-sm pt-1">Paid</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="text-center">
                                                    No Quotes
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                @include('partials.customer.popular_categories')

            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
    <script>
        $("select.phone").select2({
            tags: true,
            theme: 'bootstrap4',
        });
    </script>
@endsection
