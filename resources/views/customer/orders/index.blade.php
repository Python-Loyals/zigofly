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
                            <a class="breadcrumb-item" href="#">Admin Pane</a>
                            <a class="breadcrumb-item" href="#">Customer Orders</a>
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
                    <div class="col-lg-12">

                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table  table-striped table-earning">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Order ID</th>
                                    <th class="text-center">Store</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Tracking #</th>
                                    <th class="text-center">Status</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($orders) && count($orders) > 0)
                                    @foreach($orders as $i => $order)
                                        <tr>
                                            <td class="text-center">{{$i+1}}</td>
                                            <td class="text-center">{{\Carbon\Carbon::parse($order->created_at)->format('Y-m-d')}}</td>
                                            <td class="text-center card-title" data-href="{{route('customer.users.orders.show', $order->id)}}">ZF{{sprintf('%07d',$order->id)}}US</td>
                                            <td class="text-center">amazon.com</td>
                                            <td class="text-center">${{$order->total}}</td>
                                            <td class="text-center card-title">ZF-US-{{sprintf('%04d',$order->id)}}</td>
                                            @php($status = 'Pending')
                                            @php($class = 'text-warning')
                                            @switch($order->status)
                                                @case(0)
                                                @php($status = 'Cancelled')
                                                @php($class = 'text-danger')
                                                @break
                                                @case(2)
                                                @php($status = 'Processed')
                                                @php($class = 'text-success')
                                                @break
                                            @endswitch
                                            <td class="text-center {{$class}}">
                                                {{$status}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">No previous orders</td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
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
