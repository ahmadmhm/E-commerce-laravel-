<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Helpers\Helpers;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    //

    public function addProduct(Request $request){
        if($request->isMethod('post')){
//            dd($request->all());
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->product_color = $request->product_color;
            $product->description = $request->description;
            $product->price = $request->price;

            $product->save() ;

            //saving the image
            $file = null;
            if($request->product_image!=Null)
                $file = $request->file('product_image');
//            dd(public_path());
            if($file){
                if ($file->isValid()) {
                    $fileName = time() . '_' . $product->id .'_'. $file->getClientOriginalName();
                    $destinationPath = public_path() . '/images/products';

                    $file->move($destinationPath, $fileName);
                    $uploaded_file_dir = 'images/products/'.$fileName;

                    $image = new Image();
                    $image->product_id = $product->id;
                    $image->url = $uploaded_file_dir;
                    $image->save();
                }
            }

            $levels = Category::all();
            $levels = Helpers::make_category_dropdown_menu($levels);
            redirect()->route('admin.add_product',compact('levels'))->with('flash_message_success','product added successfully');
        }
        $levels = Category::all();
        $levels = Helpers::make_category_dropdown_menu($levels);
        return view('admin.products.add_product',compact('levels'));
    }
}
