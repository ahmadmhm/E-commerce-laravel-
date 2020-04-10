@section('css')

    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/passtrength.css')}}" />
    <style>

    </style>
@endsection
@extends('layouts.frontLayout.userMaster')

@section('content')
    <section id="form" style="margin-top: 25px;"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="#">
                            <input type="text" placeholder="Name" />
                            <input type="email" placeholder="Email Address" />
                            <span>
								<input type="checkbox" class="checkbox">
								Keep me signed in
							</span>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form action="{{route('user.register')}}" id="registerForm" name="register" method="post" autocomplete="off">
                            @csrf
                            <input name="name" type="text" placeholder="Name"/>
                            <input name="email" type="email" placeholder="Email Address"/>
                            <input id="password" name="password" type="password" placeholder="Password"/>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection
@section('js')
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('js/frontend_js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/frontend_js/easyzoom.js')}}"></script>
    <script src="{{asset('js/frontend_js/main.js')}}"></script>
    <script src="{{asset('js/frontend_js/passtrength.js')}}"></script>
    <script>
        $(document).ready(function($) {
            $('#password').passtrength({
                minChars: 6,
                passwordToggle: true,
                eyeImg: "{!! asset('images/frontend_images/eye.svg') !!}",
                tooltip: true,
                textWeak:"Weak",
                textMedium:"Medium",
                textStrong:"Strong",
                textVeryStrong:"Very Strong",
            });
        });
    </script>
@endsection