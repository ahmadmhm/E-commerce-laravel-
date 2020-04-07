<?php


namespace App\Http\Controllers\user;


use App\User;
use http\Client\Response;
use Illuminate\Http\Request;

class UserController
{
    public function Register(Request $request){
        if($request->isMethod('post')){
            if(isset($request->name) and isset($request->email) and isset($request->password)){
                $user = User::where('email',$request->email)->get();
                if($user){
                    return redirect()->back()->with('flash_message_error','the email has exists!!');
                }
            }
        }
        return response()->view('user.login_register');
    }

    public function checkEmail(Request $request){
        $user = User::where('email',$request->email)->get();
        if($user){
            return "false";
        }
        return "true";
    }

}