@section('css')
    <link rel="stylesheet" href="{{asset('css/frontend_css/easyzoom.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
    <style>
        .cart_product {
            margin: 15px -200px 10px 25px;
        }
    </style>
@endsection
@extends('layouts.frontLayout.userMaster')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
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
                            <a href=""><img width="30%" src="{{\App\Helpers\Helpers::product_small_image_asset($item->image)}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item->product_name}}</a></h4>
                            <p>{{$item->product_code}} | {{$item->size}}</p>
                        </td>
                        <td class="cart_price">
                            <p>${{$item->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{route('update_cart_product_quantity',['id'=>$item->id, 'quantity'=>1])}}"> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$item->quantity}}" autocomplete="off" size="2">
                                @if($item->quantity > 1)
                                <a class="cart_quantity_down" href="{{route('update_cart_product_quantity',['id'=>$item->id, 'quantity'=>-1])}}"> - </a>
                                @endif
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">${{$item->quantity * $item->price}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{route('delete_cart_product',['id'=>$item->id])}}"><i class="fa fa-times"></i></a>
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
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <input type="checkbox">
                                <label>Use Coupon Code</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Use Gift Voucher</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Estimate Shipping & Taxes</label>
                            </li>
                        </ul>
                        <ul class="user_info">
                            <li class="single_field">
                                <label>Country:</label>
                                <select>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field">
                                <label>Region / State:</label>
                                <select>
                                    <option>Select</option>
                                    <option>Dhaka</option>
                                    <option>London</option>
                                    <option>Dillih</option>
                                    <option>Lahore</option>
                                    <option>Alaska</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field zip-field">
                                <label>Zip Code:</label>
                                <input type="text">
                            </li>
                        </ul>
                        <a class="btn btn-default update" href="">Get Quotes</a>
                        <a class="btn btn-default check_out" href="">Continue</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span id="total">$59</span></li>
                            <li>Eco Tax <span>$2</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span>$61</span></li>
                        </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection
@section('js')
    <script src="{{asset('js/frontend_js/easyzoom.js')}}"></script>
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>

    <script>
        var total =0;
        $('.cart_total_price').each(function () {
            var currentCol = $(this).closest("td").find("p:eq(0)").text();
            total += parseInt(currentCol.substring(1));
        });
        $('#total').html('$' + total);
        console.log(total);
    </script>
@endsection