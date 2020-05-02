@section('title')
    <title>Orders</title>
@endsection
@extends('layouts.adminLayout.adminMaster')

@section('css')

@endsection
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="#">Orders</a>
                <a href="{{route('admin.view_orders')}}" class="current">View Orders</a> </div>
            <h1>Orders</h1>
        </div>
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>View Orders</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Ordered Products</th>
                        <th>Order Amount</th>
                        <th>Order Status</th>
                        <th>Payment Method</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr class="gradeX">
                            <td>{{$order->id}}</td>
                            <td class="create-date" data-date="{{$order->created_at}}"></td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->user_email}}</td>
                            <td>
                                @foreach($order->Products as $product)
                                    <a href="{{route('admin.edit_product',['id'=>$product->product_id])}}">{{$product->product_code}} ({{$product->product_quntity}})</a><br>
                                @endforeach
                            </td>
                            <td class="grand_total" data-total="{{$order->grand_total}}" data-coupon-amount="{{$order->coupon_amount}}"></td>
                            <td>{{$order->order_status}}</td>
                            <td>{{$order->payment_method}}</td>
                            <td class="center">
                                <a href="{{route('admin.order_details',['id' => $order->id])}}" class="btn btn-success btn-mini" title="View Order Details">View</a>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>

        $(document).ready(function() {
            $('.grand_total').each(function () {
                $(this).text('$ ' + ((parseInt($(this).data('total')) - parseInt($(this).data('coupon-amount'))).toLocaleString()));
                var d = $(this).parent().find("td.create-date").data('date');
                var parts = d.split(" ");
                var times = parts[1].split(":");
                var dates = parts[0].split("-");
                $(this).parent().find("td.create-date").html(dates[0]+"-"+dates[1]+"-"+dates[2] +" "+ times[0] +":"+ times[1]);
            });
        });

    </script>
@endsection
