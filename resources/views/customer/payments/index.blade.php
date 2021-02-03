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
                            <a class="breadcrumb-item" href="#">Customer Payments</a>
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
                                    <th class="text-center">Payment For</th>
                                    <th class="text-center">Receipt Number</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Paid On</th>
                                    <th class="text-center">Status</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($payments) && count($payments) > 0)
                                    @foreach($payments as $payment)
                                        <tr>
                                            <td class="text-center">{{$loop->index + 1}}</td>
                                            @if(\App\Quote::class == $payment->payment->getMorphClass())
                                                <td class="text-center card-title"
                                                    data-href="{{route('customer.users.quotes.show', $payment->payment->id)}}">
                                                    ZFQ-{{sprintf('%07d',$payment->payment->id)}}US
                                                </td>
                                            @elseif(\App\Order::class == $payment->payment->getMorphClass())
                                                <td class="text-center card-title"
                                                    data-href="{{route('customer.users.orders.show', $payment->payment->id)}}">
                                                    ZFO-{{sprintf('%07d',$payment->payment->id)}}US
                                                </td>
                                            @endif

                                            <td class="text-center">amazon.com</td>
                                            <td class="text-center">{{$payment->amount}}</td>
                                            <td class="text-center">
                                                {{\Carbon\Carbon::parse($payment->created_at)->format('Y-m-d H:i:s')}}
                                            </td>
                                            @php($status = 'Un approved')
                                            @php($class = 'text-danger')
                                            @switch($payment->status)
                                                @case(1)
                                                @php($status = 'Approved')
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
                                        <td colspan="6" class="text-center">No payments yet</td>
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
