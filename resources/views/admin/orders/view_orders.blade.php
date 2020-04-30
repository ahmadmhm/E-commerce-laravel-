@section('title')
    <title>Orders</title>
@endsection
@extends('layouts.adminLayout.adminMaster')

@section('css')
    <link rel="stylesheet" href="{{asset('css/backend_css/uniform.css')}}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/dataTables.bootstrap4.min.css')}}" />
@endsection
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="#">Orders</a>
                <a href="#" class="current">View Orders</a> </div>
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
                                <a href="#myModal" data-toggle="modal" data-id="{{$order->id}}" class="btn btn-success btn-mini viewProduct" title="View Details">View</a>
                                <a data-pid="{{$order->id}}" data-link="{{route('admin.delete_product', ['id'=>$order->id])}}" title="Delete Product" data-confirm="ahmad"
                                   href="javascript:" class="btn btn-danger btn-mini deleteProduct">Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h3 id="title"></h3>
        </div>
        <div class="modal-body">
            <p id="pid"></p>
            <p id="catid"></p>
            <p id="catname"></p>
            <p id="pcode"></p>
            <p id="pcolor"></p>
            <p id="pdes"></p>
            <p id="pprice"></p>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{asset('js/backend_js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/backend_js/matrix.popover.js')}}"></script>
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>
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

        //ajax for checking current password
        $(".viewProduct").bind('click',function () {
            var product_id = $(this).data('id');

            if (product_id.length != 0) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "get",
                    url: '{{route('admin.get_products')}}',
                    data: {id: product_id},
                    dataType: 'json',
                    success: function (response) {

                        if(response != 'error'){
                            // console.log(response.category);
                            // resetModal();
                            $("#title").html(response.product_name);
                            $("#pid").html("Product ID :"+response.id);
                            $("#catid").html("Category ID :"+response.category.id);
                            $("#catname").html("Category Name :"+response.category.name);
                            $("#pcode").html("Product Code :"+response.product_code);
                            $("#pcolor").html("Product Color :"+response.product_color);

                            $("#pdes").html("Product Description :"+ (response.description != null?response.description:''));
                            $("#pprice").html("Product Price :"+response.price);
                        }
                    },
                    error: function (data) {
                        // console.log(data);
                    }
                });
            }
        });

        function resetModal() {
            $("#title").html('');
            $("#pid").html("Product ID :");
            $("#catid").html("Category ID :");
            $("#catname").html("Category Name :");
            $("#pcode").html("Product Code :");
            $("#pcolor").html("Product Color :");

            $("#pdes").html("Product Description :");
            $("#pprice").html("Product Price :");
        }
    </script>
@endsection
