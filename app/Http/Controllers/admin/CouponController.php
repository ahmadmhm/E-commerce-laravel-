<?php

namespace App\Http\Controllers\admin;


use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //
    public function addCoupon(Request $request){
        if($request->isMethod('post')){
            $coupon = new Coupon();
            $coupon->coupon_code = $request->coupon_code;
            $coupon->amount = $request->amount;

            //1 percentage
            //2 fixed
            if ($request->amount_type == 1){
                $coupon->amount_type = 1;
            }else{
                $coupon->amount_type = 2;
            }
            $coupon->expire_date = $request->expire_date;
            if ($request->status == "on"){
                $coupon->status = 1;
            }else{
                $coupon->status = 0;
            }
            $coupon->save();
            return redirect()->route('admin.add_coupon')->with('flash_message_success','coupon added successfully');
        }
        return view('admin.coupons.add_coupon');
    }
}
