@section('css')

    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/dataTables.bootstrap4.min.css')}}" />
    <style>

    </style>
@endsection
@section('title')
    <title>Order</title>
@endsection
@extends('layouts.frontLayout.userMaster')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li class=""><a href="{{route('user.orders')}}">Orders</a></li>
                    <li class="active"><a href="#">Order {{$order->id}}</a></li>
                </ol>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading" align="center">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Size</th>
                        <th>Product Color</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->Products as $product)
                    <tr>
                        <td><a href="{{route('product',['id'=>$product->product_id])}}">{{$product->product_code}}</a></td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_size}}</td>
                        <td>{{$product->product_color}}</td>
                        <td>{{$product->product_price}}</td>
                        <td>{{$product->product_quntity}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Size</th>
                        <th>Product Color</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section><!--/#do_action-->

@endsection
@section('js')
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('js/frontend_js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/frontend_js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
           // console.log('$' + parseInt($("#g_total").text().substring(1)).toLocaleString());
           $("#g_total").text('$ ' + parseInt($("#g_total").text().substring(1)).toLocaleString());
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
