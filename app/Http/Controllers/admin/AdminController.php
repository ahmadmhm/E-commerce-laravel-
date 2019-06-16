<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function login(Request $request){

        if($request->isMethod('post')){
//            $data = $request->input();
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password ,'user_type'=>1])){
                return  redirect()->route('admin.dashboard');
            }else{
                dd('you fucked');
            }

        }

        return view('admin.admin_login');

    }

    public function dashboard(){
        return view('admin.dashboard');
    }
}
