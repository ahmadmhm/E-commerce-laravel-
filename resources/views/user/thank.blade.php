@section('css')

    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
    <style>

    </style>
@endsection
@section('title')
    <title>User Thank</title>
@endsection
@extends('layouts.frontLayout.userMaster')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li class="active">Thanks</li>
                </ol>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>YOUR {{\Illuminate\Support\Facades\Session::get('payment_method')}} ORDER HAS BEEN PLACED</h3>
                <p>your order number is {{\Illuminate\Support\Facades\Session::get('order_id')}} and total amount is <span id="g_total">$ {{\Illuminate\Support\Facades\Session::get('grand_total')}}</span></p>
            </div>
        </div>
    </section><!--/#do_action-->

@endsection
@section('js')
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>

    <script>
        $(document).ready(function() {
           // console.log('$' + parseInt($("#g_total").text().substring(1)).toLocaleString());
           $("#g_total").text('$ ' + parseInt($("#g_total").text().substring(1)).toLocaleString());
        });
    </script>
@endsection
@php
    \Illuminate\Support\Facades\Session::forget('payment_method');
    \Illuminate\Support\Facades\Session::forget('order_id');
    \Illuminate\Support\Facades\Session::forget('grand_total');
@endphp