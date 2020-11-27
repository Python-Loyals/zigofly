@extends('layouts.myadmin')
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
                            <a class="breadcrumb-item" href="#">Shipment</a>
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

                @include('partials.boxes')

                <div class="row">
                    <div class="col-lg-12">

                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table  table-striped table-earning">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Shipment ID</th>
                                    <th class="text-center">Invoice Due</th>
                                    <th class="text-center">Tracking #</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">ETA</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">1.</td>
                                    <td class="text-center">2020-08-29</td>
                                    <td class="text-center card-title">ZF0000001US</td>
                                    <td class="text-center">$312.00
                                        <a href="" class="paybtn btn btn-warning btn-sm">pay</a>
                                    </td>
                                    <td class="text-center">1456876</td>
                                    <td class="text-center card-title">ZF00US</td>
                                    <td class="text-center text-success">Delivered</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2.</td>
                                    <td class="text-center">2020-09-05</td>
                                    <td class="text-center">ZF0000002UK</td>
                                    <td class="text-center">$20.00
                                        <a href="" class="paybtn btn btn-warning btn-sm">pay</a>
                                    </td>
                                    <td class="text-center">890000</td>
                                    <td class="text-center text-warning">Shipped</td>
                                    <td class="text-center card-title">JAN -05 -2021</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3.</td>
                                    <td class="text-center">2020-08-29</td>
                                    <td class="text-center card-title">ZF0000001US</td>
                                    <td class="text-center">$20.00
                                        <a href="" class="paybtn btn btn-warning btn-sm">pay</a>
                                    </td>
                                    <td class="text-center">1456876</td>
                                    <td class="text-center text-success">Delivered</td>
                                    <td class="text-center text-success">TBD</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                @include('partials.popular_categories')

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
