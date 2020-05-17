@extends('layouts.adminLayout.adminSimpleMaster')

@section('css')
    <link rel="stylesheet" href="{{asset('css/backend_css/matrix-login.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
@endsection
@section('title')
    E-commerce Admin login
@endsection
@section('content')
    <div id="loginbox">
        <form id="loginform" class="form-vertical" method="post" action="{{route('admin.login')}}">
            @csrf
            <div class="control-group normal_text"> <h3>E-commerce Admin</h3></div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="email" name="email" placeholder="Username" />
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Password" />
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
                <span class="pull-right"><input type="submit" value="Login" class="btn btn-success" /> </span>
            </div>
        </form>
        <form id="recoverform" action="#" class="form-vertical">
            <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>

            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                </div>
            </div>

            <div class="form-actions">
                <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
            </div>
        </form>
    </div>
@endsection


@section('js')
    <script src="{{asset('js/backend_js/matrix.login.js')}}"></script>
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>
@endsection
