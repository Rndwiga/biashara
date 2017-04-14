@extends(config('mnara.views.layouts.master'))
@section('css')
    <style>
        .table > tbody > tr > .emptyrow {
            border-top: none;
        }

        .table > thead > tr > .emptyrow {
            border-bottom: none;
        }

        .table > tbody > tr > .highrow {
            border-top: 3px solid;
        }
    </style>
@endsection
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Orders</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            @if(isset($order_details))

            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="text-center"><strong>Order #{{$order_details['order_number']->orderNumber->order_number}}</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <td><strong>Item Name</strong></td>
                                    <td class="text-center"><strong>Item Price</strong></td>
                                    <td class="text-center"><strong>Item Quantity</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order_details['details'] as $order)
                                <tr>
                                    <td>{{$order->product}}</td>
                                    <td class="text-center">{{$order->unit_price}}</td>
                                    <td class="text-center">{{$order->quantity}}</td>
                                    <td class="text-right">{{$order->product_total_order}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong>Subtotal</strong></td>
                                    <td class="highrow text-right">
                                        {{isset($order_details)? $order_details['sub_total'] : null}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Tax</strong></td>
                                    <td class="emptyrow text-right">{{isset($order_details)? $order_details['tax'].'%' : null}}</td>
                                </tr>
                                <tr>
                                    <td class="emptyrow">
                                        <button class="btn btn-primary">submit</button>
                                        <button class="btn btn-danger">Delete</button>
                                    </td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Total</strong></td>
                                    <td class="emptyrow text-right">
                                        {{isset($order_details)? $order_details['total'] : null}}
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @endif
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <ul class="list-group">
                            <li  class="list-group-item list-group-item-info disabled">Order Number<span class="badge">Time Created</span></li>
                            @if(isset($order_numbers))
                                @foreach($order_numbers as $order)
                                    <a href="{{ route('biashara.order.show', $order->id) }}" class="list-group-item">
                                        {{$order->order_number}}
                                        <span class="badge">{{$order->created_at->diffForhumans()}}</span>
                                    </a>
                                @endforeach
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection