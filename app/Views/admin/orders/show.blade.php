@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')

@endsection

@section('js')
@endsection

@section('js-init')
@endsection

@section('content')
    <?php
        $status = '<span class="label label-primary label-sm">Chưa giải quyết</span>';
        if ($transaction->status != 0 && $transaction->status != 2 && $transaction->status != 3) {
            $status = '<span class="label label-success label-sm">Đã giải quyết</span>';
        } else if($transaction->status != 0 && $transaction->status != 1 && $transaction->status != 3) {
            $status = '<span class="label label-warning label-sm">Giữ lại</span>';
        } else if($transaction->status != 0 && $transaction->status != 1 && $transaction->status != 2) {
            $status = '<span class="label label-danger label-sm">Hủy</span>';
        }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <!-- Begin: life time stats -->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-basket font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">
                        Order #{{ $transaction->id }} </span>
                        <span class="caption-helper">{{ $transaction->created_at }}</span>
                    </div>
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-default btn-circle">
                        <i class="fa fa-angle-left"></i>
                        <span class="hidden-480">
                        Back </span>
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-lg">
                            <li class="active">
                                <a href="#tab_1" data-toggle="tab">
                                Details </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="portlet yellow-crusta box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Order Details
                                                </div>
                                                <div class="actions">
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-5 name">
                                                         Order #:
                                                    </div>
                                                    <div class="col-md-7 value">
                                                        {{ $transaction->id }}
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name">
                                                        Order Date & Time:
                                                    </div>
                                                    <div class="col-md-7 value">
                                                        {{ $transaction->created_at }}
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name">
                                                         Order Status:
                                                    </div>
                                                    <div class="col-md-7 value">
                                                        {!! $status !!}
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name">
                                                        Grand Total:
                                                    </div>
                                                    <div class="col-md-7 value">
                                                        {{ _formatPrice($transaction->amount) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="portlet blue-hoki box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Customer Information
                                                </div>
                                                <!-- <div class="actions">
                                                    <a href="javascript:;" class="btn btn-default btn-sm">
                                                    <i class="fa fa-pencil"></i> Edit </a>
                                                </div> -->
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-5 name">
                                                        Customer Name:
                                                    </div>
                                                    <div class="col-md-7 value">
                                                        {{ $transaction->name }}
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name">
                                                        Email:
                                                    </div>
                                                    <div class="col-md-7 value">
                                                        {{ $transaction->email }}
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name">
                                                        Phone Number:
                                                    </div>
                                                    <div class="col-md-7 value">
                                                        {{ $transaction->phone }}
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name">
                                                        Note:
                                                    </div>
                                                    <div class="col-md-7 value">
                                                        {{ !is_null(trim($transaction->messages)) ? $transaction->messages : '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet grey-cascade box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Shopping Cart
                                                </div>
                                                <!-- <div class="actions">
                                                    <a href="javascript:;" class="btn btn-default btn-sm">
                                                    <i class="fa fa-pencil"></i> Edit </a>
                                                </div> -->
                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                             Product
                                                        </th>
                                                        <th>
                                                             Price
                                                        </th>
                                                        <th>
                                                             Quantity
                                                        </th>
                                                        <th>
                                                             Total
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($transaction->orders as $order)
                                                    <?php $p = $order->products; ?>
                                                    <?php $row = $p->productContent[0]; ?>
                                                    <tr>
                                                        <td>
                                                            <a href="{{ _getProductLink($row->slug) }}" target="_blank">
                                                            {{ $row->title }} 1 </a>
                                                        </td>
                                                        <td>
                                                            <span class="label label-sm label-success">
                                                            {{ _formatPrice($row->price) }}
                                                        </td>

                                                        <td>
                                                            {{ $order->qty }}
                                                        </td>
                                                        <td>
                                                            {{ _formatPrice($order->amount) }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="well">
                                            <!-- <div class="row static-info align-reverse">
                                                <div class="col-md-8 name">
                                                     Sub Total:
                                                </div>
                                                <div class="col-md-3 value">
                                                     $1,124.50
                                                </div>
                                            </div>
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name">
                                                     Shipping:
                                                </div>
                                                <div class="col-md-3 value">
                                                     $40.50
                                                </div>
                                            </div>
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name">
                                                     Grand Total:
                                                </div>
                                                <div class="col-md-3 value">
                                                     $1,260.00
                                                </div>
                                            </div>
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name">
                                                     Total Paid:
                                                </div>
                                                <div class="col-md-3 value">
                                                     $1,260.00
                                                </div>
                                            </div>
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name">
                                                     Total Refunded:
                                                </div>
                                                <div class="col-md-3 value">
                                                     $0.00
                                                </div>
                                            </div> -->
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name">
                                                     Total:
                                                </div>
                                                <div class="col-md-3 value">
                                                    {{ _formatPrice($transaction->amount) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <div class="table-container">
                                    <div class="table-actions-wrapper">
                                        <span>
                                        </span>
                                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                                            <option value="">Select...</option>
                                            <option value="pending">Pending</option>
                                            <option value="paid">Paid</option>
                                            <option value="canceled">Canceled</option>
                                        </select>
                                        <button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Submit</button>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="datatable_invoices">
                                    <thead>
                                    <tr role="row" class="heading">
                                        <th width="5%">
                                            <input type="checkbox" class="group-checkable">
                                        </th>
                                        <th width="5%">
                                             Invoice&nbsp;#
                                        </th>
                                        <th width="15%">
                                             Bill To
                                        </th>
                                        <th width="15%">
                                             Invoice&nbsp;Date
                                        </th>
                                        <th width="10%">
                                             Amount
                                        </th>
                                        <th width="10%">
                                             Status
                                        </th>
                                        <th width="10%">
                                             Actions
                                        </th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="order_invoice_no">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="order_invoice_bill_to">
                                        </td>
                                        <td>
                                            <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                <input type="text" class="form-control form-filter input-sm" readonly name="order_invoice_date_from" placeholder="From">
                                                <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                            <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                                <input type="text" class="form-control form-filter input-sm" readonly name="order_invoice_date_to" placeholder="To">
                                                <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="margin-bottom-5">
                                                <input type="text" class="form-control form-filter input-sm" name="order_invoice_amount_from" placeholder="From"/>
                                            </div>
                                            <input type="text" class="form-control form-filter input-sm" name="order_invoice_amount_to" placeholder="To"/>
                                        </td>
                                        <td>
                                            <select name="order_invoice_status" class="form-control form-filter input-sm">
                                                <option value="">Select...</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="canceled">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="margin-bottom-5">
                                                <button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button>
                                            </div>
                                            <button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Reset</button>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_3">
                                <div class="table-container">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_credit_memos">
                                    <thead>
                                    <tr role="row" class="heading">
                                        <th width="5%">
                                             Credit&nbsp;Memo&nbsp;#
                                        </th>
                                        <th width="15%">
                                             Bill To
                                        </th>
                                        <th width="15%">
                                             Created&nbsp;Date
                                        </th>
                                        <th width="10%">
                                             Status
                                        </th>
                                        <th width="10%">
                                             Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_4">
                                <div class="table-container">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_shipment">
                                    <thead>
                                    <tr role="row" class="heading">
                                        <th width="5%">
                                             Shipment&nbsp;#
                                        </th>
                                        <th width="15%">
                                             Ship&nbsp;To
                                        </th>
                                        <th width="15%">
                                             Shipped&nbsp;Date
                                        </th>
                                        <th width="10%">
                                             Quantity
                                        </th>
                                        <th width="10%">
                                             Actions
                                        </th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="order_shipment_no">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="order_shipment_ship_to">
                                        </td>
                                        <td>
                                            <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                <input type="text" class="form-control form-filter input-sm" readonly name="order_shipment_date_from" placeholder="From">
                                                <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                            <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                                <input type="text" class="form-control form-filter input-sm" readonly name="order_shipment_date_to" placeholder="To">
                                                <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="margin-bottom-5">
                                                <input type="text" class="form-control form-filter input-sm" name="order_shipment_quantity_from" placeholder="From"/>
                                            </div>
                                            <input type="text" class="form-control form-filter input-sm" name="order_shipment_quantity_to" placeholder="To"/>
                                        </td>
                                        <td>
                                            <div class="margin-bottom-5">
                                                <button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button>
                                            </div>
                                            <button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Reset</button>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_5">
                                <div class="table-container">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_history">
                                    <thead>
                                    <tr role="row" class="heading">
                                        <th width="25%">
                                             Datetime
                                        </th>
                                        <th width="55%">
                                             Description
                                        </th>
                                        <th width="10%">
                                             Notification
                                        </th>
                                        <th width="10%">
                                             Actions
                                        </th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td>
                                            <div class="input-group date datetime-picker margin-bottom-5" data-date-format="dd/mm/yyyy hh:ii">
                                                <input type="text" class="form-control form-filter input-sm" readonly name="order_history_date_from" placeholder="From">
                                                <span class="input-group-btn">
                                                <button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                            <div class="input-group date datetime-picker" data-date-format="dd/mm/yyyy hh:ii">
                                                <input type="text" class="form-control form-filter input-sm" readonly name="order_history_date_to" placeholder="To">
                                                <span class="input-group-btn">
                                                <button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="order_history_desc" placeholder="To"/>
                                        </td>
                                        <td>
                                            <select name="order_history_notification" class="form-control form-filter input-sm">
                                                <option value="">Select...</option>
                                                <option value="pending">Pending</option>
                                                <option value="notified">Notified</option>
                                                <option value="failed">Failed</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="margin-bottom-5">
                                                <button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button>
                                            </div>
                                            <button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Reset</button>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End: life time stats -->
        </div>
    </div>
@endsection
