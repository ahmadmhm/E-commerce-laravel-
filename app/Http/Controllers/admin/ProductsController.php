<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    //

    public function addProduct(Request $request){
        if($request->isMethod('post')){
//            dd($request->all());
            $category = new Category();
            $category->name = $request->category_name;
            $category->parent_id = $request->parent_id;
            $category->description = $request->description;
            $category->url = $request->url;
            $category->save() ;

            return redirect()->route('admin.view_categories')->with('flash_message_success','category added successfully');
        }
        $levels = Category::all();
        $levels = Helpers::make_category_dropdown_menu($levels);
        return view('admin.products.add_product',compact('levels'));
    }
}
