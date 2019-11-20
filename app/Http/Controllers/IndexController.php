<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(){
//        $products = Product::orderBy('id','DESC')->get();
        $products = Product::inRandomOrder()->get();
        return view('user.index',compact('products'));
    }
}
