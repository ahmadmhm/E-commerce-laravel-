<?php

namespace App\Http\Controllers\admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    public function viewOrders(){
        $orders = Order::with('Products')->get();
        return view('admin.orders.view_orders')->with(compact('orders'));
    }
}
