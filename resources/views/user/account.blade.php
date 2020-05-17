@section('css')

    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/passtrength.css')}}" />
    <style>

    </style>
@endsection
@extends('layouts.frontLayout.userMaster')
@section('title')
    <title> E-Shopper | Account</title>
@endsection
@section('content')
    <section id="form" style="margin-top: 25px;"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Update Account</h2>
                        <form action="{{route('user.account')}}" method="post" id="updateAccountForm" name="updateAccount">
                            @csrf
                            <input name="name" type="text" value="{{old('name',$user->name)}}" placeholder="Name" />
                            <input name="address" type="text" value="{{old('address',$information->address)}}" placeholder="address" />
                            <input name="city" type="text" value="{{old('city',$information->city)}}" placeholder="city" />
                            <input name="state" type="text" value="{{old('state',$information->state)}}" placeholder="state" />
                            <select name="country" id="country_select">
                                <option>Select a country</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->country_name}}</option>
                                @endforeach
                            </select>
                            <input style="margin-top: 10px;" name="pincode" type="text" value="{{old('pincode',$information->pincode)}}" placeholder="pincode" />
                            <input name="mobile" type="text" value="{{old('mobile',$information->mobile)}}" placeholder="9199191919" />
                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Update Password</h2>
                        <form action="{{route('user.update_password')}}" id="passwordForm" name="passwordForm" method="post">
                            @csrf
                            <input name="current_password" id="current_password" type="password" data-link="{{route('user.check_password')}}" placeholder="Current Password"/>
                            <p id="for_current_password"></p>
                            <input name="new_password" id="new_password" type="password" placeholder="New Password"/>
                            <input name="confirm_password" id="confirm_password" type="password" placeholder="Confirm Password"/>
                            <button type="submit" class="btn btn-default">Update</button>
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
            $("#country_select").val({!! $information->country !!});

            $('#register_password').passtrength({
                minChars: 6,
                passwordToggle: true,
                eyeImg: "{!! asset('images/frontend_images/eye.svg') !!}",
                tooltip: true,
                textWeak:"Weak",
                textMedium:"Medium",
                textStrong:"Strong",
                textVeryStrong:"Very Strong",
            });
            $('#login_password').passtrength({
                minChars: 6,
                passwordToggle: true,
                eyeImg: "{!! asset('images/frontend_images/eye.svg') !!}",
                tooltip: false,
            });
        });
    </script>
@endsection
