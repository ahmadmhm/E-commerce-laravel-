<?php

namespace App\Http\Controllers\admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    public function addCategory(Request $request){
        if($request->isMethod('post')){
//            dd($request->all());
            $category = new Category();
            $category->name = $request->category_name;
            $category->description = $request->description;
            $category->url = $request->url;
            $category->save() ;

            return redirect()->route('admin.view_categories')->with('flash_message_success','category added successfully');
        }
        return view('admin.categories.add_category');
    }

    public function viewCategories(){
        $categories = Category::all();
//        dd($categories);
        return view('admin.categories.view_categories',compact('categories'));
    }

    public function editCategory(Request $request,$id =null){
        $category = null;
        if($id != null){
            $category = Category::where('id',$id)->first();
        if($request->isMethod('post')){

            $category->name = $request->category_name;
            $category->description = $request->description;
            $category->url = $request->url;
            $category->update() ;

            return redirect()->route('admin.view_categories')->with('flash_message_success','category updated successfully');
        }
            if($category)
                return view('admin.categories.edit_category',compact('category'));
        }
        return view('admin.categories.edit_category');
    }

    public function deleteCategory($id =null){
        if($id != null)
        Category::destroy($id);
//        $category = Category::where('id',$id)->delete();
//        dd($categories);
        return redirect()->back()->with('flash_message_success','category deleted successfully');
    }
}
