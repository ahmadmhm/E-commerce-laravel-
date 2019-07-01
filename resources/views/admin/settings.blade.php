@extends('layouts.adminLayout.adminMaster')
@section('css')
    <link rel="stylesheet" href="{{asset('css/backend_css/uniform.css')}}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
@endsection
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="#" class="current">Settings</a> </div>
            <h1>Admin Settings</h1>
        </div>
        <div class="container-fluid"><hr>

            <div class="row-fluid">

                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                <h5>Update Password</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <form class="form-horizontal" method="post" action="{{route('admin.update_password')}}" name="password_validate" id="password_validate" novalidate="novalidate">
                                    @csrf
                                    <div class="control-group">
                                        <label class="control-label">Current Password</label>
                                        <div class="controls">
                                            <input type="password" name="current_pwd" id="current_pwd" />
                                            <span id="checkResult"></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">New Password</label>
                                        <div class="controls">
                                            <input type="password" name="new_pwd" id="new_pwd" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Confirm password</label>
                                        <div class="controls">
                                            <input type="password" name="confirm_pwd" id="confirm_pwd" />
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" value="Update Password" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script src="{{asset('js/backend_js/select2.min.js')}}"></script>
    <script src="{{asset('js/backend_js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>
    <script>
        //ajax for checking current password
        $("#new_pwd").bind('click focus',function () {
            var current_pwd = $("#current_pwd").val();
            if (current_pwd.length != 0) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "get",
                    url: '{{route("admin.check_password")}}',
                    data: {password: current_pwd},
                    dataType: 'json',
                    success: function (response) {
                        if(response == 'ok'){
                            $("#checkResult").html('current password is correct').css('color','green');
                        }else{
                            $("#checkResult").html('current password is not correct').css('color','red');
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        });

    </script>

@endsection