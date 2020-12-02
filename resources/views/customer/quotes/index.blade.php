@extends('layouts.customer.customer')
@section('styles')
    <link rel="stylesheet" href="{{asset('account/css/zigo.css')}}">
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
                                <form method="POST" id="quote-form" class="border rounded-10 shadow p-2">
                                    @csrf
                                    <table class="table table-borderless" cellpadding="2">
                                        <tbody>
                                        <tr class="d-md-table-row d-none fs-14 text-center">
                                            <td class="my-label">Product Name</td>
                                            <td class="my-label">Product Link</td>
                                            <td class="my-label">Quantity</td>
                                            <td class="my-label">Color/Size/Options</td>
                                        </tr>
                                        <tr>
                                            <td class="d-table-row d-md-table-cell">
                                                <div class="form-row mt-2 mt-md-0">
                                                    <div class="col-4 d-md-none d-flex fs-13 mt-auto mb-auto">
                                                        Product Name:
                                                    </div>
                                                    <div class="col-8 col-md-12 col-lg-12">
                                                        <input type="text" name="name[]" class="form-control form-rounded w-100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="d-table-row d-md-table-cell">
                                                <div class="form-row mt-2 mt-md-0">
                                                    <div class="col-4 d-md-none d-flex fs-13 mt-auto mb-auto">
                                                        Product Link:
                                                    </div>
                                                    <div class="col-8 col-md-12 col-lg-12">
                                                        <input type="text" name="link[]" class="form-control form-rounded w-100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="d-table-row d-md-table-cell">
                                                <div class="form-row mt-2 mt-md-0">
                                                    <div class="col-4 d-md-none d-flex fs-13 mt-auto mb-auto">
                                                        Quantity:
                                                    </div>
                                                    <div class="col-8 col-md-12 col-lg-12">
                                                        <input type="text" name="quantity[]" class="form-control form-rounded w-100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="d-table-row d-md-table-cell">
                                                <div class="form-row mt-2 mt-md-0">
                                                    <div class="col-5 d-md-none d-flex fs-12 mt-auto mb-auto">
                                                        Color/Size/Options:
                                                    </div>
                                                    <div class="col-7 col-md-10 col-lg-10">
                                                        <input type="text" name="options[]" class="form-control form-rounded w-100">
                                                    </div>
                                                    <div class="col-2 d-flex mt-2 mt-md-auto mb-auto ml-auto">
                                                        <button type="button" id="btn-add-row" class="btn ml-auto btn-outline-dark btn-default btn-circle">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="form-row px-3">
                                        <div class="col-md-8 order-1">
                                            <label class="fs-14 my-label">Special/other instructions (Leave blank if none)</label>
                                            <textarea class="form-control form-control-sm mb-1" rows="4"></textarea>
                                        </div>

                                        <div class="col-md-4 order-0 order-md-1 quote pt-3">
                                            <div class="custom-control custom-checkbox mb-1">
                                                <input type="checkbox" checked class="custom-control-input checkbox" id="b_Ship" name="b_Ship">
                                                <label class="custom-control-label" for="b_Ship">Buy & Ship</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-1">
                                                <input type="checkbox" class="custom-control-input checkbox" id="ship" name="ship">
                                                <label class="custom-control-label" for="ship">Ship only</label>
                                            </div>

                                            <div class="my-form-group">
                                                <label for="file" class="sr-only">
                                                    Attach file <i class="fa fa-plus-circle"></i>
                                                </label>
                                                <input type="file" id="file">
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
                                    <table class="table  table-striped table-earning">
                                        <thead>
                                        <tr>
                                            <th class="text-center" style="font-size: 13px;">Date</th>
                                            <th class="text-center" style="font-size: 13px;">Quote ID</th>
                                            <th class="text-center" style="font-size: 13px;">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center">1st June 2020</td>
                                            <td class="text-center"><strong>ZFQ-001</strong></td>
                                            <td class="text-center">
                                                $312.00
                                                <a href="" class="paybtn btn btn-warning btn-sm">pay</a>
                                            </td>
                                        </tr>
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
    <script src="https://clipboardjs.com/dist/clipboard.min.js" crossorigin="anonymous"></script>

    <script>
        $('button').tooltip({
            placement: 'bottom',
            trigger: 'click'
        });

        function setTooltip(btn, message) {
            $(btn).tooltip('hide')
                .attr('data-original-title', message)
                .tooltip('show');
        }

        function hideTooltip(btn) {
            setTimeout(function() {
                $(btn).tooltip('hide');
            }, 1000);
        }

        var clipboard = new ClipboardJS('.btn');

        clipboard.on('success', function(e) {
            setTooltip(e.trigger, 'Copied!');
            hideTooltip(e.trigger);
        });

        clipboard.on('error', function(e) {
            setTooltip(e.trigger, 'Failed!');
            hideTooltip(e.trigger);
        });
    </script>
@endsection
