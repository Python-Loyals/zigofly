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
                        <nav class="breadcrumb bg-transparent">
                            <a class="breadcrumb-item" href="/" aria-label="Home">
                                <i class="fa fa-home"></i>
                            </a>
                            <a class="breadcrumb-item" href="#">Customer Adresses</a>
                        </nav>
                    </div>

                </div>

                <div class="row  m-b-30">
                    <div class="col-lg-12">
                        <div class="au-card recent-report">
                            <div class="au-card-inner">
                                <p>Your Addresses</p>
                                <hr>

                                <div class="container">
                                    @if(isset($addresses))
                                        @php
                                        $usFlag = asset('account/images/usflag.png');
                                        $ukFlag = asset('account/images/ukflag.png')
                                        @endphp
                                        @foreach($addresses as $address)
                                            <div class="row">
                                                <div class="col-lg-4 bbb_adv_col">
                                                    <!-- bbb_adv Item -->
                                                    <div class="">
                                                        <div class="">
                                                            <div class=""><img src="{{$address->country == 'United States' ? $usFlag: $ukFlag}}" alt="usflag"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 bbb_adv_col">
                                                    <!-- bbb_adv Item -->
                                                    <div class="col-lg-12">
                                                        <table class="table table-sm">
                                                            <thead>
                                                            <tr>
                                                                <th scope="row">{{$address->country}} Address</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>Name:</td>
                                                                <td id="text1">{{request()->user()->name.' '.$address->name_suffix}}</td>
                                                                <th scope="row"><button class="btn btn-sm" data-clipboard-text="{{request()->user()->name.' '.$address->name_suffix}}" data-clipboard-action="copy"><i class="fas fa-copy (alias)"></i></button></th>
                                                            </tr>
                                                            @if(isset($address->street_one, $address->street_two))
                                                                <tr>
                                                                    <td>Street Address 1:</td>
                                                                    <td>{{$address->street_one}}</td>
                                                                    <th scope="row"><button class="btn btn-sm" data-clipboard-text="{{$address->street_one}}" data-clipboard-action="copy"><i class="fas fa-copy (alias)"></i></button></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Street Address 2:</td>
                                                                    <td>{{$address->street_two}}</td>
                                                                    <th scope="row"><button class="btn btn-sm" data-clipboard-text="{{$address->street_two}}" data-clipboard-action="copy"><i class="fas fa-copy (alias)"></i></button></th>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td>Street Address:</td>
                                                                    <td>{{$address->street_one}}</td>
                                                                    <th scope="row"><button class="btn btn-sm" data-clipboard-text="{{$address->street_one}}" data-clipboard-action="copy"><i class="fas fa-copy (alias)"></i></button></th>
                                                                </tr>
                                                            @endif
                                                            @if(isset($address->city))
                                                                <tr>
                                                                    <td>City:</td>
                                                                    <td>{{$address->city}}</td>
                                                                    <th scope="row"><button class="btn btn-sm" data-clipboard-text="{{$address->city}}" data-clipboard-action="copy"><i class="fas fa-copy (alias)"></i></button></th>
                                                                </tr>
                                                            @endif

                                                            @if(isset($address->county))
                                                                <tr>
                                                                    <td>County:</td>
                                                                    <td>{{$address->county}}</td>
                                                                    <th scope="row"><button class="btn btn-sm" data-clipboard-text="{{$address->county}}" data-clipboard-action="copy"><i class="fas fa-copy (alias)"></i></button></th>
                                                                </tr>
                                                            @endif

                                                            @if(isset($address->state))
                                                                <tr>
                                                                    <td>State:</td>
                                                                    <td>{{$address->state}}</td>
                                                                    <th scope="row"><button class="btn btn-sm" data-clipboard-text="{{$address->state}}" data-clipboard-action="copy"><i class="fas fa-copy (alias)"></i></button></th>
                                                                </tr>
                                                            @endif

                                                            <tr>
                                                                <td>Zip Code: </td>
                                                                <td>{{$address->zip_code}}</td>
                                                                <th scope="row"><button class="btn btn-sm" data-clipboard-text="{{$address->zip_code}}" data-clipboard-action="copy"><i class="fas fa-copy (alias)"></i></button></th>
                                                            </tr>
                                                            <tr>
                                                                <td>Country:</td>
                                                                <td>{{$address->country}}</td>
                                                                <th scope="row"><button class="btn btn-sm" data-clipboard-text="{{$address->country}}" data-clipboard-action="copy"><i class="fas fa-copy (alias)"></i></button></th>
                                                            </tr>
                                                            <tr>
                                                                <td>Phone Number:</td>
                                                                <td>{{$address->phone}}</td>
                                                                <th scope="row"><button class="btn btn-sm" data-clipboard-text="{{$address->phone}}" data-clipboard-action="copy"><i class="fas fa-copy (alias)"></i></button></th>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
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
