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
                <a href="#">Banners</a>
                <a href="#" class="current">View Banners</a> </div>
            <h1>Banners</h1>
        </div>
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>View Banners</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>Banner ID</th>
                        <th>Banner Title</th>
                        <th>Banner Link</th>
                        <th>Banner Image</th>
                        <th>Created Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($banners as $banner)
                    <tr class="gradeX">
                        <td>{{$banner->id}}</td>
                        <td>{{$banner->title}}</td>
                        <td >{{$banner->link}}</td>
                        <td class="" ><img style="height: 100px;width: 400px" src="{{ $banner->image? \App\Helpers\Helpers::banner_asset($banner->image):''}}"></td>
                        <td class="create-date" data-date="{{$banner->created_at}}"></td>
                        <td class="activate" data-status="{{$banner->status}}"></td>
                        <td class="center">
                            <a href="{{route('admin.edit_banner', ['id'=>$banner->id])}}" class="btn btn-primary btn-mini" title="Edit Banner">Edit</a>
                            <a title="Delete Banner" data-confirm="ahmad" href="javascript:"
                               data-link="{{route('admin.delete_banner', ['id'=>$banner->id])}}" class="btn btn-danger btn-mini deleteBanner">Delete</a>
                            <a class="btn btn-info btn-mini active-banner" data-id="{{$banner->id}}" data-link="" title="Active or Deactive Banner" data-confirm="ahmad" href="javascript:"></a>
                            </td>
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

        $(".active-banner").bind('click',function () {
            var banner_id = $(this).data('id');
            var clicked = $(this);
            //console.log($(this).parent().parent().find("td.activate").data('status'));
            if (banner_id.length != 0) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "get",
                    url: '{{route('admin.activate_banner')}}',
                    data: {id: banner_id},
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
            $('.create-date').each(function () {
                // console.log($(this).closest('tr').children().find("td:nth-child(3)").text());
                // console.log($(this).parent().find("td.create-date").data('date'));
                var d = $(this).data('date');
                var parts = d.split(" ");
                var times = parts[1].split(":");
                var dates = parts[0].split("-");
                $(this).html(dates[0]+"-"+dates[1]+"-"+dates[2] +" "+ times[0] +":"+ times[1]);

                if($(this).parent().find("td.activate").data('status') == "1"){
                    $(this).parent().find("td.activate").html('Active');
                    $(this).parent().find("a.active-banner").text('Inactive');
                }else if($(this).parent().find("td.activate").data('status') == "0"){
                    $(this).parent().find("td.activate").html('Inactive');
                    $(this).parent().find("a.active-banner").text('Active');
                }
            });
        });
    </script>
@endsection
