<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\Helpers;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index(){
//        $products = Product::orderBy('id','DESC')->get();
        $categories = Category::all();
//        $categories = Category::with('subCategories')->where('parent_id',0)->get();
//        dd($categories);

        $products = Product::where('status',1)->inRandomOrder()->get();
        return view('user.index')->with(['products'=> $products,'categories'=>$categories]);
    }
}
