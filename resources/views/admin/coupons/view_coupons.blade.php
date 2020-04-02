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
                            <a title="Delete Coupon" data-confirm="ahmad" href="javascript:"
                               data-link="{{route('admin.delete_coupon', ['id'=>$coupon->id])}}" class="btn btn-danger btn-mini deleteCoupon">Delete</a>
                            <a class="btn btn-info btn-mini active-coupon" data-id="{{$coupon->id}}" data-link="" title="Active or Deactive Coupon" data-confirm="ahmad" href="javascript:"></a>
                            </td> <?php /*href="{{route('admin.delete_product', ['id'=>$coupon->id])}}"*/?>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/backend_js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/backend_js/matrix.popover.js')}}"></script>
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>
    <script>

        $(".active-coupon").bind('click',function () {
            var coupon_id = $(this).data('id');
            var clicked = $(this);
            //console.log($(this).parent().parent().find("td.activate").data('status'));
            if (coupon_id.length != 0) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "get",
                    url: '{{route('admin.activate_coupon')}}',
                    data: {id: coupon_id},
                    dataType: 'json',
                    success: function (response) {
                        if(response != 'error'){
                            changeTexts(clicked,response.status);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        });
        function changeTexts(clicked , status){
            if(status == 1){
                // console.log($("a[data-id='" + coupon_id +"']").text());
                clicked.parent().parent().find("td.activate").html('Inactive');
                clicked.text('Active');
                // $("a.active-coupon[data-id='" + coupon_id +"']").text('Active');
            }
            else if(status == 0){
                clicked.parent().parent().find("td.activate").html('Active');
                clicked.text('Inactive');
                // $("a.active-coupon[data-id='" + coupon_id +"']").text('Inactive');
            }
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
                    $(this).parent().find("a.active-coupon").text('Inactive');
                }else if($(this).parent().find("td.activate").data('status') == "0"){
                    $(this).parent().find("td.activate").html('Inactive');
                    $(this).parent().find("a.active-coupon").text('Active');
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
