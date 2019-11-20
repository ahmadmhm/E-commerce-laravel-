<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function login(Request $request){

        if($request->isMethod('post')){
//            $data = $request->input();
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password ,'user_type'=>1])){
                return redirect()->route('admin.dashboard');
            }else{
                return back()->with('flash_message_error','Invalid username and password');
//                dd('you fucked');
            }

        }
//        return Hash::make("ahmad2775");
        return view('admin.admin_login');

    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function settings(){
        return view('admin.settings');
    }

    public function checkPassword(Request $request){
        if($request->ajax()) {
            if(isset($request->password)){
                $result = User::where(['user_type'=>1])->first();
                if(Hash::check($request->password , $result->password)){
                    return json_encode("ok");
                }
            }
            return json_encode('error');
        }else{
            return json_encode('error');
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')) {
            if(isset($request->current_pwd)){
                $result = User::where(['user_type'=>1,'email'=>Auth::user()->email])->first();
                if(Hash::check($request->current_pwd , $result->password)){
                    $newPassword = bcrypt($request->new_pwd);
                    User::where('id',Auth::user()->id)->update(['password'=>$newPassword]);

                    return back()->with('flash_message_success','password changed successfully');
                }
            }
            return back()->with('flash_message_error','password not changed successfully');
        }else{
            return back()->with('flash_message_error','password not changed successfully');
        }
    }
}
