@extends('layouts.admin.app')
@section('styles')
    @parent
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
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
                            <a class="breadcrumb-item" href="#">Admin Panel</a>
                            <a class="breadcrumb-item" href="#">Customers</a>
                        </nav>
                    </div>
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <p>Welcome, {{ucfirst(explode(' ', Auth::user()->name)[0])}} &nbsp;<i class="fas fa-map-marker-alt"></i> Nairobi, Kenya</p>
                        </div>
                    </div>
                </div>

                @include('partials.admin.boxes1')

                <div class="row">
                    <div class="col-lg-12">
                        <!-- Customers TABLE --->
                        <div class="table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Order ID</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Customer Email</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Tracking #</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($orders as $i => $order)
                                    <tr data-entry-id="{{ $order->id }}">
                                        <td>

                                        </td>
                                        <td>{{$i + 1}}</td>
                                        <td data-href="{{route('admin.order-items', $order->id)}}" >ZF{{sprintf('%07d',$order->id)}}US</td>
                                        <td>{{$order->customer->name ?? ''}}</td>
                                        <td>{{$order->customer->email ?? ''}}</td>
                                        <td>${{$order->total ?? ''}}</td>
                                        <td>ZF-US-{{sprintf('%04d',$order->id)}}</td>
                                        <td>
                                            @switch($order->status)
                                                @case(1)
                                                Pending
                                                @break
                                            @endswitch
                                        </td>
                                        <td>{{$order->created_at ?? ''}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{ route('admin.orders.show', $order->id) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                            <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                  style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.delete') }}">
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="7">No Customers yet</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    @parent
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('customer.users.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 10,
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }, {
                    orderable: false,
                    searchable: false,
                    targets: -1
                }],
                select: {
                    style: 'multi+shift',
                    selector: 'td:first-child'
                },
                scrollX: true,
                dom: 'lBfrtip<"actions">',
                buttons: dtButtons
            });

            let table = $('.table-earning:not(.ajaxTable)').DataTable()

            console.log(table)
        })

    </script>
@endsection
