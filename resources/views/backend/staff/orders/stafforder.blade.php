@extends('admin.admin_master')
@section('admin')
@section('title')
    Staff Order List
@endsection
<div class="page-content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Staff Order List </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Staff</li>
                        <li class="breadcrumb-item active">Staff Order List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Date</th>
                                        <th>Order No</th>
                                        <th>Staff Name</th>
                                        <th>Qty</th>
                                        <th>Net Amount</th>
                                        <th>Delivery Status</th>
                                        <th>Payment Status</th>
                                        <th>Payment Method</th>
                                        <th>NOTE</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyList">
                                    @php
                                        $serialNo = 1;
                                    @endphp
                                    @foreach ($stafforders as $item)
                                        <tr style="height: 25px;">
                                            <td>{{ $serialNo }}</td>
                                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                {{ $item->order_number }}
                                                @if ($item->invoice_no)
                                                    <div class="text-muted bg-light p-1">
                                                        <small>{{ $item->invoice_no }}</small>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->tot_Qty }}</td>
                                            <td>{{ round($item->amount) }}</td>
                                            <td>
                                                <label for="">
                                                    @if ($item->status == 'pending')
                                                        <span class="badge badge-pill badge-warning text-white"
                                                            style="background: #800080;"> Pending </span>
                                                    @elseif($item->status == 'confirmed')
                                                        <span class="badge badge-pill badge-warning text-white"
                                                            style="background: #0000FF;"> Confirm </span>
                                                    @elseif($item->status == 'processing')
                                                        <span class="badge badge-pill badge-warning text-white"
                                                            style="background: #FFA500;"> Processing </span>
                                                    @elseif($item->status == 'picked')
                                                        <span class="badge badge-pill badge-warning text-white"
                                                            style="background: #808000;"> Picked </span>
                                                    @elseif($item->status == 'shipped')
                                                        <span class="badge badge-pill badge-warning text-white"
                                                            style="background: #808080;"> Shipped </span>
                                                    @elseif($item->status == 'delivered')
                                                        <span class="badge badge-pill badge-warning text-white"
                                                            style="background: #008000;"> Delivered </span>
                                                    @elseif($item->status == 'cancelled')
                                                        <span class="badge badge-pill badge-warning text-white"
                                                            style="background: #80000b;"> Cancelled </span>
                                                    @elseif($item->status == 'returned')
                                                        <span class="badge badge-pill badge-warning text-white"
                                                            style="background: #80000b;"> Returned </span>
                                                    @endif
                                                </label>
                                                @if ($item->track_number)
                                                    <div class="text-muted bg-light p-1">
                                                        <small>{{ $item->track_number }}</small>
                                                    </div>
                                                @endif

                                            </td>
                                            <td>
                                                <label for="">
                                                    @if ($item->payment_status == 'paid')
                                                        <a class="badge badge-pill badge-success text-white"
                                                            href="{{ route('staff_order.unpaid_status.update', $item->id) }}">
                                                            Paid </a>
                                                    @else
                                                        <a class="badge badge-pill badge-danger text-white"
                                                            href="{{ route('staff_order.paid_status.update', $item->id) }}">
                                                            UnPaid </a>
                                                    @endif
                                                </label>
                                            </td>
                                            <td>{{ $item->payment_type }}</td>
                                            <td>{{ $item->note }}</td>
                                            <td>
                                                <a href="{{ route('stafforder.details', $item->id) }}"
                                                    class="btn btn-info" title="Update Data"><i
                                                        class="fa fa-eye"></i>Update</a>
                                            </td>
                                        </tr>
                                        @php
                                            $serialNo++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
