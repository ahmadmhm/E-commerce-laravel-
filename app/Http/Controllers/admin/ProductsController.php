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

        $levels = Category::all();
        $levels = Helpers::make_category_dropdown_menu($levels);
        if($request->isMethod('post')){
//            dd($request->all());
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->product_color = $request->product_color;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->product_image = '';


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
//                    $uploaded_file_dir = 'images/products/'.$fileName;
//                    dd(public_path());
                    Image::make($file)->save($large_destinationPath);
                    Image::make($file)->resize(600,600)->save($medium_destinationPath);
                    Image::make($file)->resize(300,300)->save($small_destinationPath);

                    $product->product_image = $fileName;
                }
                $product->save() ;
            }
            return redirect()->route('admin.view_products',compact('levels'))->with('flash_message_success','product added successfully');
        }

        return view('admin.products.add_product',compact('levels'));
    }

    public function viewProducts(){
        $products = Product::where('id','<>', null)->with('Category')->get();
//        dd($categories);
        return view('admin.products.view_products',compact('products'));
    }

    public function getProducts(Request $request){
        if(isset($request->id)){
            $product = Product::where('id', $request->id)->with('Category')->first();
            return $product;
        }else{
            return 'error';
        }

    }
}
