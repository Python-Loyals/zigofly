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
                                    <th>#</th>
                                    <th>Quote ID</th>
                                    <th>Customer</th>
                                    <th>Service</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Attachment(s)</th>
                                    <th>Instructions</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($quotes as $i => $quote)
                                    <tr data-entry-id="{{ $quote->id }}">
                                        <td>

                                        </td>
                                        <td>{{$i + 1}}</td>
                                        <td data-href="{{route('admin.estimates.show', $quote->id)}}"
                                            class="font-weight-bold text-dark" >
                                            ZFQ-{{sprintf("%04d",$quote->id)}}
                                        </td>
                                        <td data-href="{{route('admin.customers.show', $quote->customer->id)}}">
                                            {{$quote->customer->name ?? ''}}
                                        </td>
                                        <td>
                                            {{$quote->service == 2 ? 'Buy & Ship': 'Ship Only'}}
                                        </td>
                                        <td>{{$quote->amount ?? '__'}}</td>
                                        @php($status = 'Pending')
                                        @php($class = 'text-warning')
                                        @switch($quote->status)
                                            @case(2)
                                            @php($status = 'Cancelled')
                                            @php($class = 'text-danger')
                                            @break
                                            @case(1)
                                            @php($status = 'Processed')
                                            @php($class = 'text-success')
                                            @break
                                        @endswitch
                                        <td class="{{$class}}">
                                            {{$status}}
                                        </td>
                                        <td>
                                            {{count($quote->getMedia('attachment'))}}
                                        </td>
                                        <td>
                                            {{$quote->instruction ?? ''}}
                                        </td>
                                        <td>{{$quote->created_at ?? ''}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{ route('admin.orders.show', $quote->id) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                            <form action="{{ route('admin.estimates.destroy', $quote->id) }}"
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
                order: [[ 1, 'asc' ]],
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
