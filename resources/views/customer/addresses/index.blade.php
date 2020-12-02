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
                            <a class="breadcrumb-item" href="#">Address</a>
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

                <div class="row  m-b-5 justify-content-center">
                    <div class="col-lg-11 col-12">
                        <div class="au-cards recent-report mb-0 pb-3">
                            <div class="au-card-inner">
                                <div class="container">
                                    <div class="row">
                                    @if(isset($addresses))
                                        @php
                                        $usFlag = asset('account/images/usflag.png');
                                        $ukFlag = asset('account/images/ukflag.png')
                                        @endphp
                                        @foreach($addresses as $address)
                                            <div class="col-md-6">
                                                <div class="text-center">
                                                    <img height="50" width="50" src="{{$address->country == 'United States' ? $usFlag: $ukFlag}}" alt="usflag">
                                                </div>
                                                <div class="w-100">

                                                    <div class="border border-dark shadow p-3 px-4 text-address">
                                                        <div class="row">
                                                            <p>Name: <strong>{{request()->user()->name.' '.$address->name_suffix}}</strong></p>
                                                            <button class="btn btn-outline-secondary btn-sm ml-auto " data-clipboard-text="{{request()->user()->name.' '.$address->name_suffix}}" data-clipboard-action="copy">Copy</button>
                                                        </div>

                                                        <div class="row">
                                                            <p>Street Address: <strong>{{$address->street_one}}</strong></p>
                                                            <button class="btn btn-outline-secondary btn-sm ml-auto " data-clipboard-text="{{$address->street_one}}" data-clipboard-action="copy">Copy</button>
                                                        </div>

                                                        <div class="row">
                                                            <p>City: <strong>{{$address->city}}</strong></p>
                                                            <button class="btn btn-outline-secondary btn-sm ml-auto " data-clipboard-text="{{$address->city}}" data-clipboard-action="copy">Copy</button>
                                                        </div>

                                                        @if(isset($address->county))
                                                            <div class="row">
                                                                <p>County: <strong>{{$address->county}}</strong></p>
                                                                <button class="btn btn-outline-secondary btn-sm ml-auto " data-clipboard-text="{{$address->county}}" data-clipboard-action="copy">Copy</button>
                                                            </div>
                                                        @endif

                                                        @if(isset($address->state))
                                                            <div class="row">
                                                                <p>State: <strong>{{$address->state}}</strong></p>
                                                                <button class="btn btn-outline-secondary btn-sm ml-auto " data-clipboard-text="{{$address->state}}" data-clipboard-action="copy">Copy</button>
                                                            </div>
                                                        @endif

                                                        <div class="row">
                                                            <p>Zip Code: <strong>{{$address->zip_code}}</strong></p>
                                                            <button class="btn btn-outline-secondary btn-sm ml-auto " data-clipboard-text="{{$address->zip_code}}" data-clipboard-action="copy">Copy</button>
                                                        </div>

                                                        <div class="row">
                                                            <p>Phone Number: <strong>{{$address->phone}}</strong></p>
                                                            <button class="btn btn-outline-secondary btn-sm ml-auto " data-clipboard-text="{{$address->phone}}" data-clipboard-action="copy">Copy</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @else
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <p>No addresses Found</p>
                                            </div>
                                        </div>
                                    @endif
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
