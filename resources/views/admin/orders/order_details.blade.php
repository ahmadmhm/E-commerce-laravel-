@section('title')
    <title>Order</title>
@endsection
@extends('layouts.adminLayout.adminMaster')

@section('css')
    <link rel="stylesheet" href="{{asset('css/backend_css/uniform.css')}}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/dataTables.bootstrap4.min.css')}}" />
@endsection
@section('content')
    <!--main-container-part-->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{route('admin.view_orders')}}" class="current">Orders</a> </div>
            <h1>Order #{{$order->id}}</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title">
                            <h5>Order Details</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <td class="taskDesc"> Order Date</td>
                                    <td class="taskStatus">{{$order->created_at}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Order Status</td>
                                    <td class="taskStatus">{{$order->order_status}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Order Total</td>
                                    <td class="taskStatus">{{$order->grand_total}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Order Charges</td>
                                    <td class="taskStatus">{{$order->shipping_charges}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Coupon Code</td>
                                    <td class="taskStatus">{{$order->coupon_code == ' ' ?'': 'No Code'}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Coupon Amount</td>
                                    <td class="taskStatus">{{$order->coupon_amount}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Payment Method</td>
                                    <td class="taskStatus">{{$order->payment_method}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="accordion" id="collapse-group">
                        <div class="accordion-group widget-box">
                            <div class="accordion-heading">
                                <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                        <h5>Billing Address</h5>
                                    </a> </div>
                            </div>
                            <div class="collapse in accordion-body" id="collapseGOne">
                                <div class="widget-content">
                                Name : {{$order->User->name ?? 'No Name'}}<br>
                                Address : {{$order->User->Information->address ?? 'No Address'}}<br>
                                City : {{$order->User->Information->city ?? 'No City'}}<br>
                                State : {{$order->User->Information->state ?? 'No State'}}<br>
                                Country : {{$order->User->Information->Country->country_name ?? 'No Country'}}<br>
                                Pincode : {{$order->User->Information->pincode ?? 'No Pincode'}}<br>
                                Mobile : {{$order->User->Information->mobile ?? 'No Mobile'}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title">
                            <h5>Customer Details</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <td class="taskDesc"><i class="icon-info-sign"></i> Customer Name</td>
                                    <td class="taskStatus">{{$order->name}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc"><i class="icon-plus-sign"></i>Customer Email</td>
                                    <td class="taskStatus">{{$order->user_email}}</td>

                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="widget-box">
                        <div class="widget-title">
                            <h5>Update Order Status</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form action="{{route('admin.change_order_status',['id'=> $order->id])}}" method="post">
                                @csrf
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                <table>
                                    <tr>
                                        <td>
                                            <select id="order_status" name="order_status" class="control-label">
                                                <option value="New">New</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Canceled">Canceled</option>
                                                <option value="In Process">In Process</option>
                                                <option value="Shipped">Shipped</option>
                                                <option value="Delivered">Delivered</option>
                                                <option value="Paid">Paid</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <input style="float: right;" type="submit" value="Update Status">
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="accordion" id="collapse-group">
                        <div class="accordion-group widget-box">
                            <div class="accordion-heading">
                                <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                        <h5>Shipping Address</h5>
                                    </a> </div>
                            </div>
                            <div class="collapse in accordion-body" id="collapseGOne">
                                <div class="widget-content">
                                    Name : {{$order->name ?? 'No Name'}}<br>
                                    Address : {{$order->address ?? 'No Address'}}<br>
                                    City : {{$order->city ?? 'No City'}}<br>
                                    State : {{$order->state ?? 'No State'}}<br>
                                    Country : {{$order->Country->country_name ?? 'No Country'}}<br>
                                    Pincode : {{$order->pincode ?? 'No Pincode'}}<br>
                                    Mobile : {{$order->mobile ?? 'No Mobile'}}<br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Row</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Size</th>
                        <th>Product Color</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->Products as $key=>$product)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><a href="{{route('product',['id'=>$product->product_id])}}">{{$product->product_code}}</a></td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_size}}</td>
                            <td>{{$product->product_color}}</td>
                            <td>{{$product->product_price}}</td>
                            <td>{{$product->product_quntity}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!--main-container-part-->
@endsection
@section('js')
    <script src="{{asset('js/backend_js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/backend_js/matrix.popover.js')}}"></script>
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>
    <script>

        $(document).ready(function() {
            $("#order_status").val('{!! $order->order_status !!}');
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
