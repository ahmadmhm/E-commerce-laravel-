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

    public function orderDetails($orderID){
        $order = Order::where('id', $orderID)->with(['Products','User.Information.Country'])->first();
//        dd($Order->User->Information->address);
        if($order){
            return view('admin.orders.order_details')->with(['order'=>$order]);
        }
        return redirect()->back();
    }

    public function changeOrderStatus(Request $request, $orderID){
        if($request->isMethod('post')){
            if(isset($request->order_status) and !empty($orderID)){
                $accept_able_status = ['New','Pending','Canceled','In Process','Shipped','Delivered', 'Paid'];
                if(!in_array($request->order_status,$accept_able_status)){
                    return redirect()->back()->with('flash_message_error','the status dont valid');
                }
                $order = Order::where('id', $orderID)->first();
                if($order){
                    $order->order_status = $request->order_status;
                    $order->update();
                    return redirect()->back()->with('flash_message_success','order status successfully changed to '.$request->order_status );
                }
                return redirect()->back()->with('flash_message_error','order status dont changed to '.$request->order_status);
            }
        }

    }
}
