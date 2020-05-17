<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        $users = User::with('Information')->get();
//        dd($users);
        return response()->view('admin.users.view_users' , compact('users'));
    }
}
