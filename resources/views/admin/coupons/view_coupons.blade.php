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
                        <td class="amount" data-amount="{{$coupon->amount}}"></td>
                        <td class="" data-type="{{$coupon->amount_type}}"></td>
                        <td>{{$coupon->expire_date}}</td>
                        <td class="create-date" data-date="{{$coupon->created_at}}"></td>
                        <td class="activate" data-status="{{$coupon->status}}"></td>
                        <td class="center">
                            <a href="{{route('admin.edit_coupon', ['id'=>$coupon->id])}}" class="btn btn-primary btn-mini" title="Edit Coupon">Edit</a>
                            <a data-pid="{{$coupon->id}}" title="Delete Coupon" data-confirm="ahmad" href="javascript:"
                               data-link="{{route('admin.delete_coupon', ['id'=>$coupon->id])}}" class="btn btn-danger btn-mini deleteCoupon">Delete</a>
                            <a class="btn btn-info btn-mini active-coupon" data-pid="{{$coupon->id}}" data-link="" title="Active or Deactive Coupon" data-confirm="ahmad" href="javascript:">Act/Deact</a>
                            </td> <?php /*href="{{route('admin.delete_product', ['id'=>$coupon->id])}}"*/?>
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
        $(document).ready(function() {
            //table formatting
            $('.amount').each(function () {
                // console.log($(this).closest('tr').children().find("td:nth-child(3)").text());
                // console.log($(this).parent().find("td.create-date").data('date'));
                var d = $(this).parent().find("td.create-date").data('date');
                var parts = d.split(" ");
                var times = parts[1].split(":");
                var dates = parts[0].split("-");
                $(this).parent().find("td.create-date").html(dates[0]+"-"+dates[1]+"-"+dates[2] +" "+ times[0] +":"+ times[1]);

                if($(this).parent().find("td.activate").data('status') == "1"){
                    $(this).parent().find("td.activate").html('Active');
                }else if($(this).parent().find("td.activate").data('status') == "0"){
                    $(this).parent().find("td.activate").html('Inactive');
                }
                if($(this).next('td').data('type') == "1"){
                    $(this).html("% " + $(this).data('amount'));
                    $(this).next('td').html('Percentage');
                }else if ($(this).next('td').data('type') == "2"){
                    $(this).html("$ " + $(this).data('amount').toLocaleString() );
                    $(this).next('td').html('Fixed');
                }
            });
        });
    </script>
@endsection
