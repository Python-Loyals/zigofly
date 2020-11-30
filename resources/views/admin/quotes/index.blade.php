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

                @include('partials.boxes')

                <div class="row justify-content-center">
                    <div class="col-11">
                        <div class="row">
                            <div class="col-md-7 border rounded shadow">

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
