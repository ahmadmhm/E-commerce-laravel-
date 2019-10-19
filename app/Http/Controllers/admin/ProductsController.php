<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Helpers\Helpers;
use App\Product;
use App\ProductImage;
use App\ProductsAttribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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

    public function editProduct(Request $request,$id =null)
    {
        $levels = Category::all();
        $product = null;
        if ($id != null) {

            $product = Product::where('id', $id)->first();
            if ($request->isMethod('post')) {

                $product->category_id = $request->category_id;
                $product->product_name = $request->product_name;
                $product->product_code = $request->product_code;
                $product->product_color = $request->product_color;
                $product->description = $request->description;
                $product->price = $request->price;


                //saving the image
                $file = null;
                if ($request->product_image != Null)
                    $file = $request->file('product_image');
                if ($file) {
                    if ($file->isValid()) {
                        $fileName = time() . '_' . $product->id . '_' . $file->getClientOriginalName();
                        $large_destinationPath = public_path() . '/images/products/large/' . $fileName;
                        $medium_destinationPath = public_path() . '/images/products/medium/' . $fileName;
                        $small_destinationPath = public_path() . '/images/products/small/' . $fileName;

//                    $file->move($large_destinationPath, $fileName);
//                    $uploaded_file_dir = 'images/products/'.$fileName;
//                    dd(public_path());
                        Image::make($file)->save($large_destinationPath);
                        Image::make($file)->resize(600, 600)->save($medium_destinationPath);
                        Image::make($file)->resize(300, 300)->save($small_destinationPath);

                        $product->product_image = $fileName;
                    }
                }
                $product->update();
                return redirect()->route('admin.view_products')->with('flash_message_success', 'product updated successfully');
            }
            if ($product) {
                $levels = Helpers::make_product_dropdown_menu($levels, $product->category_id);
                return view('admin.products.edit_product', compact('product', 'levels'));
            }
            return redirect()->back();
        }
    }

    public function deleteProduct($id =null){
        if($id != null)
            Product::destroy($id);
        return redirect()->back()->with('flash_message_success','product deleted successfully');
    }

    public function deleteProductImage($id =null){
        if($id != null){
            $product = Product::where('id', $id)->first();
            if($product){
//                if(file_exists(Helpers::product_medium_image_asset($product->product_image))) {
//                    unlink(Helpers::product_medium_image_asset($product->product_image));
//                }
//                Storage::disk('public')->delete('/images/products/small/'.$product->product_image);
//                Storage::delete(Helpers::product_medium_image_asset($product->product_image));
//                Storage::delete(Helpers::product_large_image_asset($product->product_image));
                $product ->update(['product_image' => '']);
            }
        }
        return redirect()->back()->with('flash_message_success','product image deleted successfully');
    }

    public function addAttributes(Request $request, $id = null){
        $productDetails = null;
        if($id != null){
            $productDetails = Product::with('Attributes')->where(['id'=>$id])->first();
        }
        if($request->isMethod('post')){
            $data = $request->all();
            foreach ($data['sku'] as $key => $value){
                if(!empty($value) and $id != null){
                    $attribute = new ProductsAttribute();
                    $attribute-> product_id = $id;
                    $attribute-> sku = $value;
                    $attribute-> size = $data['size'][$key];
                    $attribute-> price = $data['price'][$key];
                    $attribute-> stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect()->route('admin.add_attributes', ['id'=>$id])->with('flash_message_success', 'product attributes added successfully');
        }else{
            if($productDetails != null){
                return view('admin.products.add_attributes', compact('productDetails'));
            }
        }

        return redirect()->back();

    }
}
