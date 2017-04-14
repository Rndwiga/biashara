@extends(config('mnara.views.layouts.master'))

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Orders <small>submitted orders</small></h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Status</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($orders))
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->orderNumber->order_number}}</td>
                                        <td>{{$order->order_status}}</td>
                                        <td>{{$order->product}}</td>
                                        <td>{{$order->quantity}}</td>
                                        <td>{{$order->unit_price}}</td>
                                        <td>{{$order->product_total_order}}</td>
                                        <td>{{$order->created_at->diffForhumans()}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection