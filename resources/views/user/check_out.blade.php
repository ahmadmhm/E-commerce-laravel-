@section('css')
    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
    <style>

    </style>
@endsection
@section('title')
    <title>Check Out</title>
@endsection
@extends('layouts.frontLayout.userMaster')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->

            <div class="step-one">
                <h2 class="heading">Step1</h2>
            </div>
            <div class="checkout-options">
                <h3>New User</h3>
                <p>Checkout options</p>
                <ul class="nav">
                    <li>
                        <label><input type="checkbox"> Register Account</label>
                    </li>
                    <li>
                        <label><input type="checkbox"> Guest Checkout</label>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-times"></i>Cancel</a>
                    </li>
                </ul>
            </div><!--/checkout-options-->

            <div class="register-req">
                <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
            </div><!--/register-req-->

            <div class="shopper-informations">
                <form action="{{route('user.check_out')}}" method="post">
                    @csrf
                    <div class="row">
                    <div class="col-sm-4">
                        <div class="login-form">
                            <p>Bill To</p>
                            <div class="form-group">
                                <input name="billing_name" id="billing_name" value="{{$user->name ?? ''}}" type="text" placeholder="Billing Name" class="form-control">
                            </div>
                            <div class="form-group">
                                <input name="billing_address" id="billing_address" value="{{$user->Information->address ?? ''}}" type="text" placeholder="Billing Address" class="form-control">
                            </div>
                            <div class="form-group">
                                <input name="billing_city" id="billing_city" value="{{$user->Information->city ?? ''}}" type="text" placeholder="Billing City" class="form-control">
                            </div>
                            <div class="form-group">
                                <input name="billing_state" id="billing_state" value="{{$user->Information->state ?? ''}}" type="text" placeholder="Billing State" class="form-control">
                            </div>
                            <div class="form-group">
                                <select name="billing_country" id="billing_country">
                                    <option value="0">Select one</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->country_name}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input name="billing_pincode" id="billing_pincode" value="{{$user->Information->pincode ?? ''}}" type="text" placeholder="Billing Pincode" class="form-control">
                            </div>
                            <div class="form-group">
                                <input name="billing_mobile" id="billing_mobile" value="{{$user->Information->mobile ?? ''}}" type="text" placeholder="Billing Mobile" class="form-control">
                            </div>
                            <div class="form-check">
                                <input name="billtoship" class="form-check-input" type="checkbox" id="billtoship">
                                <label class="form-check-label" for="billtoship">
                                    Shipping Address same as Billing Address
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="login-form">
                            <p>Ship To</p>
                            <div class="form-group">
                                <input name="shipping_name" id="shipping_name" value="{{$shipping->name ?? ''}}" type="text" placeholder="Shipping Name" class="form-control">
                            </div>
                            <div class="form-group">
                                <input name="shipping_address" id="shipping_address" value="{{$shipping->address ?? ''}}" type="text" placeholder="Shipping Address" class="form-control">
                            </div>
                            <div class="form-group">
                                <input name="shipping_city" id="shipping_city" value="{{$shipping->city ?? ''}}" type="text" placeholder="Shipping City" class="form-control">
                            </div>
                            <div class="form-group">
                                <input name="shipping_state" id="shipping_state" value="{{$shipping->state ?? ''}}" type="text" placeholder="Shipping State" class="form-control">
                            </div>
                            <div class="form-group">
                                <select name="shipping_country" id="shipping_country">
                                    <option value="">Select one</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->country_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input name="shipping_pincode" id="shipping_pincode" value="{{$shipping->pincode ?? ''}}" type="text" placeholder="Shipping Pincode" class="form-control">
                            </div>
                            <div class="form-group">
                                <input name="shipping_mobile" id="shipping_mobile" value="{{$shipping->mobile ?? ''}}" type="text" placeholder="Shipping Mobile" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mb-2">Check Out</button>
                    </div>
                </div>
                </form>
            </div>
            <div class="review-payment">
                <h2></h2>
            </div>

        </div>
    </section> <!--/#cart_items-->
@endsection
@section('js')
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('js/frontend_js/main.js')}}"></script>
    <script src="{{asset('js/frontend_js/easyzoom.js')}}"></script>
    <script src="{{asset('js/frontend_js/jquery.validate.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("#billing_country").val({!! $user->Information->country ?? '' !!});
            $("#shipping_country").val({!! $shipping->country ?? '' !!});
        });
    </script>
@endsection