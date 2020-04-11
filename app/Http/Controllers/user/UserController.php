<?php


namespace App\Http\Controllers\user;


use App\User;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function userLoginRegister(){
        return response()->view('user.login_register');
    }
    public function register(Request $request){
        if($request->isMethod('post')){
            if(isset($request->name) and isset($request->email) and isset($request->password)){
                $user = User::select('id')->where('email',$request->email)->get();
                if($user->isEmpty()){
                    $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->user_type = 2;
                    $user->password = bcrypt($request->name);
                    $user->save();
                    Auth::loginUsingId($user->id);
                    return redirect()->route('showCart')->with('flash_message_success','@@Welcome@@');
                }else{
                    return redirect()->back()->with('flash_message_error','the email has exists!!');
                }
            }
        }
        return response()->view('user.login_register');
    }

    public function login(Request $request)
    {
        if($request->isMethod('post')){
            //dd(Hash::make($request->password));
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password ,'user_type'=>2])){
                return redirect()->route('showCart')->with('flash_message_success','@@Welcome@@');
            }else{
                return back()->with('flash_message_error','Invalid username and password');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return  redirect()->route('index')->with('flash_message_success','logged out successful');
    }

    public function checkEmail(Request $request){
        $user = User::where('email',$request->email)->first();
        if($user){
            return "false";
        }
        return "true";
    }

    public function account(){
//        dd(response()->view('user.login_register'));
        return view('user.account');
    }
}