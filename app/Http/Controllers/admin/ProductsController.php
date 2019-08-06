<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Helpers\Helpers;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

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



            //saving the image
            $file = null;
            if($request->product_image!=Null)
                $file = $request->file('product_image');
//            dd(public_path());
            if($file){
                if ($file->isValid()) {
                    $fileName = time() . '_' . $product->id .'_'. $file->getClientOriginalName();
                    $large_destinationPath = public_path() . '/images/products/large/'.$fileName;
                    $medium_destinationPath = public_path() . '/images/products/medium/'.$fileName;
                    $small_destinationPath = public_path() . '/images/products/small/'.$fileName;

//                    $file->move($large_destinationPath, $fileName);
//                    $file->move($medium_destinationPath, $fileName);
//                    $file->move($small_destinationPath, $fileName);
                    Image::make($file)->save($large_destinationPath);
                    Image::make($file)->resize(600,600)->save($medium_destinationPath);
                    Image::make($file)->resize(300,300)->save($small_destinationPath);
                    $uploaded_file_dir = 'images/products/'.$fileName;
                    $product->product_image = $fileName;
//                    $image = new ProductImage();
//                    $image->product_id = $product->id;
//                    $image->url = $fileName;
//                    $image->save();
                }
                $product->save() ;
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
