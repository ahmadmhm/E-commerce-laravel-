<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function login(Request $request)
    {
//        dd($request);
        if($request->isMethod('post')){
//            $data = $request->input();
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password ,'user_type'=>1])){
                return redirect()->route('admin.dashboard');
            }else{
                return back()->with('flash_message_error','Invalid username and password');
//                dd('you fucked');
            }

        }
        return view('auth.login');
    }

    public function logout()
    {
        $user_type = Auth::guard()->user()->user_type;
        if($user_type === 1){
            Auth::logout();
            return  redirect()->route('admin.login')->with('flash_message_success','logged out successful');
        }

    }
}
