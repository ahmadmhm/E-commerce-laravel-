<?php


namespace App\Helpers;


class Helpers
{

    public static function make_category_dropdown_menu($categories){
        $menu ="<option value='' selected disabled>Select</option>";
        foreach ($categories as $category){
            if($category->parent_id == 0){
                $menu .='<option value="'.$category->id.'">'. $category->name .'</option>';
                foreach ($categories as $sub_cat){
                    if($sub_cat->parent_id == $category->id)
                        $menu .='<option value="'.$sub_cat->id.'">&nbsp;--&nbsp;'. $sub_cat->name .'</option>';
                }
            }
        }
        return $menu;
    }

    public static function make_product_dropdown_menu($categories , $id){
        $menu ="<option value='' selected disabled>Select</option>";
        foreach ($categories as $category){
            if($category->parent_id == 0){
                if($category->id == $id){
                    $menu .='<option selected value="'.$category->id.'">'. $category->name .'</option>';
                }else{
                    $menu .='<option value="'.$category->id.'">'. $category->name .'</option>';
                }
                foreach ($categories as $sub_cat){
                    if($sub_cat->parent_id == $category->id){
                        if($sub_cat->id == $id){

                            $menu .='<option selected value="'.$sub_cat->id.'">&nbsp;--&nbsp;'. $sub_cat->name .'</option>';
                        }else{
                            $menu .='<option value="'.$sub_cat->id.'">&nbsp;--&nbsp;'. $sub_cat->name .'</option>';
                        }
                    }
                }
            }
        }
        return $menu;
    }

    public static function product_small_image_asset($image_name){
        return 'http://localhost/first/E-commerce/public/images/products/small/'.$image_name;
//        return public_path().'/images/products/small/'.$image_name;
    }
    public static function product_medium_image_asset($image_name){
        return 'http://localhost/first/E-commerce/public/images/products/medium/'.$image_name;
//        return public_path().'/images/products/small/'.$image_name;
    }
    public static function product_large_image_asset($image_name){
        return 'http://localhost/first/E-commerce/public/images/products/large/'.$image_name;
//        return public_path().'/images/products/small/'.$image_name;
    }
}