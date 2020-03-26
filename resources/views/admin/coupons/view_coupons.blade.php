@extends('layouts.adminLayout.adminMaster')

@section('css')
    <link rel="stylesheet" href="{{asset('css/backend_css/uniform.css')}}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
@endsection
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="#">Coupons</a>
                <a href="#" class="current">View Coupons</a> </div>
            <h1>Coupons</h1>
        </div>
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>View Coupons</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>Coupon ID</th>
                        <th>Coupon Code</th>
                        <th>Coupon Amount</th>
                        <th>Amount Type</th>
                        <th>Expire Date</th>
                        <th>Created Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as $coupon)
                    <tr class="gradeX">
                        <td>{{$coupon->id}}</td>
                        <td>{{$coupon->coupon_code}}</td>
                        <td>{{($coupon->amount_type == 2)?"$ ".number_format($coupon->amount):$coupon->amount. " %"}}</td>
                        <td>{{($coupon->amount_type == 1)?'Percentage':'Fixed'}}</td>
                        <td>{{$coupon->expire_date}}</td>
                        <td>{{date_format($coupon->created_at,"Y-m-d")}}</td>
                        <td>{{($coupon->status == 1)?'Active':'Inactive'}}</td>
                        <td class="center">
                            <a href="{{route('admin.edit_coupon', ['id'=>$coupon->id])}}" class="btn btn-primary btn-mini" title="Edit Coupon">Edit</a>
                            <a data-pid="{{$coupon->id}}" data-link="" title="Delete Coupon" data-confirm="ahmad" href="javascript:"
                               class="btn btn-danger btn-mini deleteProduct">Delete</a> <?php /*href="{{route('admin.delete_product', ['id'=>$coupon->id])}}"*/?>
                            <a class="btn btn-info btn-mini active-coupon" data-pid="{{$coupon->id}}" data-link="" title="Active or Deactive Coupon" data-confirm="ahmad" href="javascript:">Act/Deact</a>
                            </td>
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
        //ajax for checking current password
        $(".viewCoupon").bind('click',function () {
            var coupon_id = $(this).data('id');

            if (coupon_id.length != 0) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "get",
                    url: '',
                    data: {id: coupon_id},
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
        $("#pid").html("Coupon ID :");
        $("#catid").html("Category ID :");
        $("#catname").html("Category Name :");
        $("#pcode").html("Coupon Code :");
        $("#pcolor").html("Coupon Color :");

        $("#pdes").html("Coupon Description :");
        $("#pprice").html("Coupon Price :");
    }
    </script>
@endsection
