@section('css')
    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
    <style>
        label{
            padding-left: 100px;
        }
    </style>
@endsection
@section('title')
    <title>Order Review</title>
@endsection
@extends('layouts.frontLayout.userMaster')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li class="active">Order Review</li>
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

            <div class="shopper-informations">

                    <div class="row">
                    <div class="col-sm-4">
                        <div class="login-form">
                            <h3 style="padding-left: 90px">Billing Address</h3>
                            <div class="form-group">
                                <label>{{$user->name}}</label>
                            </div>
                            <div class="form-group">
                                <label>{{$user->Information->address}}</label>
                            </div>
                            <div class="form-group">
                                <label>{{$user->Information->city}}</label>
                            </div>
                            <div class="form-group">
                                <label>{{$user->Information->state}}</label>
                            </div>
                            <div class="form-group">
                                <label>{{$user->Information->pincode}}</label>
                            </div>
                            <div class="form-group">
                                <label>{{$user->Information->mobile}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="login-form">
                            <h3 style="padding-left: 90px">Shipping details</h3>
                            <div class="form-group">
                                <label>{{$shipping->name}}</label>
                            </div>
                            <div class="form-group">
                                <label>{{$shipping->address}}</label>
                            </div>
                            <div class="form-group">
                                <label>{{$shipping->city}}</label>
                            </div>
                            <div class="form-group">
                                <label>{{$shipping->state}}</label>
                            </div>
                            <div class="form-group">
                                <label>{{$shipping->pincode}}</label>
                            </div>
                            <div class="form-group">
                                <label>{{$shipping->mobile}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review-payment">
                <h2>Review & Payment</h2>
            </div>

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description">Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($userCart as $item)
                        <tr>
                            <td class="cart_product">
                                <a href="{{route('product',['id'=>$item->product_id])}}"><img width="30%" src="{{\App\Helpers\Helpers::product_small_image_asset($item->image)}}" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="{{route('product',['id'=>$item->product_id])}}">{{$item->product_name}}</a></h4>
                                <p>{{$item->product_code}} | {{$item->size}}</p>
                            </td>
                            <td class="cart_price">
                                <p class="p_price">${{$item->price}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <label>{{$item->quantity}}</label>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">${{$item->quantity * $item->price}}</p>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </section> <!--/#cart_items-->
    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>Payment Information</h3>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            @if(!empty(\Illuminate\Support\Facades\Session::get('Coupon_amount')) and !empty(\Illuminate\Support\Facades\Session::get('Coupon_code')))
                                <li>Sub Total <span id="total"></span></li>
                                <li>Coupon Discount (-) <span id="c_amount">$ {{\Illuminate\Support\Facades\Session::get('Coupon_amount')}}</span></li>
                                <li>Grand Total <span id="Gtotal"></span></li>
                            @else
                                <li>Grand Total <span id="total"></span></li>
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <form style="" action="{{route('user.place_order')}}" method="post" name="paymentForm" id="paymentForm">
            @csrf
            <input hidden name="grand_total" id="grand_total">
            <div class="payment-options">
                <span>
                    <label><strong>Select Payment Method:</strong></label>
                </span>
                <span>
                    <label><input type="radio" name="payment_method" id="Cod" value="COD"><strong>COD</strong></label>
                </span>
                <span>
                    <label><input type="radio" name="payment_method" id="Paypal" value="Paypal"><strong>Paypal</strong></label>
                </span>
                <br>
                <span style="float: left;margin-left: 90px;">
                    <button type="submit" class="btn btn-default" onclick="return selectPaymentMethod();">Place Order</button>
                </span>
            </div>

        </form>
    </section><!--/#do_action-->
@endsection
@section('js')
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('js/frontend_js/main.js')}}"></script>
    <script src="{{asset('js/frontend_js/easyzoom.js')}}"></script>
    <script src="{{asset('js/frontend_js/jquery.validate.js')}}"></script>
    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                $('.p_price').each(function () {
                    $(this).text('$' + parseInt($(this).text().substring(1)).toLocaleString());
                });
            });
            var total =0;
            $('.cart_total_price').each(function () {
                var currentCol = $(this).closest("td").find("p:eq(0)").text();
                total += parseInt(currentCol.substring(1));
                $(this).text('$' + parseInt($(this).text().substring(1)).toLocaleString());
            });
            $('#total').html('$' + total.toLocaleString());
            $("#grand_total").val($('#Gtotal').text().substring(1).toLocaleString());
            $("#c_amount").text('$' + parseInt($("#c_amount").text().substring(1)).toLocaleString());

            @if(!empty(\Illuminate\Support\Facades\Session::get('Coupon_amount')))
            $('#Gtotal').html('$' + (total - {{\Illuminate\Support\Facades\Session::get('Coupon_amount')}}).toLocaleString());
            $("#grand_total").val($('#Gtotal').text().substring(1));
            @endif
        });
        function selectPaymentMethod() {
            if($("#Cod").is(':checked') || $("#Paypal").is(':checked')){
                return true;
            }else{
                alert('please');
                return false;
            }
            return false;
        }
    </script>
@endsection
