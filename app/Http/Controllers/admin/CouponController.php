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
            return redirect()->route('admin.view_coupons')->with('flash_message_success','coupon added successfully');
        }
        return view('admin.coupons.add_coupon');
    }

    public function viewCoupons(){
        $coupons =  Coupon::where('id','<>', null)->get();
        return view('admin.coupons.view_coupons',compact('coupons'));
    }

    public function editCoupon(Request $request){
        if(isset($request->id)){
            $coupon = Coupon::where('id',$request->id)->first();
            if($request->isMethod('post')){

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
                $coupon->update();
                return redirect()->back()->with('flash_message_success','coupon edited successfully');
                return redirect()->route('admin.view_coupons')->with('flash_message_success','coupon added successfully');
            }
            return view('admin.coupons.edit_coupon', compact('coupon'));
        }
        return redirect()->back();
    }

    public function deleteCoupon($id =null){
        if($id != null)
            Coupon::destroy($id);
        return redirect()->back()->with('flash_message_success','coupon deleted successfully');
    }

    public function activateCoupon(Request $request){
        if($request->ajax()){
            if(isset($request->id)){
                $coupon = Coupon::where('id',$request->id)->first();
                $coupon->toggleStatus()->save();
                return response()->json(['status'=>$coupon->status]);
            }
        }
        return response()->json(['error']);
    }
}
