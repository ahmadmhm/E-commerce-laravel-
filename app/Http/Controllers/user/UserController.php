<?php


namespace App\Http\Controllers\user;


use App\User;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

}