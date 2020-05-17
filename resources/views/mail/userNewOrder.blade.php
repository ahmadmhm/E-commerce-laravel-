<!DOCTYPE html>
<html>
<head>
    <title>Order Email</title>
</head>
<body>
<p><img src="{{$image}}" alt="E-shopper"></p>
<p><img src="" alt="E-shopper"></p>
<h2>thank you {{ $user->name }}  for shopping</h2>
<br/>
<h2>Your order details is</h2><br>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">@php @endphp
                <li class="active">Order {{$order->id}}</li>
                <li class="">Order coupon code : {{$order->coupon_code}}</li>
                <li class="">Order coupon amount : {{$order->coupon_amount}}</li>
                <li class="">Order total amount : {{$order->grand_total}}</li>
                <li class="">Order payment method : {{$order->payment_method}}</li>
            </ol>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading" align="center">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Product Size</th>
                    <th>Product Color</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->Products as $product)
                    <tr>
                        <td><a href="{{route('product',['id'=>$product->product_id])}}">{{$product->product_code}}</a></td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_size}}</td>
                        <td>{{$product->product_color}}</td>
                        <td>{{$product->product_price}}</td>
                        <td>{{$product->product_quntity}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section><!--/#do_action-->
<br/>

</body>
</html>
