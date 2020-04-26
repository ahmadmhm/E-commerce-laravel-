<?php

namespace App\Http\Controllers\user;

use App\Coupon;
use App\DeliveryAddress;
use App\ProductsImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Category;
use App\Country;
use App\Helpers\Helpers;
use App\Product;
use App\ProductsAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{

    public function products($url =null){
        if($url){
//            $categoryIDs = Category::where('url','LIKE','%'.$url.'%')->with('Products')->pluck('id');
            $categories = Category::all();
            $categoryID = Category::where('url',$url)->first();
            $products = null;
            if(!$categoryID or $categoryID->status == 0)
                return view('common.404');
            else{
                if($categoryID->parent_id == 0){
                    $ids =[];
                    foreach ($categories as $cat){
                        if($cat->parent_id == $categoryID->id)
                            $ids[] = $cat->id;
                    }
                    $products = Product::where('status',1)->whereIn('category_id',$ids)->get();
                }else{
                    $products = Product::where('status',1)->where('category_id',$categoryID->id)->get();
                }
            }
//            dd($products);
            return view('user.categorize_products')->with(['category_name'=>$url,'products'=> $products,'categories'=>$categories]);

        }

        return redirect()->back();
    }

    public function product($id = null){
        if($id){
            $product = Product::where('status',1)->where('id',$id)->with('Attributes')->with('Images')->first();
//            dd($product);
            if($product){
                $categories = Category::all();
                $relatedProducts = Product::where('id','<>',$id)->where('category_id',$product->category_id)->get();
                return view('user.product_detail',compact('product','categories','relatedProducts'));
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    public function getProductAttributes(Request $request){
        if($request->isMethod('post')){
            if(isset($request->attribute_id)){
                $attribute = ProductsAttribute::where('id', $request->attribute_id)->first();
                return response()->json($attribute);
            }
            return response()->json('error');
        }
    }

    public function addToCart(Request $request){
       // dd($request->all());
        if(isset($request->product_id)){
            $porduct = Product::where('id',$request->product_id)->first();
            if($porduct and isset($request->product_attribute_id) and $request->product_attribute_id != 0){
                $porductAtrribute = ProductsAttribute::where('id',$request->product_attribute_id)->first();

                $user = Auth::user();
                //dd($user->session_id_status );
                if($user->session_id_status == 0){

                    $user->session_id = bcrypt($user->id . $user->email);
                    $user->toggleSessionStatus()->update();
                }
                if($userCart = DB::table('cart')->where(['product_id'=>$porduct->id,'product_color'=>$porduct->product_color, 'size'=>$porductAtrribute->size, 'session_id'=>$user->session_id])->count() > 0){
                    return redirect()->back()->with('flash_message_error','product already exists in cart');
                }else{
                    DB::table('cart')->insert(['product_id'=>$porduct->id ,'product_name'=>$porduct->product_name, 'product_code'=>$porductAtrribute->sku ,
                        'product_color'=>$porduct->product_color, 'size'=>$porductAtrribute->size, 'price'=>$porductAtrribute->price,
                        'quantity'=>$request->quantity, 'user_email'=>(Auth::user() == null)?'':$user->email
                        , 'session_id'=>$user->session_id, 'image'=>$porduct->product_image]);
                    Session::forget('Coupon_amount' );
                    Session::forget('Coupon_code' );
                    Session::forget('total' );
                    return redirect()->route('showCart')->with('flash_message_success','product added to cart successfully');
                }
            }
        }
    }

    public function showCart(){
        $session_id = -1;
        if(Auth::user()->session_id_status == 1){
            $session_id = Auth::user()->session_id;
        }
//        dd($session_id);
        $userCart = DB::table('cart')->where('session_id',$session_id)->get();
        return view('user.cart', compact('userCart'));
    }

    public function deleteCartProduct($id = null){
        if($id){
            Session::forget('Coupon_amount' );
            Session::forget('Coupon_code' );
            Session::forget('total' );
            DB::table('cart')->where('id',$id)->delete();
            return redirect()->back()->with('flash_message_success','product deleted successfully');
        }
        return redirect()->back()->with('flash_message_error','nothing be deleted');
    }

    public function updateCartProductQuantity($id = null , $quantity = null){
        if($id and $quantity){
            $cart = DB::table('cart')->where('id',$id)->first();
            $getStock = ProductsAttribute::select('stock')->where('sku', $cart->product_code)->where('product_id', $cart->product_id)->first();

            if($getStock->stock >= $cart->quantity + $quantity){
                DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
                Session::forget('Coupon_amount' );
                Session::forget('Coupon_code' );
                Session::forget('total' );
                return redirect()->back()->with('flash_message_success','product quantity updated');
            }else{
                return redirect()->back()->with('flash_message_error','product quantity not available');
            }
        }
        return redirect()->back()->with('flash_message_error','nothing be updated');
    }

    public function applyCoupon(Request $request){
        if($request->isMethod('post')){
            if(isset($request->coupon_code)){
                Session::forget('Coupon_amount' );
                Session::forget('Coupon_code' );
                Session::forget('total' );
                $coupon = Coupon::where('coupon_code',$request->coupon_code)->first();
                if($coupon){
                    if($coupon->status == 0){
                        return redirect()->back()->with('flash_message_error','This coupon is not active!!');
                    }
                    if ($coupon->expire_date < date('Y-m-d')){
                        return redirect()->back()->with('flash_message_error','This coupon is expired!!');
                    }
                    $session_id = Session::get('session_id');
                    $userCart = DB::table('cart')->where('session_id',$session_id)->get();
                    $total = 0;
                    foreach ($userCart as $item){
                        $total += $item->price * $item->quantity;
                    }
                    $coupon_amount =0;
                    if($coupon->amount_type == 1){//Percentage
                        $coupon_amount = $total * ($coupon->amount / 100);
                    }elseif ($coupon->amount_type == 2){//Fixed
                        $coupon_amount = $coupon->amount ;
                    }
                    Session::put('Coupon_amount' , $coupon_amount);
                    Session::put('Coupon_code' , $coupon->coupon_code);
                    Session::put('total' , $total);
                    return redirect()->back()->with('flash_message_success','coupon code applied successfully');
                }else{
                    return redirect()->back()->with('flash_message_error','This coupon does not exists!!');
                }
            }
        }
        return redirect()->back()->with('flash_message_error','This coupon does not exists!!');
    }

    public function checkOut(Request $request){
        $user = Auth::user();
        $countries = Country::all();
        $shipping = DeliveryAddress::where('user_id', $user->id)->first();
        if($request->isMethod('post')){
            try {
                foreach ($request->except('_token') as $data => $value) {
                    $valids[$data] = "required";
                }

                $validator = validator($request->all(), $valids);
                if ($validator->fails()) {
                    foreach ($validator->messages()->getMessages() as $key => $val) {
                        $response["$key"] = $val;
                    }
                    return redirect()->back()
                        ->withErrors($response)
                        ->withInput();
                }

                $result = $countries->where('id', $request->billing_country);
                $result1 = $countries->where('id', $request->shipping_country);
                if ($result->isEmpty() or $result1->isEmpty()){
                    return back()->with('flash_message_error','selected country is incorrect');
                }

                if(!$shipping){
                    $shipping = new DeliveryAddress();
                    $shipping->user_id = $user->id;
                    $shipping->user_email = $user->email;
                    $shipping->name = $request->shipping_name;
                    $shipping->address = $request->shipping_address;
                    $shipping->city = $request->shipping_city;
                    $shipping->state = $request->shipping_state;
                    $shipping->country = $request->shipping_country;
                    $shipping->pincode = $request->shipping_pincode;
                    $shipping->mobile = $request->shipping_mobile;
                    $shipping->save();
                }else{
                    DeliveryAddress::where('user_id', $user->id)->update([
                        'user_id'=> $user->id,
                        'user_email'=> $user->email,
                        'name'=> $request->shipping_name,
                        'address'=> $request->shipping_address,
                        'city'=> $request->shipping_city,
                        'state'=> $request->shipping_state,
                        'country'=> $request->shipping_country,
                        'pincode'=> $request->shipping_pincode,
                        'mobile'=> $request->shipping_mobile
                    ]);
                }
                return redirect()->back()->with('flash_message_success','profile updated successfully');
            }
            catch(\Exception $e){
                die($e->getMessage()) ;   // insert query
            }
        }
        return view('user.check_out')->with(['user'=>$user, 'countries'=>$countries, 'shipping'=>$shipping]);
    }
}
